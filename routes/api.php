<?php

use App\Models\Category;
use App\Models\Product;
use App\Http\Controllers\ProductoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Models\Order;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('products', ProductoController::class);
Route::apiResource('orders', OrderController::class);
Route::apiResource('orders', OrderController::class);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/me', [AuthController::class, 'me']);


Route::get('/meByEmail', [AuthController::class, 'meByEmail']);