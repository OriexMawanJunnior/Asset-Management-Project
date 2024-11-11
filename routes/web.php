<?php

use App\Http\Controllers\AssetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'show'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('signIn');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');
    Route::get('/assets', [AssetController::class,'index'])->name('asset');
    Route::get('/assets/create', [AssetController::class,'showCreateForm'])->name('asset.create');
});

