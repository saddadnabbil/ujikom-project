<?php

use App\Models\Produk;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\ProdukController;
use App\Http\Controllers\API\v1\StudentController;
use App\Http\Controllers\API\v1\CustomerController;
use App\Http\Controllers\API\v1\PerusahaanController;
use App\Http\Controllers\API\v1\SchoolClassController;
use App\Http\Controllers\API\v1\SchoolMajorController;
use App\Http\Controllers\API\v1\AdministratorController;
use App\Http\Controllers\API\v1\DashboardChartController;
use App\Http\Controllers\API\v1\CashTransactionController;
use App\Http\Controllers\API\v1\DashboardChartExpenditureController;
use App\Http\Controllers\API\v1\CashTransactionExpenditureController;
use App\Http\Controllers\API\v1\DetailFakturController;
use App\Http\Controllers\API\v1\FakturController;

Route::name('api.')->prefix('v1')->group(function () {
    Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');
    Route::get('/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');

    Route::get('/customer/{id}', [CustomerController::class, 'show'])->name('customer.show');
    Route::get('/customer/{id}/edit', [CustomerController::class, 'edit'])->name('customer.edit');

    Route::get('/perusahaan/{id}', [PerusahaanController::class, 'show'])->name('perusahaan.show');
    Route::get('/perusahaan/{id}/edit', [PerusahaanController::class, 'edit'])->name('perusahaan.edit');

    Route::get('/faktur/{id}', [FakturController::class, 'show'])->name('faktur.show');
    Route::get('/faktur/{id}/edit', [FakturController::class, 'edit'])->name('faktur.edit');
});
