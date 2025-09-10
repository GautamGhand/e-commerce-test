<?php

use App\Http\Controllers\Web\Admin\Auth\AuthController;
use App\Http\Controllers\Web\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Web\Admin\Product\ProductController;
use App\Http\Controllers\Web\Customer\Cart\CartController;
use App\Http\Controllers\Web\Customer\Home\HomeController;
use App\Http\Controllers\Web\Customer\Order\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Customer\Auth\AuthController as CustomerAuthController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/customer/login', [CustomerAuthController::class, 'index'])->name('customer.login.index');
Route::post('/customer/login', [CustomerAuthController::class, 'login'])->name('customer.login');

Route::middleware(['customer'])->group(function () {
    Route::get('/customer/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{uuid}/add', [CartController::class, 'addToCart'])->name('addToCart');
    Route::get('/orders',[OrderController::class,'index'])->name('orders.index');
    Route::get('/checkout',[OrderController::class,'checkout'])->name('checkout');
});

Route::middleware(['redirectAdmin'])->group(function () {
    Route::get('/admin/login', [AuthController::class, 'index'])->name('admin.login.index');
    Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login');
});

Route::middleware(['admin', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    //Product Routes
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{uuid}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::post('/products/{uuid}/update', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{uuid}/destroy', [ProductController::class, 'destroy'])->name('admin.products.destroy');
});
