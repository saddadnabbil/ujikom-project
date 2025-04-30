<?php

use App\Models\Produk;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\FakturController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\BukuHistoryController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\FakturHistoryController;
use App\Http\Controllers\ProdukHistoryController;
use App\Http\Controllers\CustomerHistoryController;
use App\Http\Controllers\DendaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PerusahaanHistoryController;

require __DIR__ . '/auth.php';

// If accessing root path "/" it will be redirect to /login
Route::redirect('/', 'login');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::resource('administrators', AdministratorController::class)->except('create', 'show', 'edit');

    Route::resource('buku', BukuController::class)->except('create', 'show', 'edit');
    Route::resource('kategori', KategoriController::class)->except('create', 'show', 'edit');
    Route::resource('anggota', AnggotaController::class)->except('create', 'show', 'edit');
    Route::resource('denda', DendaController::class)->except('create', 'show', 'edit');

    require __DIR__ . '/export.php';
});
