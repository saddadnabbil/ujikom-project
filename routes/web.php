<?php

use App\Models\Produk;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FakturController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\SchoolMajorController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\FakturHistoryController;
use App\Http\Controllers\ProdukHistoryController;
use App\Http\Controllers\StudentHistoryController;
use App\Http\Controllers\CashTransactionController;
use App\Http\Controllers\CustomerHistoryController;
use App\Http\Controllers\PerusahaanHistoryController;
use App\Http\Controllers\SchoolClassHistoryController;
use App\Http\Controllers\SchoolMajorHistoryController;
use App\Http\Controllers\CashTransactionFilterController;
use App\Http\Controllers\CashTransactionReportController;
use App\Http\Controllers\CashTransactionHistoryController;
use App\Http\Controllers\CashTransactionExpenditureHistoryController;
use App\Http\Controllers\DetailFakturController;
use App\Http\Controllers\DetailFakturHistoryController;

require __DIR__ . '/auth.php';

// If accessing root path "/" it will be redirect to /login
Route::redirect('/', 'login');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::resource('students', StudentController::class)->except('create', 'show', 'edit');

    Route::resource('school-classes', SchoolClassController::class)->except('create', 'show', 'edit');
    Route::resource('school-majors', SchoolMajorController::class)->except('create', 'show', 'edit');
    Route::resource('administrators', AdministratorController::class)->except('create', 'show', 'edit', 'destroy');

    Route::get('/cash-transactions/filter', CashTransactionFilterController::class)->name('cash-transactions.filter');
    Route::resource('cash-transactions', CashTransactionController::class)->except('create', 'show', 'edit');

    Route::get('/cash-transaction-expenditures/filter', CashTransactionExpenditureFilterController::class)->name('cash-transaction-expenditures.filter');
    Route::resource('cash-transaction-expenditures', CashTransactionExpenditureController::class)->except('create', 'show', 'edit');

    //  Report routes
    Route::get('/report', CashTransactionReportController::class)->name('report.index');
    // End of report routes

    // Soft Deletes Routes
    Route::controller(StudentHistoryController::class)->prefix('/students/history')->name('students.')->group(function () {
        Route::get('', 'index')->name('index.history');
        Route::post('{id}', 'restore')->name('restore.history');
        Route::delete('{id}', 'destroy')->name('destroy.history');
    });

    Route::controller(CashTransactionHistoryController::class)->prefix('/cash-transactions/history')->name('cash-transactions.')->group(function () {
        Route::get('', 'index')->name('index.history');
        Route::post('{id}', 'restore')->name('restore.history');
        Route::delete('{id}', 'destroy')->name('destroy.history');
    });

    Route::controller(CashTransactionExpenditureHistoryController::class)->prefix('/cash-transaction-expenditures/history')->name('cash-transaction-expenditures.')->group(function () {
        Route::get('', 'index')->name('index.history');
        Route::post('{id}', 'restore')->name('restore.history');
        Route::delete('{id}', 'destroy')->name('destroy.history');
    });

    Route::controller(SchoolClassHistoryController::class)->prefix('/school-classes/history')->name('school-classes.')->group(function () {
        Route::get('', 'index')->name('index.history');
        Route::post('{id}', 'restore')->name('restore.history');
        Route::delete('{id}', 'destroy')->name('destroy.history');
    });

    Route::controller(SchoolMajorHistoryController::class)->prefix('/school-majors/history')->name('school-majors.')->group(function () {
        Route::get('', 'index')->name('index.history');
        Route::post('{id}', 'restore')->name('restore.history');
        Route::delete('{id}', 'destroy')->name('destroy.history');
    });

    Route::resource('produk', ProdukController::class)->except('create', 'show', 'edit');
    Route::controller(ProdukHistoryController::class)->prefix('/produk/history')->name('produk.')->group(function () {
        Route::get('', 'index')->name('index.history');
        Route::post('{id}', 'restore')->name('restore.history');
        Route::delete('{id}', 'destroy')->name('destroy.history');
    });

    Route::resource('produk', ProdukController::class)->except('create', 'show', 'edit');
    Route::controller(ProdukHistoryController::class)->prefix('/produk/history')->name('produk.')->group(function () {
        Route::get('', 'index')->name('index.history');
        Route::post('{id}', 'restore')->name('restore.history');
        Route::delete('{id}', 'destroy')->name('destroy.history');
    });

    Route::resource('customer', CustomerController::class)->except('create', 'show', 'edit');
    Route::controller(CustomerHistoryController::class)->prefix('/customer/history')->name('customer.')->group(function () {
        Route::get('', 'index')->name('index.history');
        Route::post('{id}', 'restore')->name('restore.history');
        Route::delete('{id}', 'destroy')->name('destroy.history');
    });

    Route::resource('perusahaan', PerusahaanController::class)->except('create', 'show', 'edit');
    Route::controller(PerusahaanHistoryController::class)->prefix('/perusahaan/history')->name('perusahaan.')->group(function () {
        Route::get('', 'index')->name('index.history');
        Route::post('{id}', 'restore')->name('restore.history');
        Route::delete('{id}', 'destroy')->name('destroy.history');
    });

    Route::resource('faktur', FakturController::class)->except('create', 'show', 'edit');
    Route::controller(FakturHistoryController::class)->prefix('/faktur/history')->name('faktur.')->group(function () {
        Route::get('', 'index')->name('index.history');
        Route::post('{id}', 'restore')->name('restore.history');
        Route::delete('{id}', 'destroy')->name('destroy.history');
    });

    Route::resource('detail-faktur', DetailFakturController::class)->except('create', 'show', 'edit');
    Route::controller(DetailFakturHistoryController::class)->prefix('/detail-faktur/history')->name('detail-faktur.')->group(function () {
        Route::get('', 'index')->name('index.history');
        Route::post('{id}', 'restore')->name('restore.history');
        Route::delete('{id}', 'destroy')->name('destroy.history');
    });

    require __DIR__ . '/export.php';
});
