<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PeminjamanController;

Route::get('anggota/pdf', [AnggotaController::class, 'generatePdf'])->name('anggota.export');
Route::get('buku/pdf', [BukuController::class, 'generatePdf'])->name('buku.export');
Route::get('peminjaman/pdf', [PeminjamanController::class, 'generatePdf'])->name('peminjaman.export');
