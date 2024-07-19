<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserDetailResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;
use stdClass;

use function PHPUnit\Framework\isEmpty;

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

            // 'Order by' different at different status
            // Example: 'Order by' created_at for 'pending' status, 'Order by' approved_at for 'approved' status, 'Order by' rejected_at for 'rejected' status
            if ($request->status == 'pending') {
                $orderByRule = 'created_at';
            } else if ($request->status == 'approved') {
                $orderByRule = 'approved_at';
            } else if ($request->status == 'rejected') {
                $orderByRule = 'rejected_at';
            } else {
                $orderByRule = 'created_at';
            }

            // Get the customers
            $customers = User::where('role', 'customer')
                ->where('status', 'like', "%{$request->status}%")
                ->orderBy($orderByRule, 'desc')
                ->get();

            // Check if the customers is empty
            if ($customers->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Customers with status ' . $request->status . ' not found',
                    'data' => []
                ])->setStatusCode(404);
            }
            // return response()->json([
            //     'status' => 'success',
            //     'message' => $request->has('status') ? 'Get all customer by status ' . $request->status . ' success' : 'Get customers list success',
            //     'data' => $customers
            // ])->setStatusCode(200);

            return response()->json([
                'status' => 'success',
                'message' => $request->has('status') ? 'Get all customer by status ' . $request->status . ' success' : 'Get customers list success',
                'data' => UserDetailResource::collection($customers)
            ])->setStatusCode(200);
        } else {
            // If the user is not an admin
            return response()->json([
                'status' => 'error',
                'message' => 'You are not authorized to get user data. Must be an admin'
            ])->setStatusCode(403);
        }
    }

    /**
     * Display the specified resource.
     */
    // Get user detail by id
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

        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'Get customer detail success',
        //     'data' => $customerDetail,
        // ])->setStatusCode(200);

        return response()->json([
            'status' => 'success',
            'message' => 'Get customer detail success',
            'data' => new UserDetailResource($customerDetail),
        ])->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // TODO: Add update akta perusahaan
        // Validate the request
        $request->validate([
            'name' => ['max:100'],
            'phone' => ['max:20'],
            'email' => ['max:100', 'email'],
            // 'password' => [Password::min(8), 'max:255'],
            // If the password is not empty, then validate the password
            'password' => ['nullable', Password::min(8), 'max:255'],
            'company_name' => ['max:255'],
            'company_address' => ['max:255'],
            'company_phone' => ['max:20'],
            'company_email' => ['email', 'max:100'],
            'company_NPWP' => ['max:20'],
            'company_akta' => [File::types(['pdf'])],
        ]);

        // Get the authenticated user
        $user = $request->user();

        // Get all request data
        $data = $request->all();

        // Check if the form-data request has 'company_akta' as key
        if ($request->hasFile('company_akta')) {

            // Store the file in variable
            $new_company_akta_file = $request->file('company_akta');

            // Set company_akta file name
            $new_cleaned_company_name = str_replace(" ", "_", $data['company_name']);
            $new_company_akta_filename = $new_cleaned_company_name . '.' . $new_company_akta_file->extension();

            // Delete the old company_akta file if it exists
            if ($user->company_akta) {
                // path to the company_akta file
                $old_company_akta = 'public/documents/' . $user->image;
                Storage::delete($old_company_akta);
            }

            // Store the company_akta file in the storage
            $new_company_akta_file->storeAs('public/file', $new_company_akta_filename);
            // http://localhost:8000/storage/file/YOUR_IMAGE_NAME.EXTENSION
        } else {
            // If the request does not have 'company_akta' key
            // Set the company_akta file to the old company_akta file
            $new_company_akta_file = $user->company_akta;
        }

        // Update the user.
        $user->update([
            'name' => $data['name'] ?? $user->name,
            'phone' => $data['phone'] ?? $user->phone,
            'email' => $data['email'] ?? $user->email,
            // If key password is in the request and not null, then update the password. If not, then use the old password
            'password' => $data['password'] ? Hash::make($data['password']) : $user->password,
            'company_name' => $data['company_name'] ?? $user->company_name,
            'company_address' => $data['company_address'] ?? $user->company_address,
            'company_phone' => $data['company_phone'] ?? $user->company_phone,
            'company_email' => $data['company_email'] ?? $user->company_email,
            'company_NPWP' => $data['company_NPWP'] ?? $user->company_NPWP,

            'company_akta' => $new_company_akta_filename ?? $user->company_akta,
        ]);






        return response()->json([
            'status' => 'success',
            'message' => 'User updated.',
            'data' => new UserDetailResource($user),
        ])->setStatusCode(200);
    }

    // Get user detail from authenticated user
    public function getUserDetail(Request $request)
    {
        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'Get user detail success',
        //     'data' => $request->user()

        // ])->setStatusCode(200);

        return response()->json([
            'status' => 'success',
            'message' => 'Get user detail success',
            'data' => new UserDetailResource($request->user())

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
                'data' => new UserDetailResource($user),
            ])->setStatusCode(400);
        }
        // Change the status to approved
        $user->status = "approved";
        // Set the approved date
        $user->approved_at = Carbon::parse($request->approved_at)->format('Y-m-d H:i:s');
        // Save the user
        $user->save();

        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'User approved.',
        //     'data' => $user,
        // ])->setStatusCode(200);

        return response()->json([
            'status' => 'success',
            'message' => 'User approved.',
            'data' => new UserDetailResource($user),
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
            // return response()->json([
            //     'status' => 'error',
            //     'message' => 'User status is not pending',
            //     'data' => $user,
            // ])->setStatusCode(400);

            return response()->json([
                'status' => 'error',
                'message' => 'User status is not pending',
                'data' => new UserDetailResource($user),
            ])->setStatusCode(400);
        }

        // Change the status to rejected
        $user->status = "rejected";
        // Change the rejected date
        $user->rejected_at = Carbon::parse($request->rejected_at)->format('Y-m-d H:i:s');
        // Save the user
        $user->save();

        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'User rejected.',
        //     'data' => $user,
        // ])->setStatusCode(200);

        return response()->json([
            'status' => 'success',
            'message' => 'User rejected.',
            'data' => new UserDetailResource($user),
        ])->setStatusCode(200);
    }
}
