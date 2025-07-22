<?php

use App\Http\Controllers\Admin\BallsController;
use App\Http\Controllers\Admin\ManagerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;
use \App\Http\Controllers\Admin\ProductViewController;
use \App\Http\Controllers\Admin\ReservationProductController;
use Illuminate\Support\Facades\Route;


//Route::get('/', function () {
//    return view('Admin.auth.login');
//})->name('login.form');

Route::get('/', [AuthController::class, 'index'])->name('login.index');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth')->group(function () {

    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::post('user-store', [UserController::class, 'store'])->name('store-users');
    Route::get('user-edit/{id}', [UserController::class, 'edit'])->name('user-edit');
    Route::put('user-update/{id}', [UserController::class, 'update'])->name('update-users');
    Route::delete('user-delete/{id}', [UserController::class, 'delete'])->name('delete-user');

    Route::get('manager', [ManagerController::class, 'index'])->name('manager');
    Route::get('create-product', [ManagerController::class, 'create'])->name('manager-create-product');
    Route::post('manager-store-product', [ManagerController::class, 'store'])->name('manager-store-products');
    Route::post('/manager/reveal-phone/{product}', [ManagerController::class, 'revealPhone'])->name('manager.reveal-phone');
    Route::get('/manager/seen-products', [ManagerController::class, 'seenProducts'])->name('manager.seen-products');
    Route::get('show-product/{id}', [ManagerController::class, 'show'])->name('show-product');
    Route::get('view-info', [ProductViewController::class, 'index'])->name('view-products');
    Route::get('/users/{user}/product-views', [ProductViewController::class, 'byUser'])->name('user.product.views');
    Route::delete('/product-views/{id}', [ProductViewController::class, 'deleteViewProduct'])->name('product-view.delete');
    Route::get('reservations',[ReservationProductController::class,'index'])->name('reservations');
    Route::get('get-reservations',[ReservationProductController::class,'search'])->name('reservations.search');
    Route::post('store-reservations',[ReservationProductController::class,'store'])->name('reservations.store');


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

    Route::get('user-products', [\App\Http\Controllers\Admin\ManagerController::class, 'index'])->name('manager-products');

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
