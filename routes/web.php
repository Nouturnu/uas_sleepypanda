<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController; 

// Halaman Depan
Route::get('/', function () {
    return view('welcome');
});

// --- JALUR LOGIN & REGISTER ---
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Jalur Lupa Password
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');

// Jalur Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- JALUR DASHBOARD (Harus Login) ---
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/user-data', [DashboardController::class, 'users'])->name('user-data');
    Route::get('/jurnal', [DashboardController::class, 'jurnal'])->name('jurnal');
    Route::get('/report', [DashboardController::class, 'report'])->name('report');
});