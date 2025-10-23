<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\RoleCheck;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/home', 301);
Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::get('/produk/{id}', [HomeController::class, 'detailProduk'])->name('detail.produk');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::get('/kategori/{slug}', [HomeController::class, 'filterByCategori'])->name('filter.kategori');

Route::middleware('auth')->group(function () {
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(RoleCheck::class.':admin')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

            Route::get('/category', [CategoryController::class, 'index'])->name('admin.category.index');
            Route::post('/category', [CategoryController::class, 'store'])->name('admin.category.store');
            Route::get('/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
            Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
            Route::patch('/category/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
            Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');

            Route::get('/product', [ProductController::class, 'index'])->name('admin.product.index');
            Route::post('/product', [ProductController::class, 'store'])->name('admin.product.store');
            Route::get('/product/create', [ProductController::class, 'create'])->name('admin.product.create');
            Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
            Route::patch('/product/{id}', [ProductController::class, 'update'])->name('admin.product.update');
            Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('admin.product.destroy');

            Route::get('/whatsapp', [PhoneController::class, 'index'])->name('admin.whatsapp.index');
            Route::post('/whatsapp', [PhoneController::class, 'store'])->name('admin.whatsapp.store');
            Route::get('/whatsapp/create', [PhoneController::class, 'create'])->name('admin.whatsapp.create');
            Route::get('/whatsapp/edit/{id}', [PhoneController::class, 'edit'])->name('admin.whatsapp.edit');
            Route::patch('/whatsapp/{id}', [PhoneController::class, 'update'])->name('admin.whatsapp.update');
            Route::delete('/whatsapp/{id}', [PhoneController::class, 'destroy'])->name('admin.whatsapp.destroy');
        });
    });
});

require __DIR__.'/auth.php';
