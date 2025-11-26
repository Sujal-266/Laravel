<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\SubCategoryController;

Route::get('/', function () {
    return view('welcome');
});

// Admin Dashboard
Route::get('/admin', function () {
    return view('UI.dashboard');
});

// AUTH MANAGEMENT
Route::get('/login', function () {
    if (Auth::user()) {
        return redirect('/dashboard');
    }
    return view('UI.auth.login');
});
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/livewire-test', [TestController::class, 'testLivewire'])->name('livewire-test');
    Route::get('dashboard', [DashboardController::class, 'show'])->name('dashboard');
    Route::get('users', [UserController::class, 'show'])->name('users');
    Route::post('logout', [UserController::class, 'logout'])->name('logout');

    // Category Management
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::get('categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');

    Route::get('categories/{id}', [CategoryController::class, 'show'])->name('categories.show');
    Route::delete('categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // SubCategory Management
    Route::get('categories/{categoryId}/subcategories/create', [SubCategoryController::class, 'create'])->name('subcategories.create');
    Route::get('categories/{categoryId}/subcategories/{subCategoryId}', [SubCategoryController::class, 'show'])->name('subcategories.show');
    Route::get('categories/{categoryId}/subcategories/{subCategoryId}/edit', [SubCategoryController::class, 'edit'])->name('subcategories.edit');
    Route::delete('categories/{categoryId}/subcategories/{subCategoryId}', [SubCategoryController::class, 'destroy'])->name('subcategories.destroy');
});
