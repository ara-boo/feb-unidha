<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])
    ->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')->middleware('auth');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])
        ->name('admin.dashboard');
});