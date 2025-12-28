<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\AgendaKegiatanController;
use App\Http\Controllers\LoginController;

Route::middleware(['web'])->group(function () {
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout']);

    Route::middleware('auth:sanctum')->group(function () {
        // Surat Masuk (User creates, Admin manages)
        Route::apiResource('surat-masuk', SuratMasukController::class);

        // Surat Keluar & Agenda (Public Index/Show, Admin Full CRUD)
        Route::get('surat-keluar', [SuratKeluarController::class, 'index']);
        Route::get('surat-keluar/{id}', [SuratKeluarController::class, 'show']);
        
        Route::get('agenda', [AgendaKegiatanController::class, 'index']);
        Route::get('agenda/{id}', [AgendaKegiatanController::class, 'show']);

        Route::middleware(['admin'])->group(function () {
            // Surat Keluar & Agenda (Write operations)
            Route::post('surat-keluar', [SuratKeluarController::class, 'store']);
            Route::put('surat-keluar/{id}', [SuratKeluarController::class, 'update']);
            Route::delete('surat-keluar/{id}', [SuratKeluarController::class, 'destroy']);

            Route::post('agenda', [AgendaKegiatanController::class, 'store']);
            Route::put('agenda/{id}', [AgendaKegiatanController::class, 'update']);
            Route::delete('agenda/{id}', [AgendaKegiatanController::class, 'destroy']);

            // Approvals
            Route::post('/surat-masuk/{id}/approve', [SuratMasukController::class, 'approve']);
            Route::post('/surat-masuk/{id}/reject', [SuratMasukController::class, 'reject']);

            Route::post('/surat-keluar/{id}/approve', [SuratKeluarController::class, 'approve']);
            Route::post('/surat-keluar/{id}/reject', [SuratKeluarController::class, 'reject']);

            Route::post('/agenda/{id}/approve', [AgendaKegiatanController::class, 'approve']);
            Route::post('/agenda/{id}/reject', [AgendaKegiatanController::class, 'reject']);
        });
    });
});
