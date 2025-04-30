<?php

use App\Models\Produk;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\BukuController;
use App\Http\Controllers\API\v1\FakturController;
use App\Http\Controllers\API\v1\ProdukController;
use App\Http\Controllers\API\v1\StudentController;
use App\Http\Controllers\API\v1\CustomerController;
use App\Http\Controllers\API\v1\KategoriController;
use App\Http\Controllers\API\v1\PerusahaanController;
use App\Http\Controllers\API\v1\SchoolClassController;
use App\Http\Controllers\API\v1\SchoolMajorController;
use App\Http\Controllers\API\v1\DetailFakturController;
use App\Http\Controllers\API\v1\AdministratorController;
use App\Http\Controllers\API\v1\DashboardChartController;
use App\Http\Controllers\API\v1\CashTransactionController;
use App\Http\Controllers\API\v1\DashboardChartExpenditureController;
use App\Http\Controllers\API\v1\CashTransactionExpenditureController;

Route::name('api.')->prefix('v1')->group(function () {
    Route::get('/administrator/{id}', [AdministratorController::class, 'show'])->name('administrator.show');
    Route::get('/administrator/{id}/edit', [AdministratorController::class, 'edit'])->name('administrator.edit');

    Route::get('/buku/{id}', [BukuController::class, 'show'])->name('buku.show');
    Route::get('/buku/{id}/edit', [BukuController::class, 'edit'])->name('buku.edit');

    Route::get('/kategori/{id}', [KategoriController::class, 'show'])->name('kategori.show');
    Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
});
