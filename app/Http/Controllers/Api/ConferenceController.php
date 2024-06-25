<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddConferenceRequest;
use App\Http\Resources\AddConferenceResource;
use App\Models\Conference;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ConferenceController extends Controller
{
    public function addConference(AddConferenceRequest $request)
    {
//        Validate data
        $data = $request->validated();

//        Check if transaction_id exists
        if (Conference::where('transaction_id', $data['transaction_id'])->exists()) {
            throw new HttpResponseException(
                response([
                    "errors" => [
                        "message" => [
                            "Transaction already exists."
                        ]
                    ]
                ], 400)
            );
        }

        $user = Auth::user();
        $data['customer_company_id'] = $user->id;
        $data['status'] = 'pending';

//        Create conference
        $addConference = Conference::Create($data);

        return (new AddConferenceResource($addConference))->response()->setStatusCode(201);
    }

    public function pendingConferenceSearch(Request $request): JsonResponse
    {

        $conferences = DB::table('conferences')
            ->join('users', 'conferences.customer_company_id', '=', 'users.id')
            ->select('conferences.*', 'users.company_name')
            ->where('conferences.status', 'pending')
            ->get();

        return response()->json([
            'data' => $conferences,
        ], 200);
    }

    public function approvedConferenceSearch(Request $request): JsonResponse
    {

        $conferences = DB::table('conferences')
            ->join('users', 'conferences.customer_company_id', '=', 'users.id')
            ->select('conferences.*', 'users.company_name')
            ->where('conferences.status', 'approved')
            ->get();

        return response()->json([
            'data' => $conferences,
        ], 200);
    }

    public function rejectedConferenceSearch(Request $request): JsonResponse
    {

        $conferences = DB::table('conferences')
            ->join('users', 'conferences.customer_company_id', '=', 'users.id')
            ->select('conferences.*', 'users.company_name')
            ->where('conferences.status', 'rejected')
            ->get();

        return response()->json([
            'data' => $conferences,
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

    public function getConferenceDetails(string $transactionId)
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

        // If not found
        if (!$conferenceDetail) {
            throw new HttpResponseException(
                response([
                    "errors" => [
                        "message" => [
                            "Conference not found."
                        ]
                    ]
                ], 404)
            );
        }

//        return $conferenceDetail;
        return response()->json([
            'data' => $conferenceDetail,
        ], 200);
    }
}
