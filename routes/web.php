<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TopicController;
use Illuminate\Support\Facades\Route;

// --- GROUP 1: PUBLIC ROUTES ---
Route::get('/', function () {
    return view('welcome');
})->name('home');

// --- GROUP 2: AUTHENTICATED & ADMIN ROUTES ---
// Menggunakan middleware 'admin' yang sudah kita buat untuk proteksi tingkat tinggi.
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    
    // Dashboard Utama Admin
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Manajemen Kategori (CRUD)
    Route::resource('categories', CategoryController::class);
    
    // Manajemen Topik Edukasi (CRUD)
    Route::resource('topics', TopicController::class);

    // Placeholder untuk fitur Video (Next Step)
    // Route::resource('videos', VideoController::class);
});

// --- GROUP 3: USER PROFILE (Standard Breeze) ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';