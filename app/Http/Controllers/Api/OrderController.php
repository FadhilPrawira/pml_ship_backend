<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddShipperConsigneeRequest;
use App\Http\Requests\OrderPortRequest;
use App\Http\Requests\CheckQuotationRequest;
use App\Http\Requests\SummaryOrderRequest;
use App\Http\Resources\AddShipperConsigneeResource;
use App\Http\Resources\OrderPortResource;
use App\Http\Resources\CheckQuotationResource;
use App\Http\Resources\SummaryOrderResource;

use App\Models\Order;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    public function orderPort(OrderPortRequest $request)
    {
        $data = $request->validated();
        $data['transaction_id'] = 'TRX' . time();
        $data['status'] = 'order_pending';
        $data['user_id'] = $request->user()->id;
        $orderPortData = Order::create($data);

        return (new OrderPortResource($orderPortData))->response()->setStatusCode(201);
    }

    public function addShipperConsignee(AddShipperConsigneeRequest $request)
    {
        //        Validate if user is authenticated
        $user = Auth::user();

        //        Validate data
        $data = $request->validated();

        //        Find order by transaction_id and user_id
        $order = Order::where('transaction_id', $data['transaction_id'])
            ->where('user_id', $user->id)
            ->first();


        if (isset($data['shipper_name'])) {
            $order->shipper_name = $data['shipper_name'];
        }
        if (isset($data['shipper_address'])) {
            $order->shipper_address = $data['shipper_address'];
        }
        if (isset($data['consignee_name'])) {
            $order->consignee_name = $data['consignee_name'];
        }
        if (isset($data['consignee_address'])) {
            $order->consignee_address = $data['consignee_address'];
        }

        $order->save();
        return (new AddShipperConsigneeResource($order))->response()->setStatusCode(201);
    }


    public function summaryOrder(SummaryOrderRequest $request)
    {
        // Validate if user is authenticated
        $user = Auth::user();

        // Validate data
        $data = $request->validated();

        // Retrieve the order summary
        $orderSummary = Order::with(['portOfLoading', 'portOfDischarge'])
            ->where('transaction_id', $data['transaction_id'])
            ->first();

        // If not found, throw 404 error
        if (!$orderSummary) {
            throw new HttpResponseException(
                response([
                    "errors" => [
                        "message" => [
                            "Transaction not found."
                        ]
                    ]
                ], 404)
            );
        }

        // Return the response
        return (new SummaryOrderResource($orderSummary))->response()->setStatusCode(200);
    }

    public function checkQuotation(CheckQuotationRequest $request)
    {
        // Validate if user is authenticated
        $user = Auth::user();

        // Validate data
        $data = $request->validated();

        //        i want to search transaction_id from table orders
        //          then from that result i want to search port_of_loading_id and port_of_loading_id

        $checkOrderBasedOnTransactionId = Order::with(['portOfLoading', 'portOfDischarge'])
            ->where('transaction_id', $data['transaction_id'])
            ->first();

        //         If not found, throw 404 error
        if (!$checkOrderBasedOnTransactionId) {
            throw new HttpResponseException(
                response([
                    "errors" => [
                        "message" => [
                            "Transaction not found."
                        ]
                    ]
                ], 404)
            );
        }
        //        From the result above, i want to search port_of_loading_id and port_of_loading_id from table vessel_routes
        //        Change port_of_loading_id to be port_of_loading_name, and port_of_discharge_id to be port_of_discharge_name and dont show the port_of_loading_id and port_of_discharge_id
        $routeCollection = DB::table('vessel_routes')
            ->join('ports as loading_port', 'vessel_routes.port_of_loading_id', '=', 'loading_port.id')
            ->join('ports as discharge_port', 'vessel_routes.port_of_discharge_id', '=', 'discharge_port.id')
            ->select('loading_port.name as port_of_loading_name', 'discharge_port.name as port_of_discharge_name', 'vessel_routes.day_estimation', 'vessel_routes.cost')
            ->where('port_of_loading_id', $checkOrderBasedOnTransactionId->port_of_loading_id)
            ->where('port_of_discharge_id', $checkOrderBasedOnTransactionId->port_of_discharge_id)
            ->get()->first();

        //        So it become an array
        //        $routeBasedOnLoadingPortAndDischargePort = json_decode(json_encode($routeCollection), true);;

        //      I want to get all vessel_name from table vessels
        $vessel_names = DB::table('vessels')
            ->get();

        // Prepare the data
        $result = [
            'transaction_id' => $checkOrderBasedOnTransactionId->transaction_id,
            'data' => []
        ];

        // Loop through each vessel and construct the response
        foreach ($vessel_names as $vessel_name) {

            $result['data'][] = [
                'vessel_id' => $vessel_name->id,
                'vessel_name' => $vessel_name->vessel_name,
                'port_of_loading_name' => $routeCollection->port_of_loading_name,
                'port_of_discharge_name' => $routeCollection->port_of_discharge_name,
                'date_of_loading' => $checkOrderBasedOnTransactionId->date_of_loading,
                'estimated_day' => $routeCollection->day_estimation,
                'estimated_date_of_discharge' =>  Carbon::createFromFormat('Y-m-d', $checkOrderBasedOnTransactionId->date_of_loading)->addDays(intval($routeCollection->day_estimation))->format('Y-m-d'),
                'estimated_cost' => $routeCollection->cost,
            ];
        }

        // Return the response
        return response()->json([
            'transaction_id' => $result['transaction_id'],
            'data' => CheckQuotationResource::collection($result['data']),
        ])->setStatusCode(200);
    }


    public function placeQuotation(Request $request)
    {
        // Validate if user is authenticated
        $user = Auth::user();

        //        Validate data
        $data = $request->all();

        //        Find order by transaction_id and user_id
        $order = Order::where('transaction_id', $data['transaction_id'])
            ->where('user_id', $user->id)
            ->first();


        if (isset($data['vessel_id'])) {
            $order->vessel_id = $data['vessel_id'];


            $order->save();



            //            create query based on this
            //            {
            //                “message”:”Quotation placed”
            //“transaction_id”: "TRX1715412818",
            //“order”: {
            //                "TRX1715412818"
            //    "vessel _name": "PT Indonesia Maju",
            //}
            //}
            $result = Order::with('vesselName')
                ->where('transaction_id', $data['transaction_id'])
                ->first();
            //
            return response($result);
        }
    }
}
