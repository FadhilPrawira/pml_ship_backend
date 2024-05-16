<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// login
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);

// logout
Route::delete('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout'])->middleware('auth:sanctum');

// register
Route::post('/register', [App\Http\Controllers\Api\AuthController::class, 'register']);

Route::get('/user', [App\Http\Controllers\Api\UserController::class, 'get'])->middleware('auth:sanctum');
Route::patch('/user', [App\Http\Controllers\Api\UserController::class, 'update'])->middleware('auth:sanctum');
Route::get('/users/{userId}', [App\Http\Controllers\Api\UserController::class, 'getDetails'])->where('id', '[0-9]+')->middleware('auth:sanctum');
Route::get('/users', [App\Http\Controllers\Api\UserController::class, 'search'])->middleware('auth:sanctum');

Route::get('/ports', [App\Http\Controllers\Api\PortController::class, 'get'])->middleware('auth:sanctum');
Route::post('/orderPort', [App\Http\Controllers\Api\OrderController::class, 'orderPort'])->middleware('auth:sanctum');
Route::patch('/addShipperConsignee', [App\Http\Controllers\Api\OrderController::class, 'addShipperConsignee'])->middleware('auth:sanctum');
Route::post('/summaryOrder', [App\Http\Controllers\Api\OrderController::class, 'summaryOrder'])->middleware('auth:sanctum');
