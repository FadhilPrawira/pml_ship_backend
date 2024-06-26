<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Conference;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use stdClass;

class ConferenceController extends Controller
{
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

        // Get the authenticated user
        $user = $request->user();
        if ($user->role == 'admin') {
            // Get the orders
            $conferences = DB::table('conferences')
                ->join('users', 'conferences.customer_company_id', '=', 'users.id')
                ->select('conferences.*', 'users.company_name')
                ->where('conferences.status', 'like', "%{$request->status}%")
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
                'data' => $conferences
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

        // Search for transaction_id
        $order = Order::where('transaction_id', $request->transaction_id)->first();

        // Check if the order exists
        if (!$order) {
            return response()->json([
                'status' => 'error',
                'message' => 'Order not found',
                'data' => new stdClass(), // return empty object
            ])->setStatusCode(404);
        }

        // if transaction_id exists in Conference table
        if (Conference::where('transaction_id', $request->transaction_id)->exists()) {
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

        // Create conference
        $conference = Conference::Create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Conference created',
            'data' => $conference,
        ])->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */

    public function show(string $transactionId)
    {
        // Get the conference detail
        $conferenceDetail = DB::table('conferences')
            ->join('users', 'conferences.customer_company_id', '=', 'users.id')
            ->join('orders', 'conferences.transaction_id', '=', 'orders.transaction_id')
            ->join('ports as loading_port', 'orders.port_of_loading_id', '=', 'loading_port.id')
            ->join('ports as discharge_port', 'orders.port_of_discharge_id', '=', 'discharge_port.id')
            ->select('conferences.*', 'users.company_name', 'loading_port.name as port_of_loading_name', 'discharge_port.name as port_of_discharge_name', 'orders.date_of_loading', 'orders.date_of_discharge', 'orders.shipper_name', 'orders.consignee_name')
            ->where('conferences.transaction_id', $transactionId)
            ->first();

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
            'data' => $conferenceDetail,
        ])->setStatusCode(200);
    }

    public function approveConference(string $transactionId, Request $request)
    {
        // Validate the request
        $request->validate([
            'approved_at' => 'required|date',
        ]);

        // Get the conference
        $conference = Conference::where('transaction_id', $transactionId)->first();

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
                'data' => $conference,
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
            'data' => $conference,
        ])->setStatusCode(200);
    }

    public function rejectConference(string $transactionId, Request $request)
    {
        // Validate the request
        $request->validate([
            'rejected_at' => 'required|date',
        ]);

        // Get the conference
        $conference = Conference::where('transaction_id', $transactionId)->first();

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
                'data' => $conference,
            ])->setStatusCode(400);
        }

        // Change the status to 'rejected'
        $conference->status = "rejected";
        $conference->conference_rejected_at = Carbon::parse($request->rejectedDate)->format('Y-m-d H:i:s');
        $conference->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Conference rejected.',
            'data' => $conference,
        ])->setStatusCode(200);
    }
}
