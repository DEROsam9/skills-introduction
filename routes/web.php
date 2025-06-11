<?php

use App\Http\Controllers\Web\AuthWebController;
use App\Http\Controllers\API\PostController;

Route::get('/login', [AuthWebController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthWebController::class, 'login'])->name('login');

Route::get('/register', [AuthWebController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthWebController::class, 'register'])->name('register');

Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Dashboard page for logged-in users

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthWebController::class, 'dashboard'])->name('dashboard');
    Route::resource('posts', PostController::class);

});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
