<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\AgendaKegiatanController;

Route::get('/login', [\App\Http\Controllers\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login']);
Route::post('/logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Routes (Full CRUD)
    Route::middleware(['admin'])->group(function () {
        Route::resource('surat-masuk', SuratMasukController::class)->except(['index', 'show']);
        Route::resource('surat-keluar', SuratKeluarController::class)->except(['index', 'show']);
        Route::resource('agenda', AgendaKegiatanController::class)->except(['index', 'show']);

        // Approval Routes
        Route::post('/surat-masuk/{id}/approve', [SuratMasukController::class, 'approve'])->name('surat-masuk.approve');
        Route::post('/surat-masuk/{id}/reject', [SuratMasukController::class, 'reject'])->name('surat-masuk.reject');

        Route::post('/surat-keluar/{id}/approve', [SuratKeluarController::class, 'approve'])->name('surat-keluar.approve');
        Route::post('/surat-keluar/{id}/reject', [SuratKeluarController::class, 'reject'])->name('surat-keluar.reject');

        Route::post('/agenda/{id}/approve', [AgendaKegiatanController::class, 'approve'])->name('agenda.approve');
        Route::post('/agenda/{id}/reject', [AgendaKegiatanController::class, 'reject'])->name('agenda.reject');
    });

    // User Routes (Read Only for Index & Show, but we need to prevent conflict with Admin Resource)
    // Actually, Resource controller handles both. If we want to restrict, we can share index/show.
    // However, Admin needs store/update/destroy which are protected above.
    // We can define the common routes (index/show) outside the admin group but inside auth.
    
    // Surat Masuk
    Route::get('surat-masuk', [SuratMasukController::class, 'index'])->name('surat-masuk.index');
    Route::get('surat-masuk/{surat_masuk}', [SuratMasukController::class, 'show'])->name('surat-masuk.show');
    
    // Surat Keluar
    Route::get('surat-keluar', [SuratKeluarController::class, 'index'])->name('surat-keluar.index');
    Route::get('surat-keluar/{surat_keluar}', [SuratKeluarController::class, 'show'])->name('surat-keluar.show');
    
    // Agenda
    Route::get('agenda', [AgendaKegiatanController::class, 'index'])->name('agenda.index');
    Route::get('agenda/{agenda}', [AgendaKegiatanController::class, 'show'])->name('agenda.show');
});

// require __DIR__.'/auth.php';
