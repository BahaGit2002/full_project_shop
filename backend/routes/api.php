<?php

use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::controller(ProductController::class)->prefix('products')->group(function () {
    Route::get('/sale', 'sale');
    Route::get('', 'index');
    Route::get('/{id}', 'show');
});

Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::middleware('auth:api')->group(function () {
       Route::post('/logout', 'logout');
    });
});

Route::controller(UserController::class)->prefix('users')->group(function () {
    Route::middleware('auth:api')->group(function () {
        Route::get('/me', 'me');
        Route::put('/update', 'update');
    });
});

Route::controller(FavoriteController::class)->prefix('favorites')->group(function () {
   Route::middleware('auth:api')->group(function () {
       Route::get('', 'index');
       Route::post('', 'store');
       Route::delete('/{productId}', 'destroy');
   });
});
