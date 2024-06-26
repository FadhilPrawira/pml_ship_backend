<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use stdClass;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // Get customer by status for admin
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
            $customers = User::where('role', 'customer')
                ->where('status', 'like', "%{$request->status}%")
                ->get();

            if ($customers->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Customers with status ' . $request->status . ' not found',
                    'data' => []
                ])->setStatusCode(404);
            }
            return response()->json([
                'status' => 'success',
                'message' => $request->has('status') ? 'Get all customer by status ' . $request->status . ' success' : 'Get customers list success',
                'data' => $customers
            ])->setStatusCode(200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'You are not authorized to get user data. Must be an admin'
            ])->setStatusCode(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => ['max:100'],
            'phone' => ['max:20'],
            'email' => ['max:100', 'email'],
            // 'password' => [Password::min(8), 'max:255'],
            'company_name' => ['max:255'],
            'company_address' => ['max:255'],
            'company_phone' => ['max:20'],
            'company_email' => ['email', 'max:100'],
            'company_NPWP' => ['max:20'],
            // 'company_akta' => ['required', File::types(['pdf'])],
        ]);
        // Get all request data
        $data = $request->all();

        // Get the authenticated user
        $user = $request->user();

        // Update the user
        $user->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'User updated.',
            'data' => $user,
        ])->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     */

    public function show(int $userId)
    {
        // Get the user
        $customerDetail = User::where('id', $userId)->first();

        // Check if the user exists
        if (!$customerDetail) {
            return response()->json([
                'status' => 'error',
                'message' => 'Customer info not found',
                'data' => new stdClass(), // return empty object
            ])->setStatusCode(404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Get customer detail success',
            'data' => $customerDetail,
        ])->setStatusCode(200);
    }

    // Get user detail from authenticated user
    public function getUserDetail(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Get user detail success',
            'data' => $request->user()

        ])->setStatusCode(200);
    }

    // Approve user
    public function approveUser(int $userId, Request $request)
    {
        // Validate the request
        $request->validate([
            'approved_at' => 'required|date',
        ]);
        // Get the user
        $user = User::where('id', $userId)->first();

        // Check if the user exists
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found',
                'data' => new stdClass(), // return empty object
            ])->setStatusCode(404);
        }

        // Check if the status is pending
        if ($user->status != 'pending') {
            return response()->json([
                'status' => 'error',
                'message' => 'User status is not pending',
                'data' => $user,
            ])->setStatusCode(400);
        }
        // Change the status to approved
        $user->status = "approved";
        // Set the approved date
        $user->approved_at = Carbon::parse($request->approved_at)->format('Y-m-d H:i:s');
        // Save the user
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'User approved.',
            'data' => $user,
        ])->setStatusCode(200);
    }

    // Reject user
    public function rejectUser(int $userId, Request $request)
    {
        // Validate the request
        $request->validate([
            'rejected_at' => 'required|date',
        ]);
        // TODO: Add reject reason
        // Get the user
        $user = User::where('id', $userId)->first();
        // Check if the user exists
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found',
                'data' => new stdClass(), // return empty object
            ])->setStatusCode(404);
        }

        // Check if the status is pending
        if ($user->status != 'pending') {
            return response()->json([
                'status' => 'error',
                'message' => 'User status is not pending',
                'data' => $user,
            ])->setStatusCode(400);
        }

        // Change the status to rejected
        $user->status = "rejected";
        // Change the rejected date
        $user->rejected_at = Carbon::parse($request->rejected_at)->format('Y-m-d H:i:s');
        // Save the user
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'User rejected.',
            'data' => $user,
        ])->setStatusCode(200);
    }
}
