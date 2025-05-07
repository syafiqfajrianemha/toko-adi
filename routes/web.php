<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\RoleCheck;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/home', 301);
Route::get('/home', [HomeController::class, 'index'])->name('home.index');

Route::middleware('auth')->group(function () {
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
        });
    });
});

require __DIR__.'/auth.php';
