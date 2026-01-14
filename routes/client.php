<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:client')->prefix('client')->group(function () {
    Route::get('/dashboard', [ClientController::class, 'index'])->name('get.client');
//    Route::get('addList', [ClientController::class, 'addList'])->name('client.addList');
    Route::get('/products/create', [ClientController::class, 'createProduct'])->name('client.products.create');
    Route::post('/products/store', [ClientController::class, 'storeProduct'])->name('client.products.store');

});
