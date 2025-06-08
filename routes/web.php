<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\ProductController;
use \App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('layouts.admin_layout');
});

Route::get('users', [UserController::class, 'index'])->name('users');
Route::post('user-store', [UserController::class, 'store'])->name('store-users');
Route::get('user-edit/{id}', [UserController::class, 'edit'])->name('user-edit');
Route::put('user-update/{id}', [UserController::class, 'update'])->name('update-users');
Route::delete('user-delete/{id}', [UserController::class, 'delete'])->name('delete-user');

Route::post('login', [AuthController::class, 'login'])->name('login');

Route::get('products', [ProductController::class, 'index'])->name('products');
Route::get('create', [ProductController::class, 'create'])->name('create-product');
Route::get('store-product', [ProductController::class, 'store'])->name('store-product');
Route::get('/subcategories/{category_id}', [ProductController::class, 'getSubcategories']);
