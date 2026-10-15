<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LecturerController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\StudyProgramController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

// Halaman publik
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil/{page:slug}', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/berita', [NewsController::class, 'index'])->name('news.index');
Route::get('/berita/{post:slug}', [NewsController::class, 'show'])->name('news.show');
Route::get('/program-studi', [ProgramController::class, 'index'])->name('programs.index');
Route::get('/program-studi/{program:slug}', [ProgramController::class, 'show'])->name('programs.show');
Route::get('/dosen', [StaffController::class, 'index'])->name('lecturers.index');

// Login
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])
    ->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')->middleware('auth');

// Dashboard admin
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('posts', PostController::class)->except('show');
    Route::resource('study-programs', StudyProgramController::class)->except('show');
    Route::resource('lecturers', LecturerController::class)->except('show');
    Route::resource('pages', AdminPageController::class)->except('show');
});