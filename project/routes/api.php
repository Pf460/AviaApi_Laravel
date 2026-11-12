<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Общие роуты
Route::get('products', [ProductController::class, 'index']);
Route::get('products/{ticket}', [ProductController::class, 'show']);
Route::post('login', [AuthController::class, 'login']);
Route::post('signup', [AuthController::class, 'signUp']);

//Роуты действия с аккаунтом + выход
Route::middleware('auth:sanctum')->group(function () {
    Route::get('profile', [AuthController::class, 'profile']);
    Route::patch('profile', [AuthController::class, 'updateProfile']);
    Route::get('logout', [AuthController::class, 'logout']);
});

//Роуты CRUD
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('products', [AdminController::class, 'index']);
        Route::get('products/{ticket}', [AdminController::class, 'show']);
        Route::post('products', [AdminController::class, 'store']);
        Route::patch('products/{ticket}', [AdminController::class, 'edit']);
        Route::delete('products/{ticket}', [AdminController::class, 'destroy']);
    });
});

Route::middleware(['auth:sanctum', 'role:user'])->group(function () {
    Route::get('cart', [CartController::class, 'index']);
    Route::post('cart/{product}', [CartController::class, 'add']);
    Route::delete('cart/{cartItem}', [CartController::class, 'destroy']);

    Route::get('order', [OrderController::class, 'index']);
    Route::post('order', [OrderController::class, 'store']);
});
