<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;

Route::group([
    'middleware' => 'auth',
    'as' => 'dashboard.',
    'prefix' => 'dashboard',
], function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // make other categories routes above resource so laravel don't think /trash is a show route
    Route::get('/categories/trash', [CategoryController::class, 'trash'])->name('categories.trash');
    Route::put('/categories/{category}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::delete('/categories/{category}/force-delete', [CategoryController::class, 'forceDelete'])->name('categories.forceDelete');
    Route::resource('/categories', CategoryController::class);

    Route::resource('/products', ProductController::class);
});
