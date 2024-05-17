<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserSearchResource;
use App\Http\Resources\UserUpdateResource;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function get(Request $request): JsonResponse
    {
        if (Auth::check()) {
            $user = User::where('id', Auth::id())->first();
        }
        return response()->json([

            'data' => $user,
        ], 200);
    }

    public function update(UserUpdateRequest $request): UserUpdateResource
    {
        $data = $request->validated();
        $user = Auth::user();
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
        $user = Auth::user();
        //        $page = $request->input('page', 1);
        //        $size = $request->input('size', 10);

        // Only return users with role 'user'
        $users = User::query()->where('role', 'user')->paginate(10);

        return response()->json(
            $users,
            200
        );
    }
}
