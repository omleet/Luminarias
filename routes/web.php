<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\EditUserMiddleware;


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

    Route::controller(UserController::class)->group(function () {
        Route::get('/User/me', 'editMe')->name("User.me");
        Route::get('/Users', 'index')->name("users_all")->middleware(AdminMiddleware::class);
        Route::get('/User/{User}/edit', 'edit')->name("User.edit")->middleware(EditUserMiddleware::class);
        Route::put('/User/{User}', 'update')->name("User.update")->middleware(EditUserMiddleware::class);
        Route::patch('/User/{User}/password', 'updatePassword')->name("User.updatePassword")->middleware(EditUserMiddleware::class);
        Route::resource('/User', UserController::class)->except(['index', 'edit', 'update'])->middleware(AdminMiddleware::class);
    });
});

Route::middleware(['auth'])->group(function () {
    Route::view('/about', 'about.index')->name('about');
    Route::view('/controlos', 'controlos.index')->name('controlos');
    Route::view('/relatorios', 'relatorios.index')->name('relatorios');



    //Para pagina dashboard nos eventos recentes
    Route::get('/recent-activity', [HistoryController::class, 'recentActivity']);


    //Para pagina de relatorios (nao está funcional)
    Route::get('/report-data', [HistoryController::class, 'reportData']);
    Route::get('/event-history', [HistoryController::class, 'eventHistory']);
});





Route::post('/history', [HistoryController::class, 'store']);
Route::get('/history', [HistoryController::class, 'index']);


Route::get('/export/history/excel', [HistoryController::class, 'exportExcel'])->name('export.history.excel');
Route::get('/export/history/csv', [HistoryController::class, 'exportCSV'])->name('export.history.csv');
Route::get('/export/history/pdf', [HistoryController::class, 'exportPDF'])->name('export.history.pdf');

require __DIR__ . '/auth.php';
