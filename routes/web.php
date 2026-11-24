<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;

Route::view('/', 'dashboard.index')->name('dashboard');
Route::view('/dashboard', 'dashboard.index');
Route::view('/stok-bahan', 'stok-bahan.index');
Route::view('/pembelian', 'pembelian.index');
Route::view('/pengeluaran', 'pengeluaran.index');
Route::view('/analisis-data', 'analisis-data.index');
Route::view('/rekap-laporan', 'rekap-laporan.index');
Route::view('/import-export', 'import-export.index');
Route::view('/catatan', 'catatan.index');
Route::get('/catatan', [NoteController::class, 'index'])
    ->name('notes.index');

Route::post('/catatan', [NoteController::class, 'store'])
    ->name('notes.store');

Route::delete('/catatan/{note}', [NoteController::class, 'destroy'])
    ->name('notes.destroy');
