<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SummaryOrderRequest;
use App\Http\Resources\OrderDetailResource;
use App\Http\Resources\SummaryOrderResource;
use App\Models\Document;
use App\Models\Order;
use App\Models\Vessel;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use stdClass;

class OrderController extends Controller
{

    // RULES
    // =====================================================================
    //     // This is assume today is 2024-05-17
    // DateTime orderDate = DateFormat("yyyy-MM-dd").parse('2024-05-17');

    // // Range for conference date is 2024-05-18 until 2024-05-20.
    // DateTime conferenceDateStarted = orderDate.add(const Duration(days: 1));
    // DateTime conferenceDateEnded = orderDate.add(const Duration(days: 3));

    // DateTime conferenceSuccessDate = DateFormat("yyyy-MM-dd").parse('2024-05-20');

    // // If conference success, customer can input document until 2 days later (2024-05-22)
    // DateTime maxInputDocument = conferenceSuccessDate.add(const Duration(days: 2));
    // DateTime customerInputDocumentShippingInstruction =
    //     DateFormat("yyyy-MM-dd").parse('2024-05-22');

    // DateTime maxPayment =
    //     customerInputDocumentShippingInstruction.add(const Duration(days: 2));
    // DateTime customerPaymentDate = DateFormat("yyyy-MM-dd").parse('2024-05-25');
    // DateTime adminCheckCustomerPaymentDate =
    //     customerPaymentDate.add(const Duration(days: 1));

    // =====================================================================
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

        // 'Order by' different at different status
        // Example: 'Order by' created_at for 'pending' status, 'Order by' approved_at for 'approved' status, 'Order by' rejected_at for 'rejected' status
        if ($request->status == 'order_pending') {
            $orderByRule = 'created_at';
        } else if ($request->status == 'payment_pending') {
            $orderByRule = 'negotiation_or_order_approved_at';
        } else if ($request->status == 'on_shipping') {
            $orderByRule = 'updated_at'; // not sure
        } else if ($request->status == 'order_completed') {
            $orderByRule = 'updated_at'; // not sure
        } else if ($request->status == 'order_canceled') {
            $orderByRule = 'order_canceled_at';
        } else if ($request->status == 'order_rejected') {
            $orderByRule = 'order_rejected_at';
        } else {
            $orderByRule = 'created_at';
        }

        // Get the orders
        $orders = Order::with(['portOfLoading', 'portOfDischarge'])
            ->where('status', 'like', "%{$request->status}%")
            ->orderBy($orderByRule, 'desc')
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
            'data' => OrderDetailResource::collection($orders)
        ])->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    // Create order
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
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

        // Get all request data
        $data = $request->all();

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

        // Create default documents
        $documentNames = ['shipping_instruction', 'bill_of_lading', 'cargo_manifest', 'time_sheet', 'draught_survey'];
        foreach ($documentNames as $documentName) {
            // Create the document for the order using the relationship
            $order->documents()->create([
                'document_type' => $documentName,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Order success to create',
            'data' => new OrderDetailResource($order),
        ])->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(String $transactionId)
    {
        // Get the order detail
        $orderDetail = Order::with(['documents'])
            ->where('transaction_id', $transactionId)
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
            'data' => new OrderDetailResource($orderDetail),
        ])->setStatusCode(200);
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


        // Get the route details
        $routeDetails = DB::table('vessel_routes')
            ->join('ports as loading_port', 'vessel_routes.port_of_loading_id', '=', 'loading_port.id')
            ->join('ports as discharge_port', 'vessel_routes.port_of_discharge_id', '=', 'discharge_port.id')
            ->select('loading_port.name as port_of_loading_name', 'loading_port.latitude as port_of_loading_latitude', 'loading_port.longitude as port_of_loading_longitude', 'discharge_port.name as port_of_discharge_name', 'discharge_port.latitude as port_of_discharge_latitude', 'discharge_port.longitude as port_of_discharge_longitude', 'vessel_routes.day_estimation', 'vessel_routes.shipping_cost', 'vessel_routes.handling_cost', 'vessel_routes.biaya_parkir_pelabuhan')
            ->where('port_of_loading_id', $request->port_of_loading_id)
            ->where('port_of_discharge_id', $request->port_of_discharge_id)
            ->first();

        // date of discharge = date of loading + day estimation
        $routeDetails->estimated_date_of_discharge = Carbon::createFromFormat('Y-m-d', $request->date_of_loading)->addDays(intval($routeDetails->day_estimation))->format('Y-m-d');

        // Get all vessel names
        $vesselNames = Vessel::select('id', 'vessel_name')->get();

        // Prepare the data
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
        $request->validate([
            'vessel_id' => 'required|integer',
            'date_of_discharge' => 'required|date',
        ]);

        // Get all request data
        $data = $request->all();

        return response()->json([
            'status' => 'success',
            'message' => 'Place quotation success',
            'data' => $data
        ])->setStatusCode(200);
    }

    public function approveOrder(string $transactionId, Request $request)
    {
        // Validate the request
        $request->validate([
            'approved_at' => 'required|date',
        ]);

        // Get the authenticated user
        $user = $request->user();
        if ($user->role == 'admin') {
            // Get the conference
            $order = Order::with('documents')
                ->where('transaction_id', $transactionId)->first();

            return $order;
            // Check if the conference exists
            if (!$order) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Order not found',
                    'data' => new stdClass(), // return empty object
                ], 404);
            }

            // Check if the status is 'order_pending'
            if ($order->status != 'order_pending') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Order status is not pending',
                    'data' => $order,
                ], 400);
            }
            // Change the status to 'payment_pending'
            $order->status = "payment_pending";
            // Set the approved date
            $order->documents->max_input_document_at = Carbon::parse($request->approved_at)->format('Y-m-d H:i:s');

            // Set the max input document date
            // Add 2 days from approved date, and make it to 23:59:59/end of the day
            $order->max_input_document_at = Carbon::parse($request->approved_at)->addDays(2)->endOfDay()->format('Y-m-d H:i:s');
            $order->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Order approved.',
                'data' => $order,
            ])->setStatusCode(200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'You are not authorized to approve order data. Must be an admin'
            ])->setStatusCode(403);
        }
    }

    public function rejectOrder(string $transactionId, Request $request)
    {
        // Validate the request
        $request->validate([
            'rejected_at' => 'required|date',
        ]);

        // Get the authenticated user
        $user = $request->user();
        if ($user->role == 'admin') {
            // Get the conference
            $order = Order::where('transaction_id', $transactionId)->first();

            // Check if the conference exists
            if (!$order) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Order not found',
                    'data' => new stdClass(), // return empty object
                ])->setStatusCode(404);
            }

            // Check if the status is 'order_pending'
            if ($order->status != 'order_pending') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Order status is not pending',
                    'data' => $order,
                ])->setStatusCode(400);
            }

            // Change the status to 'order_rejected'
            $order->status = "order_rejected";
            $order->order_rejected_at = Carbon::parse($request->rejected_at)->format('Y-m-d H:i:s');
            $order->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Order rejected.',
                'data' => $order,
            ])->setStatusCode(200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'You are not authorized to reject order data. Must be an admin'
            ])->setStatusCode(403);
        }
    }

    public function cancelOrder(string $transactionId, Request $request)
    {
        // Validate the request
        $request->validate([
            'canceled_at' => 'required|date',
        ]);
        // Get the authenticated user
        $user = $request->user();
        if ($user->role == 'customer') {
            // Get the conference
            $order = Order::where('transaction_id', $transactionId)->first();

            // Check if the conference exists
            if (!$order) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Order not found',
                    'data' => new stdClass(), // return empty object
                ])->setStatusCode(404);
            }

            // Change the status to 'order_canceled'
            $order->status = "order_canceled";
            $order->order_canceled_at = Carbon::parse($request->canceled_at)->format('Y-m-d H:i:s');
            $order->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Order canceled.',
                'data' => new OrderDetailResource($order),
            ])->setStatusCode(200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'You are not authorized to cancel order data. Must be an customer'
            ])->setStatusCode(403);
        }
    }
}
