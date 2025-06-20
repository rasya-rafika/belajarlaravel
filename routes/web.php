<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\AdopsiController;
use App\Http\Controllers\ContactController;
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
    Route::get('/dokter/chart', [DokterController::class, 'chartRating'])->name('dokter.chart');
   Route::post('/dokter/generate-pdf', [DokterController::class, 'generatePdf'])->name('dokter.generatePdf');
});

// 🟢 Public: Info halaman yang tidak perlu login
Route::get('/dokter', [DokterController::class, 'index'])->name('dokter.index');
Route::get('/dokter/{dokter}', [DokterController::class, 'show'])->name('dokter.show');
// Route untuk halaman index adopsi
Route::get('/adopsi', [AdopsiController::class, 'index'])->name('adopsi.index');
// Route untuk artikel (menampilkan daftar artikel)
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
Route::get('/contact', fn() => view('contact.index'))->name('contact');

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

Route::get('/user', function(){
    return view('dashboard');
})->middleware(['auth', 'verified', 'role:user']);

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


// Admin: CRUD hewan adopsi
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/adopsi/create', [AdopsiController::class, 'create'])->name('adopsi.create');
    Route::post('/adopsi', [AdopsiController::class, 'store'])->name('adopsi.store');
    // Tambahan route untuk edit dan delete adopsi
    Route::get('/adopsi/{id}/edit', [AdopsiController::class, 'edit'])->name('adopsi.edit');
    Route::put('/adopsi/{id}', [AdopsiController::class, 'update'])->name('adopsi.update');
    Route::delete('/adopsi/{id}', [AdopsiController::class, 'destroy'])->name('adopsi.destroy');
});


// User: Pengajuan adopsi
Route::middleware('auth')->group(function () {
    Route::get('/adopsi/{id}', [AdopsiController::class, 'show'])->name('adopsi.show');
    Route::get('/adopsi/{id}/adopt', [AdopsiController::class, 'adopsiForm'])->name('adopsi.adopt');
    Route::post('/adopsi/{id}/submit', [AdopsiController::class, 'submitAdopsi'])->name('adopsi.submitAdopsi');
});

// Routes untuk user dan admin - menggunakan satu route yang sama
Route::middleware(['auth'])->group(function () {
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index'); // User: form, Admin: list contacts
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store'); // Submit contact form (user only)
});

// Admin specific routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/contact/{contact}', [ContactController::class, 'show'])->name('contact.show'); // View specific contact
    Route::patch('/contact/{contact}/mark-read', [ContactController::class, 'markAsRead'])->name('contact.mark-read'); // Mark as read
    Route::delete('/contact/{contact}', [ContactController::class, 'destroy'])->name('contact.destroy'); // Delete contact
    Route::delete('/contact/{contact}/photo', [ContactController::class, 'destroyPhoto'])->name('contact.photo.destroy'); // Delete photo
});


// Auth scaffolding (Jetstream/Fortify/Breeze dsb)
require __DIR__.'/auth.php';