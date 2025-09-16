<?php

use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('user', [\App\Http\Controllers\UserController::class, 'store']);

Route::get('users',[UserController::class, 'index']);

Route::get('/dashboard', [HomeController::class, 'dashboard']);
Route::get('/products', [HomeController::class, 'filterProducts']);
Route::get('/products/{product}', [HomeController::class, 'showProduct']);
