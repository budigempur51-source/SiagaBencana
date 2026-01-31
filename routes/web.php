<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\LearningModuleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserContentController;
use Illuminate\Support\Facades\Route;

// --- GROUP 1: PUBLIC ROUTES ---
Route::get('/', function () {
    return view('welcome');
})->name('home');

// --- GROUP 2: AUTHENTICATED USER ROUTES ---
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Alur Belajar Pengguna
    Route::get('/belajar', [UserContentController::class, 'selection'])->name('user.selection');
    Route::get('/belajar/{category:slug}', [UserContentController::class, 'index'])->name('user.hub');

    // Profile Settings
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- GROUP 3: ADMIN ROUTES ---
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('topics', TopicController::class);
    Route::resource('videos', VideoController::class);
    Route::resource('modules', LearningModuleController::class);
});

require __DIR__.'/auth.php';