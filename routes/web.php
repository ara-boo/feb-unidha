<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\StudyProgramController;
use App\Http\Controllers\Admin\LecturerController;
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

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('posts', PostController::class)->except('show');
     Route::resource('study-programs', StudyProgramController::class)->except('show');
     Route::resource('lecturers', LecturerController::class)->except('show');
});