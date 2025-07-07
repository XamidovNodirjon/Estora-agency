<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use \App\Http\Controllers\BallsController;

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
})->name('login.form');

Route::post('login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth')->group(function () {

    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::post('user-store', [UserController::class, 'store'])->name('store-users');
    Route::get('user-edit/{id}', [UserController::class, 'edit'])->name('user-edit');
    Route::put('user-update/{id}', [UserController::class, 'update'])->name('update-users');
    Route::delete('user-delete/{id}', [UserController::class, 'delete'])->name('delete-user');

    Route::get('products', [ProductController::class, 'index'])->name('products');
    Route::get('create', [ProductController::class, 'create'])->name('create-product');
    Route::post('store-product', [ProductController::class, 'store'])->name('store-product');
    Route::get('/subcategories/{category_id}', [ProductController::class, 'getSubcategories']);
    Route::get('edit-product/{id}', [ProductController::class, 'edit'])->name('edit-product');
    Route::put('update-product/{id}', [ProductController::class, 'update'])->name('update-product');
    Route::post('create-ball/{id}', [BallsController::class, 'store'])->name('create-ball');
    Route::put('/users/{user}/balls', [BallsController::class, 'updateBall'])->name('users.balls.update');

    Route::get('/get-cities/{region_id}', function ($region_id) {
        return \App\Models\City::where('region_id', $region_id)->select('id', 'name')->get();
    });

    Route::get('user-products', [\App\Http\Controllers\ManagerController::class, 'index'])->name('manager-products');

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
