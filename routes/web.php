<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'dashboard.index')->name('dashboard');
Route::view('/dashboard', 'dashboard.index');
Route::view('/stok-bahan', 'stok-bahan.index');
Route::view('/pembelian', 'pembelian.index');
Route::view('/pengeluaran', 'pengeluaran.index');
Route::view('/analisis-data', 'analisis-data.index');
Route::view('/rekap-laporan', 'rekap-laporan.index');
Route::view('/import-export', 'import-export.index');
Route::view('/catatan', 'catatan.index');