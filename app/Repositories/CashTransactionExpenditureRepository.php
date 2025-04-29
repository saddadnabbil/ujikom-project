<?php

namespace App\Repositories;

use App\Contracts\CashTransactionExpenditureInterface;
use App\Models\Student;
use App\Models\CashTransaction;
use App\Http\Controllers\Controller;
use App\Models\CashTransactionExpenditure;
use Illuminate\Database\Eloquent\Builder;

class CashTransactionExpenditureRepository extends Controller implements CashTransactionExpenditureInterface
{
    private $model, $students, $startOfWeek, $endOfWeek;

    public function __construct(CashTransactionExpenditure $model)
    {
        $this->model = $model;
        // $this->students = $students;
        $this->startOfWeek = now()->startOfWeek()->format('Y-m-d');
        $this->endOfWeek = now()->endOfWeek()->format('Y-m-d');
    }

    /**
     * Hitung total kolom expenditure di tabel cash_transactions berdasarkan tahun atau bulan.
     *
     * Jika $status === `year` dan variabel $year ada isinya, maka hitung total kolom expenditure di tabel cash_transaction berdasarkan
     * tahun sesuai di parameter.
     *
     * Jika $status === `month` dan variabel $month ada isinya, maka hitung total kolom expenditure di tabel cash_transaction berdasarkan bulan
     * sesuai di parameter.
     *
     * Jika $status === `year` maka hanya isi parameter $year.
     * jika $status === `month` maka hanya isi parameter $month.
     *
     * @param string $status ingin hitung total kolom berdasarkan tahun `year` atau bulan `month`.
     * @param string $year adalah tahun, contoh : 2021, 2022, 2023, dst..
     * @param string $month adalah bulan dengan 0, contoh : 01, 02, 03, dst..
     * @return Int
     */
    public function sumExpenditureBy(string $status, string $year = null, string $month = null): Int
    {
        $model = $this->model->select('date', 'expenditure');

        return $status === 'year'
            ? $model->whereYear('date', $year)->sum('expenditure')
            : $model->whereYear('date', date('Y'))->whereMonth('date', date('m'))->sum('expenditure');
    }

    /**
     * Mengembalikan seluruh data yang dibutuhkan
     *
     * @return array
     */
    public function results(): array
    {
        return [
            'totals' => [
                'thisMonth' => indonesian_currency($this->sumExpenditureBy('month', month: date('m'))),
                'thisYear' => indonesian_currency($this->sumExpenditureBy('year', year: date('Y'))),
            ]
        ];
    }
}
