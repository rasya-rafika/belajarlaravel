<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\RatingController;
use App\Models\Artikel;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $artikels = Artikel::latest()->take(3)->get();
    return view('dashboard', compact('artikels'));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dokter', [DokterController::class, 'index'])->name('dokter.index');
    
});

/*Route::middleware('role:admin')->group(function () {
        Route::get('/dokter/create', [DokterController::class, 'create'])->name('dokter.create');
        Route::post('/dokter', [DokterController::class, 'store'])->name('dokter.store');
        Route::get('/dokter/{id}/edit', [DokterController::class, 'edit'])->name('dokter.edit');
        Route::put('/dokter/{id}', [DokterController::class, 'update'])->name('dokter.update');
        Route::delete('/dokter/{id}', [DokterController::class, 'destroy'])->name('dokter.destroy');
});*/

// Admin CRUD dokter – taruh duluan biar nggak ketimpa
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dokter/create', [DokterController::class, 'create'])->name('dokter.create');
    Route::post('/dokter', [DokterController::class, 'store'])->name('dokter.store');
    Route::get('/dokter/{dokter}/edit', [DokterController::class, 'edit'])->name('dokter.edit');
    Route::put('/dokter/{dokter}', [DokterController::class, 'update'])->name('dokter.update');
    Route::delete('/dokter/{dokter}', [DokterController::class, 'destroy'])->name('dokter.destroy');
});

// Route user & umum
Route::middleware(['auth'])->group(function () {
    Route::get('/dokter', [DokterController::class, 'index'])->name('dokter.index');
    Route::get('/dokter/{dokter}', [DokterController::class, 'show'])->name('dokter.show');
});

    Route::get('/dokter/{id}/rating', [RatingController::class, 'create'])->name('rating.create');
    Route::post('/dokter/{id}/rating', [RatingController::class, 'store'])->name('rating.store');


Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified']);

Route::get('admin',function(){
    return view('dashboard');
})->middleware(['auth', 'verified','role:admin']);

/*Route::get('/dokter', function () {
    return view('dokter');
})->middleware(['auth', 'verified', 'role_or_permission:tambah-adopsi|admin'])->name('dokter');*/

Route::get('/adopsi', function () {
    return view('adopsi');
})->middleware(['auth', 'verified', 'role_or_permission:tambah-adopsi|admin'])->name('adopsi');

Route::get('/artikel', function () {
    return view('artikel');
})->middleware(['auth', 'verified', 'role_or_permission:tambah-adopsi|admin'])->name('artikel');

Route::get('/contact', function () {
    return view('contact');
})->middleware(['auth', 'verified', 'role_or_permission:tambah-adopsi|admin'])->name('contact');

// dan seterusnya untuk 'blog' dan 'contact'



require __DIR__.'/auth.php';
