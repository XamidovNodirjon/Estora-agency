<?php

use App\Http\Controllers\Admin\BallsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ManagerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductFeaturesController;
use App\Http\Controllers\Admin\ProductViewController;
use App\Http\Controllers\Admin\ReservationProductController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;
use \App\Http\Controllers\Admin\MetroController;
use \App\Http\Controllers\Admin\UniversityController;
use Illuminate\Support\Facades\Route;

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'uz', 'ru'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');


Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/products/filter', [HomeController::class, 'filterProducts'])->name('products.filter');
Route::get('/products/{product}', [HomeController::class, 'showProduct'])->name('products.show');
Route::get('login', [AuthController::class, 'index'])->name('login.index');
Route::post('login', [AuthController::class, 'login'])->name('login.store');
Route::get('register', [AuthController::class, 'getRegister'])->name('getRegister');
Route::post('register/create', [AuthController::class, 'register'])->name('register');

Route::middleware('auth')->group(function () {

    Route::get('admin-dashboard', [DashboardController::class, 'index'])->name('admin-dashboard');
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
    Route::get('reservations', [ReservationProductController::class, 'index'])->name('reservations');
    Route::get('get-reservations', [ReservationProductController::class, 'search'])->name('reservations.search');
    Route::post('store-reservations', [ReservationProductController::class, 'store'])->name('reservations.store');


    Route::get('products', [ProductController::class, 'index'])->name('products');
    Route::post('products/assign-manager', [ProductController::class, 'assignManager'])->name('products.assign-manager');
    Route::get('show-products/{id}', [ProductController::class, 'show'])->name('show-products');
    Route::get('create', [ProductController::class, 'create'])->name('create-product');
    Route::post('store-product', [ProductController::class, 'store'])->name('store-product');
    Route::get('/subcategories/{category_id}', [ProductController::class, 'getSubcategories']);
    Route::get('edit-product/{id}', [ProductController::class, 'edit'])->name('edit-product');
    Route::put('update-product/{id}', [ProductController::class, 'update'])->name('update-product');
    Route::post('create-ball/{id}', [BallsController::class, 'store'])->name('create-ball');
    Route::put('/users/{user}/balls', [BallsController::class, 'updateBall'])->name('users.balls.update');
    Route::delete('products-delete/{id}', [ProductController::class, 'destroy'])->name('delete.product');
    Route::get('product-features', [ProductFeaturesController::class, 'index'])->name('product.features');
    Route::post('product-features', [ProductFeaturesController::class, 'store'])->name('product.features.store');
    Route::put('product-features/{id}', [ProductFeaturesController::class, 'update'])->name('product.features.update');
    Route::delete('product-features/{id}', [ProductFeaturesController::class, 'destroy'])->name('product.features.destroy');

    Route::post('/admin/metros', [MetroController::class, 'storeMetro'])->name('metro.store');
    Route::put('/admin/metros/{id}', [MetroController::class, 'updateMetro'])->name('metro.update');
    Route::delete('/admin/metros/{id}', [MetroController::class, 'destroyMetro'])->name('metro.destroy');

    Route::post('/admin/universities', [UniversityController::class, 'storeUniversity'])->name('university.store');
    Route::put('/admin/universities/{id}', [UniversityController::class, 'updateUniversity'])->name('university.update');
    Route::delete('/admin/universities/{id}', [UniversityController::class, 'destroyUniversity'])->name('university.destroy');

    Route::get('user-products', [\App\Http\Controllers\Admin\ManagerController::class, 'index'])->name('manager-products');

    Route::resource('lisds', \App\Http\Controllers\Admin\LisdController::class)->middleware('role:1,2');

    Route::get('manager-dashboard', [ManagerController::class, 'dashboard'])->name('manager.dashboard');
    Route::get('manager-leads', [ManagerController::class, 'leads'])->name('manager.leads');
    
    // Manager Tasks
    Route::get('manager-tasks', [ManagerController::class, 'tasks'])->name('manager.tasks');
    Route::post('manager-tasks/{id}/status', [ManagerController::class, 'updateTaskStatus'])->name('manager.tasks.status');

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/get-cities/{region_id}', function ($region_id) {
    return \App\Models\City::where('region_id', $region_id)->select('id', 'name')->get();
})->name('get-cities');
