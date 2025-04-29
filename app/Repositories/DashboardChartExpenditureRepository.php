<?php

namespace App\Repositories;

use App\Contracts\ChartExpendituresInterface;
use App\Http\Controllers\Controller;
use App\Models\CashTransactionExpenditure;

class DashboardChartExpenditureRepository extends Controller implements ChartExpendituresInterface 
{
    public function __construct(
        private CashTransactionExpenditure $model,
    ) {
    }

    /**
     * Hitung seluruh kolom amount pada tabel cash_transactions dipisahkan dengan bulan dari 1-12.
     *
     * @return array
     */
    public function sumCashTransactionExpenditurePerMonths(): array
    {
        $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];

        for ($i = 1; $i <= 12; $i++) {
            // Looping dari angka 1-12 karena setiap tahun ada 12 bulan dan menghitung kolom amount
            // berdasarkan bulannya.
            $cashTransactionExpenditures = $this->model
                ->select('is_paid', 'amount', 'date')
                ->whereMonth('date', "{$i}")
                ->whereYear('date', date('Y'))
                ->sum('amount');

            $results[$months[$i - 1]] = $cashTransactionExpenditures;
        }

        /**
         * Output yang akan dihasilkan seperti dibawah ini
         * 
         * $results = [
         *  'jan' => 10000,
         *  'feb' => 10000,
         *  'mar' => 10000,
         *  'apr' => 10000,
         *  'mei' => 10000,
         *  'jun' => 10000,
         *  'jul' => 10000,
         *  'agu' => 10000,
         *  'sep' => 10000,
         *  'okt' => 10000,
         *  'nov' => 10000,
         *  'des' => 10000
         * ];
         */

        return $results;
    }

}
