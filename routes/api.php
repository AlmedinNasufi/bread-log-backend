<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

Route::get("/products", [ProductController::class, "index"]);

// /api/
Route::controller(OrderController::class)->prefix("orders")->group(function() {
    Route::get('', 'index');
});

Route::controller(AuthController::class)->prefix('auth')->middleware('api')->group(function() {
    // Public routes
    Route::post('login', 'login')->name('auth.login');
    Route::post('register', 'register')->name('auth.register');
    Route::post('refresh', 'refresh')->name('auth.refresh');

    // Protected routes
    Route::middleware('jwt.auth.token')->group(function() {
        Route::post('logout', 'logout')->name('auth.logout');
        Route::get('me', 'me')->name('auth.me');
    });
});


