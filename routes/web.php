<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HistoryController;

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::view('/about', 'about.index')->name('about');
    Route::view('/controlos', 'controlos.index')->name('controlos');
    Route::view('/relatorios', 'relatorios.index')->name('relatorios');
});






Route::post('/history', [HistoryController::class, 'store']);
Route::get('/history', [HistoryController::class, 'index']);




require __DIR__ . '/auth.php';
