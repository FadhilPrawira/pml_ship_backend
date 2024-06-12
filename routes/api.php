<?php


use Illuminate\Support\Facades\Route;

// login
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);

// logout
Route::delete('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout'])->middleware('auth:sanctum');

// register
Route::post('/register', [App\Http\Controllers\Api\AuthController::class, 'register']);

// get currency
Route::get('/currencies', [App\Http\Controllers\Api\CurrencyController::class, 'index'])->middleware('auth:sanctum');

Route::get('/user', [App\Http\Controllers\Api\UserController::class, 'get'])->middleware('auth:sanctum');
Route::patch('/user', [App\Http\Controllers\Api\UserController::class, 'update'])->middleware('auth:sanctum');
Route::get('/users/{userId}', [App\Http\Controllers\Api\UserController::class, 'getDetails'])->where('id', '[0-9]+')->middleware('auth:sanctum');
Route::get('/users', [App\Http\Controllers\Api\UserController::class, 'search'])->middleware('auth:sanctum');
Route::get('/pendingUsers', [App\Http\Controllers\Api\UserController::class, 'pendingUserSearch'])->middleware('auth:sanctum');
Route::get('/approvedUsers', [App\Http\Controllers\Api\UserController::class, 'approvedUserSearch'])->middleware('auth:sanctum');
Route::get('/rejectedUsers', [App\Http\Controllers\Api\UserController::class, 'rejectedUserSearch'])->middleware('auth:sanctum');

Route::patch('/users/{userId}/approve', [App\Http\Controllers\Api\UserController::class, 'approveUser'])->middleware('auth:sanctum');
Route::patch('/users/{userId}/reject', [App\Http\Controllers\Api\UserController::class, 'rejectUser'])->middleware('auth:sanctum');


Route::get('/ports', [App\Http\Controllers\Api\PortController::class, 'get'])->middleware('auth:sanctum');
Route::post('/orderPort', [App\Http\Controllers\Api\OrderController::class, 'orderPort'])->middleware('auth:sanctum');
Route::post('/checkQuotation', [App\Http\Controllers\Api\OrderController::class, 'checkQuotation'])->middleware('auth:sanctum');
Route::patch('/placeQuotation', [App\Http\Controllers\Api\OrderController::class, 'placeQuotation'])->middleware('auth:sanctum');
Route::patch('/addShipperConsignee', [App\Http\Controllers\Api\OrderController::class, 'addShipperConsignee'])->middleware('auth:sanctum');
Route::post('/summaryOrder', [App\Http\Controllers\Api\OrderController::class, 'summaryOrder'])->middleware('auth:sanctum');

Route::post('/addConference', [App\Http\Controllers\Api\OrderController::class, 'addConference'])->middleware('auth:sanctum');
Route::get('/pendingConferences', [App\Http\Controllers\Api\OrderController::class, 'pendingConferenceSearch'])->middleware('auth:sanctum');
Route::get('/approvedConferences', [App\Http\Controllers\Api\OrderController::class, 'approvedConferenceSearch'])->middleware('auth:sanctum');
Route::get('/rejectedConferences', [App\Http\Controllers\Api\OrderController::class, 'rejectedConferenceSearch'])->middleware('auth:sanctum');

Route::patch('/conferences/{transactionId}/approve', [App\Http\Controllers\Api\OrderController::class, 'approveConference'])->middleware('auth:sanctum');
Route::patch('/conferences/{transactionId}/reject', [App\Http\Controllers\Api\OrderController::class, 'rejectConference'])->middleware('auth:sanctum');
Route::get('/conferences/{transactionId}', [App\Http\Controllers\Api\OrderController::class, 'getConferenceDetails'])->middleware('auth:sanctum');

Route::put('/updateDocument', [App\Http\Controllers\Api\OrderController::class, 'updateDocument'])->middleware('auth:sanctum');

Route::get('/history', [App\Http\Controllers\Api\HistoryController::class, 'index'])->middleware('auth:sanctum');
