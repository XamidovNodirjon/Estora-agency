<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:client')->prefix('client')->group(function () {
    Route::get('/dashboard', [ClientController::class, 'index'])->name('get.client');
    Route::get('/all-ads', [ClientController::class, 'allAds'])->name('client.products.all');
    Route::get('/my-ads', [ClientController::class, 'myProducts'])->name('client.products.index');
    Route::get('/likes', [ClientController::class, 'likes'])->name('client.likes');
    Route::get('/products/create', [ClientController::class, 'createProduct'])->name('client.products.create');
    Route::post('/products/store', [ClientController::class, 'storeProduct'])->name('client.products.store');
});
