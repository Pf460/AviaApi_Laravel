<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Общие роуты
Route::get('products', [TicketController::class, 'index']);
Route::get('products/{ticket}', [TicketController::class, 'show']);
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
