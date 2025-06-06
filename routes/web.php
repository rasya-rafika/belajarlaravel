<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ArtikelController;
use Illuminate\Support\Facades\Route;
use App\Models\Artikel;

// 🟢 Public: Landing Page
Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

// 🔐 Admin CRUD dokter - TARUH PALING ATAS sebelum route {dokter}
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dokter/create', [DokterController::class, 'create'])->name('dokter.create')->middleware(['auth', 'role:admin']);
    Route::post('/dokter', [DokterController::class, 'store'])->name('dokter.store');
    Route::get('/dokter/{dokter}/edit', [DokterController::class, 'edit'])->name('dokter.edit');
    Route::put('/dokter/{dokter}', [DokterController::class, 'update'])->name('dokter.update');
    Route::delete('/dokter/{dokter}', [DokterController::class, 'destroy'])->name('dokter.destroy');
});

// 🟢 Public: Info halaman yang tidak perlu login
Route::get('/dokter', [DokterController::class, 'index'])->name('dokter.index');
Route::get('/dokter/{dokter}', [DokterController::class, 'show'])->name('dokter.show');
Route::get('/adopsi', fn() => view('adopsi'))->name('adopsi');
// Route untuk artikel (menampilkan daftar artikel)
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
Route::get('/contact', fn() => view('contact'))->name('contact');

// 🔐 Protected: hanya user login
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rating routes
    Route::get('/dokter/{id}/rating', [RatingController::class, 'create'])->name('rating.create');
    Route::post('/dokter/{id}/rating', [RatingController::class, 'store'])->name('rating.store');
});

Route::get('/admin', function(){
    return view('dashboard');
})->middleware(['auth', 'verified', 'role:admin']);

//🔐 USER & ADMIN: Route untuk CRUD artikel (authenticated users) - TARUH DULU SEBELUM ROUTE {artikel}
Route::middleware(['auth'])->group(function () {
    // Create artikel - user dan admin bisa membuat
    Route::get('/artikel/create', [ArtikelController::class, 'create'])->name('artikel.create');
    Route::post('/artikel', [ArtikelController::class, 'store'])->name('artikel.store');
    
    // Edit & Update - user hanya artikel sendiri, admin semua artikel
    Route::get('/artikel/{artikel}/edit', [ArtikelController::class, 'edit'])->name('artikel.edit');
    Route::put('/artikel/{artikel}', [ArtikelController::class, 'update'])->name('artikel.update');
    
    // Delete - user hanya artikel sendiri, admin semua artikel
    Route::delete('/artikel/{artikel}', [ArtikelController::class, 'destroy'])->name('artikel.destroy');
});

// 🟢 PUBLIC: Route artikel yang bisa diakses semua orang (TARUH PALING BAWAH)
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{artikel}', [ArtikelController::class, 'show'])->name('artikel.show');

// Auth scaffolding (Jetstream/Fortify/Breeze dsb)
require __DIR__.'/auth.php';