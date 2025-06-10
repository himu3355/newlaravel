<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/cart/sync', [CartController::class, 'sync']);
Route::get('/cart/user/{user}', [CartController::class, 'getUserCart']);
Route::delete('/cart/user/{userId}/product/{productId}', [CartController::class, 'removeCartItem']);

Route::prefix('v1')->group(function () {
    Route::get('products', [ProductController::class, 'indexApi']);
    Route::get('products/{slug}', [ProductController::class, 'showApi']);
});

