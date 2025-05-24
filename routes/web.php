<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified']);

Route::get('admin',function(){
    return view('dashboard');
})->middleware(['auth', 'verified','role:admin']);



Route::get('/dokter', function () {
    return view('dokter');
})->middleware(['auth', 'verified', 'role_or_permission:tambah-adopsi|admin'])->name('dokter');

Route::get('/adopsi', function () {
    return view('adopsi');
})->middleware(['auth', 'verified', 'role_or_permission:tambah-adopsi|admin'])->name('adopsi');

Route::get('/blog', function () {
    return view('blog');
})->middleware(['auth', 'verified', 'role_or_permission:tambah-adopsi|admin'])->name('blog');

Route::get('/contact', function () {
    return view('contact');
})->middleware(['auth', 'verified', 'role_or_permission:tambah-adopsi|admin'])->name('contact');



// dan seterusnya untuk 'blog' dan 'contact'

require __DIR__.'/auth.php';
