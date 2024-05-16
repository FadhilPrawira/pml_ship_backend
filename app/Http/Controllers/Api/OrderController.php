<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddShipperConsigneeRequest;
use App\Http\Requests\OrderPortRequest;
use App\Http\Requests\SummaryOrderRequest;
use App\Http\Resources\AddShipperConsigneeResource;
use App\Http\Resources\OrderPortResource;
use App\Http\Resources\SummaryOrderResource;

use App\Models\Order;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        //        Validate if user is authenticated
        $user = Auth::user();
        //        Validate data
        $data = $request->validated();

        $test = DB::table('orders')->join('ports', 'orders.port_id', '=', 'ports.id')->select('orders.*', 'ports.name as port_name')->get();
//        $orderSummary = Order::where('transaction_id', $data['transaction_id'])->first();
return response()->json($test, 200);

//        // If not found
//        if (!$orderSummary) {
//            throw new HttpResponseException(
//                response([
//                    "errors" => [
//                        "message" => [
//                            "Transaction not found."
//                        ]
//                    ]
//                ], 404)
//            );
//        }
//        //        return response()->json($order, 200);
//        return (new SummaryOrderResource($orderSummary))->response()->setStatusCode(200);
    }
}
