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
        // $user = User::create($data);

        // Create a new user
        $user = new User();

        $user->role = $data['role'];
        $user->name = $data['name'];
        $user->phone = $data['phone'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->company_name = $data['company_name'];
        $user->company_address = $data['company_address'];
        $user->company_phone = $data['company_phone'];
        $user->company_email = $data['company_email'];
        $user->company_NPWP = $data['company_NPWP'];

        $user->save();

        // Check if file is not empty and file is uploaded
        if ($request->hasFile('company_akta_url')) {

            // Get the file
            $company_akta_url = $request->file('company_akta_url');

            // Set file name
            $file_name = $user->company_name . '-' . $user->id . '.' . $company_akta_url->extension();

            // Store the new file
            $company_akta_url->storeAs('public/documents', $file_name);

            // Update the user file path in databases
            $user->company_akta_url = 'documents/' . $file_name;

            $user->save();
        }

        return (new UserResource($user))->response()->setStatusCode(201);
    }

    // TODO: Implement Forgot Password
    // step 1: forgot password clicked/requested->create code->send code through email
    public function forgotPassword(Request $request): JsonResponse
    {
        $data = $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $data['email'])->first();

        // Generate random code
        $code = rand(100000, 999999);

        // Save code to user
        $user->password_reset_code = $code;
        $user->save();

        // Send code to user email
        // Mail::to($user->email)->send(new ForgotPasswordMail($code));

        return response()->json([
            'data' => [
                'message' => 'Code has been sent to your email'
            ]
        ]);
    }
    // step 2: user input code->check code
    // step 3: user input new password->update password


}
