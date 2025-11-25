<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::post('/login', [App\Http\Controllers\Web\UserController::class, 'login'])->name('login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/livewire-test', [App\Http\Controllers\Web\TestController::class, 'testLivewire'])->name('livewire-test');
    Route::get('dashboard', [App\Http\Controllers\Web\DashboardController::class, 'show'])->name('dashboard');
    Route::get('users', [App\Http\Controllers\Web\UserController::class, 'show'])->name('users');
    Route::post('logout', [App\Http\Controllers\Web\UserController::class, 'logout'])->name('logout');
});
