<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FakturController;
use App\Http\Controllers\Export\StudentController;
use App\Http\Controllers\Export\AdministratorController;
use App\Http\Controllers\Export\CashTransactionController;
use App\Http\Controllers\Export\CashTransactionReportController;

Route::get('/faktur/{id}/print', [FakturController::class, 'print'])->name('faktur.print');
