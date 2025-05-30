<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\BukuController;
use App\Http\Controllers\API\v1\KategoriController;
use App\Http\Controllers\API\v1\AdministratorController;
use App\Http\Controllers\API\v1\AnggotaController;
use App\Http\Controllers\API\v1\DendaController;
use App\Http\Controllers\API\v1\PeminjamanController;

Route::name('api.')->prefix('v1')->group(function () {
    Route::get('/administrator/{id}', [AdministratorController::class, 'show'])->name('administrator.show');
    Route::get('/administrator/{id}/edit', [AdministratorController::class, 'edit'])->name('administrator.edit');

    Route::get('/buku/{id}', [BukuController::class, 'show'])->name('buku.show');
    Route::get('/buku/{id}/edit', [BukuController::class, 'edit'])->name('buku.edit');

    Route::get('/kategori/{id}', [KategoriController::class, 'show'])->name('kategori.show');
    Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');

    Route::get('/anggota/{id}', [AnggotaController::class, 'show'])->name('anggota.show');
    Route::get('/anggota/{id}/edit', [AnggotaController::class, 'edit'])->name('anggota.edit');

    Route::get('/denda/{id}', [DendaController::class, 'show'])->name('denda.show');
    Route::get('/denda/{id}/edit', [DendaController::class, 'edit'])->name('denda.edit');

    Route::get('/peminjaman/{id}', [PeminjamanController::class, 'show'])->name('peminjaman.show');
    Route::get('/peminjaman/{id}/edit', [PeminjamanController::class, 'edit'])->name('peminjaman.edit');
});
