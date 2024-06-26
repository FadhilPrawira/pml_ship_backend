<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddShipperConsigneeRequest;
use App\Http\Requests\CheckQuotationRequest;
use App\Http\Requests\OrderPortRequest;
use App\Http\Requests\PlaceQuotationRequest;
use App\Http\Requests\SummaryOrderRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Http\Resources\AddShipperConsigneeResource;
use App\Http\Resources\CheckQuotationResource;
use App\Http\Resources\OrderPortResource;
use App\Http\Resources\PlaceQuotationResource;
use App\Http\Resources\SummaryOrderResource;
use App\Http\Resources\UpdateDocumentResource;
use App\Models\Order;
use App\Models\Vessel;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        // Validate the request
        $data = $request->validate([
            'port_of_loading_id' => 'required|integer|exists:ports,id',
            'port_of_discharge_id' => 'required|integer|exists:ports,id',
            'vessel_id' => 'required|integer|exists:vessels,id',
            'date_of_loading' => 'required|date',
            'date_of_discharge' => 'required|date',
            'cargo_description' => 'required|string',
            'cargo_weight' => 'required|string',
            'shipper_name' => 'required|string',
            'shipper_address' => 'required|string',
            'consignee_name' => 'required|string',
            'consignee_address' => 'required|string',
            'shipping_cost' => 'required|integer',
            'handling_cost' => 'required|integer',
            'biaya_parkir_pelabuhan' => 'required|integer',
        ]);

        // Set the transaction_id
        $data['transaction_id'] = 'TRX' . time();
        // Set the status
        $data['status'] = 'order_pending';

        // Calculate the cost details
        $shippingCost = $data['shipping_cost'];
        $handlingCost = $data['handling_cost'];
        $biayaParkirPelabuhan = $data['biaya_parkir_pelabuhan'];
        $totalCost = $shippingCost + $handlingCost + $biayaParkirPelabuhan;
        // Tax = 10% of total price
        $tax = $totalCost * 0.1;
        // Total bill
        $totalBill = $totalCost + $tax;

        // Add the tax and total bill to the data
        $data['tax'] = $tax;
        $data['total_bill'] = $totalBill;

        // Get the authenticated user
        $user = $request->user();
        $data['user_id'] = $user->id;
        // Create the order
        $order = Order::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Order success to create',
            'data' => $order
        ])->setStatusCode(201);
    }

    public function NEWcheckQuotation(Request $request)
    {
        // Validate the request
        $request->validate([
            'port_of_loading_id' => 'required|integer|exists:ports,id',
            'port_of_discharge_id' => 'required|integer|exists:ports,id',
            'date_of_loading' => 'required|date',
            'cargo_description' => 'required|string',
            'cargo_weight' => 'required|string',
        ]);


        $routeDetails = DB::table('vessel_routes')
            ->join('ports as loading_port', 'vessel_routes.port_of_loading_id', '=', 'loading_port.id')
            ->join('ports as discharge_port', 'vessel_routes.port_of_discharge_id', '=', 'discharge_port.id')
            ->select('loading_port.name as port_of_loading_name', 'discharge_port.name as port_of_discharge_name', 'vessel_routes.day_estimation', 'vessel_routes.shipping_cost', 'vessel_routes.handling_cost', 'vessel_routes.biaya_parkir_pelabuhan')
            ->where('port_of_loading_id', $request->port_of_loading_id)
            ->where('port_of_discharge_id', $request->port_of_discharge_id)
            ->first();

        $vesselNames = Vessel::select('id', 'vessel_name')->get();
        $result = $vesselNames->map(function ($vessel) use ($routeDetails) {
            return array_merge($vessel->toArray(), (array) $routeDetails);
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Check quotation success',
            'data' => $result
        ])->setStatusCode(200);
    }

    // PROBABLY NOT NEEDED
    public function NEWplaceQuotation(Request $request)
    {
        // Validate the request
        $data = $request->validate([
            'vessel_id' => 'required|integer',
            'date_of_discharge' => 'required|date',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Place quotation success',
            'data' => $data
        ])->setStatusCode(200);
    }

    public function orderPort(OrderPortRequest $request)
    {
        // Validate data
        $data = $request->validated();
        $data['transaction_id'] = 'TRX' . time();
        $data['status'] = 'order_pending';
        $data['user_id'] = $request->user()->id;
        $orderPortData = Order::create($data);

        return (new OrderPortResource($orderPortData))->response()->setStatusCode(201);
    }

    public function checkQuotation(CheckQuotationRequest $request)
    {
        // Validate if user is authenticated
        $user = Auth::user();

        // Validate data
        $data = $request->validated();

        //    Search transaction_id from table orders
        //    Then from that result, search port_of_loading_id and port_of_loading_id
        $checkOrderBasedOnTransactionId = Order::with(['portOfLoading', 'portOfDischarge'])
            ->where('transaction_id', $data['transaction_id'])
            ->where('user_id', $user->id)
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

        //        From the result above, search port_of_loading_id and port_of_loading_id from table vessel_routes
        //        Change port_of_loading_id to be port_of_loading_name
        //        Change port_of_discharge_id to be port_of_discharge_name
        //        And don't show the port_of_loading_id and port_of_discharge_id
        $routeCollection = DB::table('vessel_routes')
            ->join('ports as loading_port', 'vessel_routes.port_of_loading_id', '=', 'loading_port.id')
            ->join('ports as discharge_port', 'vessel_routes.port_of_discharge_id', '=', 'discharge_port.id')
            ->select('loading_port.name as port_of_loading_name', 'discharge_port.name as port_of_discharge_name', 'vessel_routes.day_estimation', 'vessel_routes.shipping_cost', 'vessel_routes.handling_cost', 'vessel_routes.biaya_parkir_pelabuhan')
            ->where('port_of_loading_id', $checkOrderBasedOnTransactionId->port_of_loading_id)
            ->where('port_of_discharge_id', $checkOrderBasedOnTransactionId->port_of_discharge_id)
            ->get()->first();


        //      Get all vessel_name from table vessels
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
                "port_of_loading_latitude" => $checkOrderBasedOnTransactionId->portOfLoading->latitude,
                "port_of_loading_longitude" => $checkOrderBasedOnTransactionId->portOfLoading->longitude,
                'port_of_discharge_latitude' => $checkOrderBasedOnTransactionId->portOfDischarge->latitude,
                'port_of_discharge_longitude' => $checkOrderBasedOnTransactionId->portOfDischarge->longitude,
                'date_of_loading' => $checkOrderBasedOnTransactionId->date_of_loading,
                'estimated_day' => $routeCollection->day_estimation,
                'estimated_date_of_discharge' => Carbon::createFromFormat('Y-m-d', $checkOrderBasedOnTransactionId->date_of_loading)->addDays(intval($routeCollection->day_estimation))->format('Y-m-d'),
                'shipping_cost' => $routeCollection->shipping_cost,
                'handling_cost' => $routeCollection->handling_cost,
                'biaya_parkir_pelabuhan' => $routeCollection->biaya_parkir_pelabuhan,
            ];
        }


        // Return the response
        return response()->json([
            'transaction_id' => $result['transaction_id'],
            'data' => CheckQuotationResource::collection($result['data']),
        ])->setStatusCode(200);
    }


    public function placeQuotation(PlaceQuotationRequest $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        //        Validate data
        $data = $request->all();

        //        Find order by transaction_id and user_id
        $order = Order::where('transaction_id', $data['transaction_id'])
            ->where('user_id', $user->id)
            ->first();

        //        If not found, throw 404 error
        if (!$order) {
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

        //        Update the order
        if (isset($data['vessel_id'])) {
            $order->vessel_id = $data['vessel_id'];
        }

        if (isset($data['date_of_discharge'])) {
            $order->date_of_discharge = $data['date_of_discharge'];
        }

        if (isset($data['shipping_cost'])) {
            $order->shipping_cost = $data['shipping_cost'];
        }

        if (isset($data['handling_cost'])) {
            $order->handling_cost = $data['handling_cost'];
        }
        if (isset($data['biaya_parkir_pelabuhan'])) {
            $order->biaya_parkir_pelabuhan = $data['biaya_parkir_pelabuhan'];
        }

        $order->save();

        //        Search the order by transaction_id and user_id
        $result = Order::select('*', DB::raw('shipping_cost'))
            ->where('transaction_id', $data['transaction_id'])
            ->where('user_id', $user->id)
            ->first();

        return (new PlaceQuotationResource($result))->response()->setStatusCode(200);
    }

    public function addShipperConsignee(AddShipperConsigneeRequest $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        //        Validate data
        $data = $request->validated();

        //        Find order by transaction_id and user_id
        $order = Order::where('transaction_id', $data['transaction_id'])
            ->where('user_id', $user->id)
            ->first();

        //        If not found, throw 404 error
        if (!$order) {
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
        //        Return the response
        return (new AddShipperConsigneeResource($order))->response()->setStatusCode(201);
    }


    public function summaryOrder(SummaryOrderRequest $request)
    {
        //        TODO: Create trigger. When negotiation is approved (have datetime data), then update the value of column status from 'order_pending' to 'processed'
        // Get the authenticated user
        $user = Auth::user();

        // Validate data
        $data = $request->validated();

        // Retrieve the order summary
        $orderSummary = Order::with(['portOfLoading', 'portOfDischarge', 'vesselName'])
            ->where('user_id', $user->id)
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


    public function updateDocument(UpdateDocumentRequest $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Validate data
        $data = $request->validated();

        $order = Order::with(['portOfLoading', 'portOfDischarge', 'vesselName'])
            ->where('transaction_id', $data['transaction_id'])
            ->where('user_id', $user->id)
            ->first();


        // Check if file is not empty and file is uploaded
        if ($request->hasFile('document')) {

            // Get the file
            $document = $request->file('document');

            //            Document type location
            // Set file name
            $file_name = $data['transaction_id'] . '-' . $data['type'] . '.' . $document->extension();
            $file_name = str_replace(" ", "_", $file_name);
            // Store the new file
            $document->storeAs('public/documents', $file_name);

            switch ($data['type']) {
                case "shipping_instruction":
                    // Update the user file path in databases
                    $order->shipping_instruction_document_url = 'documents/' . $file_name;
                    break;
                case "bill_of_lading":
                    // Update the user file path in databases
                    $order->bill_of_lading_document_url = 'documents/' . $file_name;
                    break;
                case "cargo_manifest":
                    // Update the user file path in databases
                    $order->cargo_manifest_document_url = 'documents/' . $file_name;
                    break;
                case "time_sheet":
                    // Update the user file path in databases
                    $order->time_sheet_document_url = 'documents/' . $file_name;
                    break;
                case "draught_survey":
                    // Update the user file path in databases
                    $order->draught_survey_document_url = 'documents/' . $file_name;
                    break;
                    //                default:
                    //                    echo "Your favorite color is neither red, blue, nor green!";
            }

            $order->save();
            //            Access file
            //            http://10.104.220.16:8000/storage/documents/TRX1717142358-shipping_instruction.pdf
        }

        return (new UpdateDocumentResource($order))->response()->setStatusCode(200);
    }


    public function pendingOrderSearch(Request $request)
    {
        // Only return Order with status 'order_pending'
        $pendingOrder = DB::table('orders')
            ->join('ports as loading_port', 'orders.port_of_loading_id', '=', 'loading_port.id')
            ->join('ports as discharge_port', 'orders.port_of_discharge_id', '=', 'discharge_port.id')
            ->select('orders.*', 'loading_port.name as port_of_loading_name', 'discharge_port.name as port_of_discharge_name')
            ->where('status', 'order_pending')
            ->get();


        return response()->json([
            'data' => $pendingOrder,
        ])->setStatusCode(200);
    }

    /**
     * Display a listing of the resource.
     */

    // Get customer by status for admin
    public function index(Request $request)
    {
        // Validate the request
        $request->validate([
            // This is based on migration status enum
            'status' => 'string|in:order_pending,payment_pending,on_shipping,order_completed,order_canceled,order_rejected',
        ]);

        // Get the orders
        $orders = DB::table('orders')
            ->join('ports as loading_port', 'orders.port_of_loading_id', '=', 'loading_port.id')
            ->join('ports as discharge_port', 'orders.port_of_discharge_id', '=', 'discharge_port.id')
            ->select('orders.*', 'loading_port.name as port_of_loading_name', 'discharge_port.name as port_of_discharge_name')
            ->where('status', 'like', "%{$request->status}%")
            ->get();

        if ($orders->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Orders with status ' . $request->status . ' not found',
                'data' => []
            ])->setStatusCode(404);
        }
        return response()->json([
            'status' => 'success',
            'message' => $request->has('status') ? 'Get all orders by status ' . $request->status . ' success' : 'Get orders list success',
            'data' => $orders
        ])->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     */
    public function show(String $transactionId)
    {
        // Get the order detail
        $orderDetail = DB::table('orders')
            ->join('ports as loading_port', 'orders.port_of_loading_id', '=', 'loading_port.id')
            ->join('ports as discharge_port', 'orders.port_of_discharge_id', '=', 'discharge_port.id')
            ->select('orders.*', 'loading_port.name as port_of_loading_name', 'discharge_port.name as port_of_discharge_name', 'orders.date_of_loading', 'orders.date_of_discharge', 'orders.shipper_name', 'orders.consignee_name')
            ->where('orders.transaction_id', $transactionId)
            ->first();

        // If not found
        if (!$orderDetail) {
            return response()->json([
                'status' => 'error',
                'message' => 'Order info not found.',
                'data' => new stdClass(),
            ])->setStatusCode(200);
        }

        // Return the response
        return response()->json([
            'status' => 'success',
            'message' => 'Get order detail success',
            'data' => $orderDetail,
        ])->setStatusCode(200);
    }
}
