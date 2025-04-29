<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\SchoolMajor;
use App\Models\Student;
use App\Repositories\CashTransactionRepository;
use App\Repositories\CashTransactionExpenditureRepository;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        private CashTransactionRepository $cashTransactionRepository,
        private CashTransactionExpenditureRepository $cashTransactionExpenditureRepository,
    ) {
    }

    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\View\View
     */
    public function __invoke(): View
    {
        // Operasi untuk Balance Kas Bulan ini
        $amountCashTransactionThisMonth = $this->cashTransactionRepository->sumAmountBy('month', month: date('m'));

        $amountCashTransactionExpenditureThisMonth = $this->cashTransactionExpenditureRepository->sumExpenditureBy('month', month: date('m'));
        
        $amountBalanceThisMonth = $amountCashTransactionThisMonth - $amountCashTransactionExpenditureThisMonth;

        // Int ke Format Rupiah Indonesia 
        $amountCashTransactionThisMonth = indonesian_currency($this->cashTransactionRepository->sumAmountBy('month', month: date('m')));

        $amountCashTransactionExpenditureThisMonth = indonesian_currency($this->cashTransactionExpenditureRepository->sumExpenditureBy('month', month: date('m')));

        $amountBalanceThisMonth = indonesian_currency($amountBalanceThisMonth);

        $latestCashTransactions = $this->cashTransactionRepository
            ->cashTransactionLatest(['id', 'student_id', 'user_id', 'bill', 'amount', 'date'], 5);

        return view('dashboard.index', [
            'studentCount' => Student::count(),
            'schoolClassCount' => SchoolClass::count(),
            'schoolMajorCount' => SchoolMajor::count(),
            'amountCashTransactionThisMonth' => $amountCashTransactionThisMonth,
            'amountCashTransactionExpenditureThisMonth' => $amountCashTransactionExpenditureThisMonth,
            'amountBalanceThisMonth' => $amountBalanceThisMonth,
            'latestCashTransactions' => $latestCashTransactions
        ]);
    }
}
