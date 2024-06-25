<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserUpdateResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function update(UserUpdateRequest $request): UserUpdateResource
    {
        $data = $request->validated();
        if (Auth::check()) {
            $user = User::where('id', Auth::id())->first();
            if (isset($data['name'])) {
                $user->name = $data['name'];
            }
            if (isset($data['phone'])) {
                $user->phone = $data['phone'];
            }
            if (isset($data['email'])) {
                $user->email = $data['email'];
            }
            //        if (isset($data['password'])) {
            //            Hash::make($data['password']);
            //        }
            if (isset($data['company_name'])) {
                $user->company_name = $data['company_name'];
            }
            if (isset($data['company_address'])) {
                $user->company_address = $data['company_address'];
            }
            if (isset($data['company_phone'])) {
                $user->company_phone = $data['company_phone'];
            }
            if (isset($data['company_email'])) {
                $user->company_email = $data['company_email'];
            }
            if (isset($data['company_NPWP'])) {
                $user->company_NPWP = $data['company_NPWP'];
            }

            $user->save();
        }

        return new UserUpdateResource($user);
    }

    public function getDetails(int $userId)
    {
        $user = Auth::user();

        $userDetail = User::where('id', $userId)->first();
        // If not found
        if (!$userDetail) {
            throw new HttpResponseException(
                response([
                    "errors" => [
                        "message" => [
                            "User not found."
                        ]
                    ]
                ], 404)
            );
        }
        return response()->json([
            'data' => $userDetail,
        ], 200);
    }

    public function search(Request $request): JsonResponse
    {

        // Only return users with role 'user'
        $users = User::query()->where('role', 'user')->get();

        return response()->json(
            $users,
            200
        );
    }

    public function get(Request $request): JsonResponse
    {
        if (Auth::check()) {
            $user = User::where('id', Auth::id())->first();
        }
        return response()->json([

            'data' => $user,
        ], 200);
    }

    public function pendingUserSearch(Request $request): JsonResponse
    {

        // Only return users with role 'user' and status 'pending'
        $users = User::query()->where('role', 'user')->where('status', 'pending')->orderBy('created_at', 'desc')->get();

        return response()->json([
            'data' => $users,
        ], 200);
    }

    public function approvedUserSearch(Request $request): JsonResponse
    {

        // Only return users with role 'user' and status 'approved'
        $users = User::query()->where('role', 'user')->where('status', 'approved')->orderBy('approvedDate', 'desc')->get();

        return response()->json([
            'data' => $users,
        ], 200);
    }

    public function rejectedUserSearch(Request $request): JsonResponse
    {

        //        Only return users with role 'user' and status 'rejected'
        //        order by rejectedDate from the latest
        $users = User::query()->where('role', 'user')->where('status', 'rejected')->orderBy('rejectedDate', 'desc')->get();

        return response()->json([
            'data' => $users,
        ], 200);
    }

    public function approveUser(int $userId, Request $request)
    {
        $user = User::where('id', $userId)->first();
        $user->status = "approved";
        $user->approvedDate = Carbon::parse($request->approvedDate)->format('Y-m-d H:i:s');
        $user->save();

        return response()->json([
            'message' => 'User approved.'
        ])->setStatusCode(200);
    }

    public function rejectUser(int $userId, Request $request)
    {
        $user = User::where('id', $userId)->first();
        $user->status = "rejected";
        $user->rejectedDate = Carbon::parse($request->rejectedDate)->format('Y-m-d H:i:s');
        $user->save();

        return response()->json([
            'message' => 'User rejected.'
        ])->setStatusCode(200);
    }
}
