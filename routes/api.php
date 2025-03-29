<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Mail\TestMail;

Route::controller(ProductController::class)->prefix("products")->group(function() {

    Route::middleware('jwt.auth.token')->group(function() {
        Route::get('', 'index');
        Route::get("/{id}", "show");
        Route::post('', 'store');
        Route::put("/{id}", "update");
        Route::delete("/{id}", "destroy");
    });
});

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

Route::get('test-mail', function() {
    Mail::to('almedin.nasufi20@gmail.com')->send(new TestMail([
        'title' => 'The Title',
        'body' => 'The Body',
    ]));
});


