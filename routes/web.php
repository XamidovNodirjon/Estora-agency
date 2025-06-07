<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('layouts.admin_layout');
});

Route::get('users', [UserController::class, 'index'])->name('users');
Route::post('user-store', [UserController::class, 'store'])->name('store-users');
Route::get('user-edit/{id}', [UserController::class, 'edit'])->name('user-edit');
Route::put('user-update/{id}', [UserController::class, 'update'])->name('update-users');
Route::delete('user-delete/{id}', [UserController::class, 'delete'])->name('delete-user');
