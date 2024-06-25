<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;

// login
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);

// logout
Route::delete('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout'])->middleware('auth:sanctum');

// register
Route::post('/customer/register', [App\Http\Controllers\Api\AuthController::class, 'customerRegister']);

// get currency
Route::get('/currencies', [App\Http\Controllers\Api\CurrencyController::class, 'index'])->middleware('auth:sanctum');

// Get user detail from authenticated user
Route::get('/user', [App\Http\Controllers\Api\UserController::class, 'getUserDetail'])->middleware('auth:sanctum');

// update authenticated user info
Route::put('/user', [App\Http\Controllers\Api\UserController::class, 'update'])->middleware('auth:sanctum');

// Get all users that have role 'customer'. If 'status' specified, then get all users with that status
// This is based on migration status enum
// /users?status=pending
// /users?status=approved
// /users?status=rejected
Route::get('/users', [App\Http\Controllers\Api\UserController::class, 'index'])->middleware('auth:sanctum');

// get detail from a specific user. Only admin can get user detail
Route::get('/users/{userId}', [App\Http\Controllers\Api\UserController::class, 'show'])->where('id', '[0-9]+')->middleware('auth:sanctum');

Route::patch('/users/{userId}/approve', [App\Http\Controllers\Api\UserController::class, 'approveUser'])->middleware('auth:sanctum');
Route::patch('/users/{userId}/reject', [App\Http\Controllers\Api\UserController::class, 'rejectUser'])->middleware('auth:sanctum');


// Search order. All roles can access this route
// This is based on migration status enum
// /orders?status=order_pending
// /orders?status=payment_pending
// /orders?status=on_shipping
// /orders?status=order_completed
// /orders?status=order_canceled
// /orders?status=order_rejected
Route::get('/orders', [App\Http\Controllers\Api\OrderController::class, 'index'])->middleware('auth:sanctum');

// get detail from a specific transaction. All roles can access this route
Route::get('/orders/{transactionId}', [App\Http\Controllers\Api\OrderController::class, 'show'])->middleware('auth:sanctum');


Route::patch('/conferences/{transactionId}/approve', [App\Http\Controllers\Api\ConferenceController::class, 'approveConference'])->middleware('auth:sanctum');
Route::patch('/conferences/{transactionId}/reject', [App\Http\Controllers\Api\ConferenceController::class, 'rejectConference'])->middleware('auth:sanctum');

// Get detail conference from a specific transaction. Only admin can access this route
Route::get('/conferences/{transactionId}', [App\Http\Controllers\Api\ConferenceController::class, 'getConferenceDetails'])->middleware('auth:sanctum');
Route::get('/pendingConferences', [App\Http\Controllers\Api\ConferenceController::class, 'pendingConferenceSearch'])->middleware('auth:sanctum');
Route::get('/approvedConferences', [App\Http\Controllers\Api\ConferenceController::class, 'approvedConferenceSearch'])->middleware('auth:sanctum');
Route::get('/rejectedConferences', [App\Http\Controllers\Api\ConferenceController::class, 'rejectedConferenceSearch'])->middleware('auth:sanctum');


Route::get('/ports', [App\Http\Controllers\Api\PortController::class, 'get'])->middleware('auth:sanctum');
Route::post('/orderPort', [App\Http\Controllers\Api\OrderController::class, 'orderPort'])->middleware('auth:sanctum');
Route::post('/checkQuotation', [App\Http\Controllers\Api\OrderController::class, 'checkQuotation'])->middleware('auth:sanctum');
Route::patch('/placeQuotation', [App\Http\Controllers\Api\OrderController::class, 'placeQuotation'])->middleware('auth:sanctum');
Route::patch('/addShipperConsignee', [App\Http\Controllers\Api\OrderController::class, 'addShipperConsignee'])->middleware('auth:sanctum');
Route::post('/summaryOrder', [App\Http\Controllers\Api\OrderController::class, 'summaryOrder'])->middleware('auth:sanctum');

Route::post('/addConference', [App\Http\Controllers\Api\ConferenceController::class, 'addConference'])->middleware('auth:sanctum');



Route::put('/updateDocument', [App\Http\Controllers\Api\OrderController::class, 'updateDocument'])->middleware('auth:sanctum');
