<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CurrencyRateController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('me', [AuthController::class, 'me']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::middleware('admin')->group(function () {
        Route::resource('users', UserController::class);
        Route::post('currency-rate/refresh', [CurrencyRateController::class, 'refresh']);
    });

    Route::get('currency-rate', [CurrencyRateController::class, 'index']);
});
