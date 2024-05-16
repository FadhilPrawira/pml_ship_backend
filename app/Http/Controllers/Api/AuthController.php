<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // login
    public function login(UserLoginRequest $request): UserResource
    {

        $data = $request->validated();
        $user = User::where('email', $data['email'])->first();

        // check if user exists
        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw new HttpResponseException(
                response([
                    "errors" => [
                        "message" => [
                            "Email or password is incorrect."
                        ]
                    ]
                ], 401)
            );
        }


        //        $user->createToken('auth_token')->plainTextToken;
        $user->save();

        //        return new UserResource($user);
        $auth_token = env('AUTH_TOKEN_SANCTUM', 'token_rahasia_default');
        return (new UserResource($user))->additional([
            'token' => $user->createToken($auth_token)->plainTextToken,
        ]);
    }

    // logout
    public function logout(Request $request): JsonResponse
    {

        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'data' => [
                'message' => 'Logged out successfully'
            ]
        ], 200);


        //            If user not authenticated, this will return
        //        {
        //            "data": {
        //            "message": "User unauthorized"
        //             }
        //         }

        //        Edit custom message in \vendor\laravel\framework\src\Illuminate\Foundation\Exceptions\Handler.php
        //        On function ExceptionHandler@register
        //        Reference: https://stackoverflow.com/questions/68516285/customize-laravel-sanctum-unauthorize-response


    }
    // I think we better use throw HttpResponseException than edit custom message in Handler.php
    //throw new HttpResponseException(
    //response([
    //"errors" => [
    //"email" => [
    //"The email has already exist."
    //]
    //]
    //], 400)
    //);


    //    public function logout(Request $request){
    //
    //
    //        if (Auth::check()) {
    //
    //            $request->user()->currentAccessToken()->delete();
    //
    //            return response()->json([
    //                'data' => [
    //                'message' => 'Logged out successfully'
    //                    ]
    //            ]);
    //        }
    //
    //        return response()->json([
    //            'data' => [
    //            'message' => 'Logged out failed'
    //                ]
    //        ])->setStatusCode(400);
    //
    //    }


    public function register(UserRegisterRequest $request): JsonResponse
    {
        $data = $request->validated();
        //        Check if email already exist
        if (User::where('email', $data['email'])->exists()) {
            throw new HttpResponseException(
                response([
                    "errors" => [
                        "email" => [
                            "The email has already exist."
                        ]
                    ]
                ], 400)
            );
        }
        //        Set default role
        $data['role'] = 'user';
        //        Hash password
        $data['password'] = Hash::make($data['password']);

        //        Create user/Input into database
        $user = User::create($data);

        return (new UserResource($user))->response()->setStatusCode(201);
    }
}
