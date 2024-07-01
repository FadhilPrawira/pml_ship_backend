<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ConferenceDetailResource;
use App\Models\Conference;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use stdClass;

class ConferenceController extends Controller
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

    // Get conference by status for admin
    public function index(Request $request)
    {
        // Validate the request
        $request->validate([
            // This is based on migration status enum
            'status' => 'string|in:pending,approved,rejected',
        ]);

        // 'Order by' different at different status
        // Example: 'Order by' created_at for 'pending' status, 'Order by' conference_approved_at for 'approved' status, 'Order by' conference_rejected_at	 for 'rejected' status
        if ($request->status == 'pending') {
            $orderByRule = 'created_at';
        } else if ($request->status == 'approved') {
            $orderByRule = 'conference_approved_at';
        } else if ($request->status == 'rejected') {
            $orderByRule = 'conference_rejected_at';
        } else {
            $orderByRule = 'created_at';
        }

        // Get the authenticated user
        $user = $request->user();
        if ($user->role == 'admin') {
            // Get the orders
            $conferences = Conference::with('customerCompany')
                ->where('status', 'like', "%{$request->status}%")
                ->orderBy($orderByRule, 'desc')
                ->get();

            if ($conferences->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Conferences with status ' . $request->status . ' not found',
                    'data' => []
                ])->setStatusCode(404);
            }
            return response()->json([
                'status' => 'success',
                'message' => $request->has('status') ? 'Get all conferences by status ' . $request->status . ' success' : 'Get conferences list success',
                'data' => ConferenceDetailResource::collection($conferences)
            ])->setStatusCode(200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'You are not authorized to get conference data. Must be an admin'
            ])->setStatusCode(403);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate data
        $request->validate([
            'transaction_id' => 'required|string',
            'conference_type' => 'required|string',
            'location' => 'required|string',
            'conference_date' => 'required|date',
            'conference_time' => 'required',
        ]);

        // Search for transaction_id in Order table
        $order = Order::find($request->transaction_id);


        // Check if the order exists
        if (!$order) {
            return response()->json([
                'status' => 'error',
                'message' => 'Order not found',
                'data' => new stdClass(), // return empty object
            ])->setStatusCode(404);
        }


        // if transaction_id exists in Conference table
        if (Conference::where('order_transaction_id', $request->transaction_id)->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Conference already exists',
                'data' => new stdClass(), // return empty object
            ])->setStatusCode(400);
        }

        // Get all request data
        $data = $request->all();

        // Get the authenticated user
        $user = $request->user();

        $data['customer_company_id'] = $user->id;
        $data['status'] = 'pending';

        // Modify $data to include 'order_transaction_id'
        $data['order_transaction_id'] = $data['transaction_id'];
        unset($data['transaction_id']); // Remove the old key if desired

        // Create conference
        $conference = Conference::Create($data)->with(['order.portOfLoading', 'order.portOfDischarge'])->first();

        return response()->json([
            'status' => 'success',
            'message' => 'Conference created',
            'data' => new ConferenceDetailResource($conference),
        ])->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */

    public function show(string $transactionId)
    {
        // Get the conference detail
        $conferenceDetail = Conference::with(['order', 'customerCompany'])->where('order_transaction_id', $transactionId)->first();


        // Check if the conference exists
        if (!$conferenceDetail) {
            return response()->json([
                'status' => 'error',
                'message' => 'Conference not found',
                'data' => new stdClass(), // return empty object
            ])->setStatusCode(404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Get conference detail success',
            'data' => new ConferenceDetailResource($conferenceDetail),
        ])->setStatusCode(200);
    }

    public function approveConference(string $transactionId, Request $request)
    {
        // Validate the request
        $request->validate([
            'approved_at' => 'required|date',
        ]);

        // Get the conference
        $conference = Conference::where('order_transaction_id', $transactionId)->first();

        // Check if the conference exists
        if (!$conference) {
            return response()->json([
                'status' => 'error',
                'message' => 'Conference not found',
                'data' => new stdClass(), // return empty object
            ], 404);
        }

        // Check if the status is pending
        if ($conference->status != 'pending') {
            return response()->json([
                'status' => 'error',
                'message' => 'Conference status is not pending',
                'data' => new ConferenceDetailResource($conference),
            ], 400);
        }
        // Change the status to 'approved'
        $conference->status = "approved";
        // Set the approved date
        $conference->conference_approved_at = Carbon::parse($request->approved_at)->format('Y-m-d H:i:s');
        $conference->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Conference approved.',
            'data' => new ConferenceDetailResource($conference),
        ])->setStatusCode(200);
    }

    public function rejectConference(string $transactionId, Request $request)
    {
        // Validate the request
        $request->validate([
            'rejected_at' => 'required|date',
        ]);

        // Get the conference
        $conference = Conference::where('order_transaction_id', $transactionId)->first();

        // Check if the conference exists
        if (!$conference) {
            return response()->json([
                'status' => 'error',
                'message' => 'Conference not found',
                'data' => new stdClass(), // return empty object
            ])->setStatusCode(404);
        }

        // Check if the status is pending
        if ($conference->status != 'pending') {
            return response()->json([
                'status' => 'error',
                'message' => 'Conference status is not pending',
                'data' => new ConferenceDetailResource($conference),
            ])->setStatusCode(400);
        }

        // Change the status to 'rejected'
        $conference->status = "rejected";
        $conference->conference_rejected_at = Carbon::parse($request->rejected_at)->format('Y-m-d H:i:s');
        $conference->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Conference rejected.',
            'data' => new ConferenceDetailResource($conference),
        ])->setStatusCode(200);
    }
}
