<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rules\File;

class AuthController extends Controller
{
    // login
    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => ['required', 'max:100', 'email'],
            'password' => ['required', Password::min(8), 'max:255'],
        ]);

        // Search by email
        $user = User::where('email', $request->email)->first();

        // Check if the user exists and if password correct
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email or password is incorrect.'
            ], 401);
        }
        // Generate token
        $auth_token = env('AUTH_TOKEN_SANCTUM', 'token_rahasia_default');
        $token = $user->createToken($auth_token)->plainTextToken;
        return response()->json([
            'status' => 'success',
            'message' => 'Login success',
            'data' => [
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                    'status' => $user->status,
                ],
                'token' => $token
            ]
        ]);
    }

    // logout
    public function logout(Request $request)
    {
        // Get the authenticated user
        $user = $request->user();

        // Revoke the token that was used to authenticate the current request
        $user->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Logout success'
        ]);
    }

    public function customerRegister(Request $request): JsonResponse
    {
        // Validate the request
        $request->validate([
            'name' => ['required', 'max:100'],
            'phone' => ['required', 'max:20'],
            'email' => ['required', 'max:100', 'email', 'unique:users,email'],
            'password' => ['required', Password::min(8), 'max:255'],
            'company_name' => ['required', 'max:255'],
            'company_address' => ['required', 'max:255'],
            'company_phone' => ['required', 'max:20'],
            'company_email' => ['required', 'email', 'max:100'],
            'company_NPWP' => ['required', 'max:20'],
            'company_akta' => ['required', File::types(['pdf'])],
        ]);


        // Get all request data
        $data = $request->all();

        // Store the file in variable
        $company_akta_file = $request->file('company_akta');

        // Set file name
        $cleaned_company_name = str_replace(" ", "_", $data['company_name']);
        $company_akta_filename = $cleaned_company_name . '.' . $company_akta_file->extension();


        // Store the image in the storage
        $company_akta_file->storeAs('public/file', $company_akta_filename);
        // http://localhost:8000/storage/file/YOUR_IMAGE_NAME.EXTENSION

        // Hash the password
        $data['password'] = Hash::make($data['password']);
        // Set the role to 'customer'
        $data['role'] = 'customer';
        // Set the status to 'pending'
        $data['status'] = 'pending';

        // Create a new user
        $user = new User();

        $user->status = $data['status'];
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
        // Update the user image path in database
        $user->company_akta = $company_akta_filename;

        // Save the user
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'User registered successfully',
            'data' => $user,
        ], 201);
    }

    // TODO: Implement Forgot Password
    // step 1: forgot password clicked/requested->create code->send code through email
    // public function forgotPassword(Request $request)
    // {
    //     $data = $request->validate([
    //         'email' => 'required|email|exists:users,email',
    //     ]);


    //     $user = User::where('email', $data['email'])->first();

    //     // Generate random code
    //     $code = rand(100000, 999999);

    //     // Save code to user
    //     $user->password_reset_code = $code;
    //     $user->save();

    //     // Send code to user email
    //     // Mail::to($user->email)->send(new ForgotPasswordMail($code));

    //     return response()->json([
    //         'data' => [
    //             'message' => 'Code has been sent to your email'
    //         ]
    //     ]);
    // }
    // step 2: user input code->check code
    // step 3: user input new password->update password



}
