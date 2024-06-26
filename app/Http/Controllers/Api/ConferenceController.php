<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Conference;
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
                ], 404);
            }
            return response()->json([
                'status' => 'success',
                'message' => $request->has('status') ? 'Get all conferences by status ' . $request->status . ' success' : 'Get conferences list success',
                'data' => $conferences
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'You are not authorized to get conference data. Must be an admin'
            ], 403);
        }
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
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Get conference detail success',
            'data' => $conferenceDetail,
        ], 200);
    }

    public function approveConference(string $transactionId, Request $request)
    {
        $conference = Conference::where('transaction_id', $transactionId)->first();
        $conference->status = "approved";
        $conference->conference_approved_at = Carbon::parse($request->approvedDate)->format('Y-m-d H:i:s');
        $conference->save();

        return response()->json([
            'message' => 'Conference approved.'
        ])->setStatusCode(200);
    }

    public function rejectConference(string $transactionId, Request $request)
    {
        $conference = Conference::where('transaction_id', $transactionId)->first();
        $conference->status = "rejected";
        $conference->conference_rejected_at = Carbon::parse($request->rejectedDate)->format('Y-m-d H:i:s');
        $conference->save();

        return response()->json([
            'message' => 'Conference rejected.'
        ])->setStatusCode(200);
    }
}
