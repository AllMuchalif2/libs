<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\VisitorHistoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/katalog/{slug}', [CatalogController::class, 'show'])->name('catalog.show');

Route::get('/buku-tamu', function () {
    return view('guest-book');
})->middleware('restrict-ip');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth:member', 'verified'])->name('dashboard');

Route::middleware('auth:member')->group(function () {
    // profile member
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // riwayat kunjungan
    Route::get('/riwayat-kunjungan', [VisitorHistoryController::class, 'index'])->name('visitor.history');
});

require __DIR__ . '/auth.php';
