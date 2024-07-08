<?php

use Illuminate\Support\Facades\Route;

// login. All roles can access this route
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);

// logout. All roles can access this route
Route::delete('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout'])->middleware('auth:sanctum');

// register. Only customer can access this route
Route::post('/customer/register', [App\Http\Controllers\Api\AuthController::class, 'customerRegister']);

// get currency. All roles can access this route
Route::get('/currencies', [App\Http\Controllers\Api\CurrencyController::class, 'index'])->middleware('auth:sanctum');

// Get user detail from authenticated user. All roles can access this route
Route::get('/user', [App\Http\Controllers\Api\UserController::class, 'getUserDetail'])->middleware('auth:sanctum');

// update authenticated user info. All roles can access this route
// This use POST method because Laravel doesn't support PUT method for updating file
// Use POST method with '_method' key and 'PUT' value
Route::post('/user', [App\Http\Controllers\Api\UserController::class, 'update'])->middleware('auth:sanctum');

// Get all users that have role 'customer'. If 'status' specified, then get all users with that status. Only admin can access this route
// This is based on migration status enum
// /users?status=pending
// /users?status=approved
// /users?status=rejected
Route::get('/users', [App\Http\Controllers\Api\UserController::class, 'index'])->middleware('auth:sanctum');

// get detail from a specific user. Only admin can access this route
Route::get('/users/{userId}', [App\Http\Controllers\Api\UserController::class, 'show'])->where('id', '[0-9]+')->middleware('auth:sanctum');

// Approve user. Only admin can access this route
Route::patch('/users/{userId}/approve', [App\Http\Controllers\Api\UserController::class, 'approveUser'])->middleware('auth:sanctum');

// Reject user. Only admin can access this route
Route::patch('/users/{userId}/reject', [App\Http\Controllers\Api\UserController::class, 'rejectUser'])->middleware('auth:sanctum');

// Get all orders. If 'status' specified, then get all orders with that status. All roles can access this route
// This is based on migration status enum
// /orders?status=order_pending
// /orders?status=payment_pending
// /orders?status=on_shipping
// /orders?status=order_completed
// /orders?status=order_canceled
// /orders?status=order_rejected
// /orders?status=on_process  -> for admin. To check all orders that are not order_pending, order_completed, order_canceled, order_rejected
Route::get('/orders', [App\Http\Controllers\Api\OrderController::class, 'index'])->middleware('auth:sanctum');

// Create order.
Route::post('/order', [App\Http\Controllers\Api\OrderController::class, 'store'])->middleware('auth:sanctum');
// get detail from a specific transaction. All roles can access this route
Route::get('/orders/{transactionId}', [App\Http\Controllers\Api\OrderController::class, 'show'])->middleware('auth:sanctum');

// Approve order. Only admin can access this route
Route::patch('/orders/{transactionId}/approve', [App\Http\Controllers\Api\OrderController::class, 'approveOrder'])->middleware('auth:sanctum');

// Reject order. Only admin can access this route
Route::patch('/orders/{transactionId}/reject', [App\Http\Controllers\Api\OrderController::class, 'rejectOrder'])->middleware('auth:sanctum');

// Cancel order. Only customer can access this route
Route::patch('/orders/{transactionId}/cancel', [App\Http\Controllers\Api\OrderController::class, 'cancelOrder'])->middleware('auth:sanctum');

// Get all conferences. If 'status' specified, then get all conferences with that status. Only admin can access this route
// This is based on migration status enum
// /conferences?status=pending
// /conferences?status=approved
// /conferences?status=rejected
Route::get('/conferences', [App\Http\Controllers\Api\ConferenceController::class, 'index'])->middleware('auth:sanctum');

// Get detail conference from a specific transaction. Only admin can access this route
Route::get('/conferences/{transactionId}', [App\Http\Controllers\Api\ConferenceController::class, 'show'])->middleware('auth:sanctum');

// Approve conference. Only admin can access this route
Route::patch('/conferences/{transactionId}/approve', [App\Http\Controllers\Api\ConferenceController::class, 'approveConference'])->middleware('auth:sanctum');

// Reject conference. Only admin can access this route
Route::patch('/conferences/{transactionId}/reject', [App\Http\Controllers\Api\ConferenceController::class, 'rejectConference'])->middleware('auth:sanctum');

// Add conference. Only customer can access this route
// TODO: Pastikan apakah benar benar customer atau semuanya bisa akses. tadi bingung
Route::post('/addConference', [App\Http\Controllers\Api\ConferenceController::class, 'store'])->middleware('auth:sanctum');

// Get all ports. All roles can access this route
Route::get('/ports', [App\Http\Controllers\Api\PortController::class, 'index'])->middleware('auth:sanctum');


Route::post('/checkQuotation', [App\Http\Controllers\Api\OrderController::class, 'checkQuotation'])->middleware('auth:sanctum');

// Upload document. All roles can access this route
// Route::post('/documents', [App\Http\Controllers\Api\DocumentController::class, 'store'])->middleware('auth:sanctum');

// Get all documents from a specified transaction_id. All roles can access this route
Route::get('/documents/{transactionId}', [App\Http\Controllers\Api\DocumentController::class, 'show'])->middleware('auth:sanctum');

// Update document. All roles can access this route
Route::put('/documents/{transactionId}', [App\Http\Controllers\Api\DocumentController::class, 'update'])->middleware('auth:sanctum');

// Get payments from an authenticated user. Only customer can access this route
Route::get('/payments', [App\Http\Controllers\Api\PaymentController::class, 'index'])->middleware('auth:sanctum');

// Get payment options
Route::get('/payment-options/{transactionId}', [App\Http\Controllers\Api\PaymentController::class, 'getPaymentOptions'])->middleware('auth:sanctum');

// Create payment.
Route::post('/payments', [App\Http\Controllers\Api\PaymentController::class, 'store'])->middleware('auth:sanctum');


// Update document. All roles can access this route
Route::put('/upload-payment-proof/{transactionId}', [App\Http\Controllers\Api\PaymentController::class, 'uploadPaymentProof'])->middleware('auth:sanctum');

// Approve payment.
Route::patch('/payments/{transactionId}/approve', [App\Http\Controllers\Api\PaymentController::class, 'approvePayment'])->middleware('auth:sanctum');

// Reject payment.
Route::patch('/payments/{transactionId}/reject', [App\Http\Controllers\Api\PaymentController::class, 'rejectPayment'])->middleware('auth:sanctum');
