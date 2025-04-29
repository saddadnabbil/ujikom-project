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
    Route::get('/school-class/{id}', [SchoolClassController::class, 'show'])->name('school-class.show');
    Route::get('/school-class/{id}/edit', [SchoolClassController::class, 'edit'])->name('school-class.edit');

    Route::get('/student/{id}', [StudentController::class, 'show'])->name('student.show');
    Route::get('/student/{id}/edit', [StudentController::class, 'edit'])->name('student.edit');

    Route::get('/school-major/{id}', [SchoolMajorController::class, 'show'])->name('school-major.show');
    Route::get('/school-major/{id}/edit', [SchoolMajorController::class, 'edit'])->name('school-major.edit');

    Route::get('/administrator/{id}', [AdministratorController::class, 'show'])->name('administrator.show');
    Route::get('/administrator/{id}/edit', [AdministratorController::class, 'edit'])->name('administrator.edit');

    Route::get('/cash-transaction/{id}', [CashTransactionController::class, 'show'])->name('cash-transaction.show');
    Route::get('/cash-transaction/{id}/edit', [CashTransactionController::class, 'edit'])->name('cash-transaction.edit');

    Route::get('/cash-transaction-expenditures/{id}', [CashTransactionExpenditureController::class, 'show'])->name('cash-transaction-expenditures.show');
    Route::get('/cash-transaction-expenditures/{id}/edit', [CashTransactionExpenditureController::class, 'edit'])->name('cash-transaction-expenditures.edit');

    Route::get('/chart', DashboardChartController::class)->name('chart');
    Route::get('/chart-expenditure', DashboardChartExpenditureController::class)->name('chart.expenditure');

    Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');
    Route::get('/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');

    Route::get('/customer/{id}', [CustomerController::class, 'show'])->name('customer.show');
    Route::get('/customer/{id}/edit', [CustomerController::class, 'edit'])->name('customer.edit');

    Route::get('/perusahaan/{id}', [PerusahaanController::class, 'show'])->name('perusahaan.show');
    Route::get('/perusahaan/{id}/edit', [PerusahaanController::class, 'edit'])->name('perusahaan.edit');

    Route::get('/faktur/{id}', [FakturController::class, 'show'])->name('faktur.show');
    Route::get('/faktur/{id}/edit', [FakturController::class, 'edit'])->name('faktur.edit');

    Route::get('/detail-faktur/{id}', [DetailFakturController::class, 'show'])->name('detail-faktur.show');
    Route::get('/detail-faktur/{id}/edit', [DetailFakturController::class, 'edit'])->name('detail-faktur.edit');
});
