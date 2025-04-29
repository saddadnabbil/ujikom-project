<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CashTransactionExpenditure;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class CashTransactionExpenditureFilterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function __invoke(): View|JsonResponse
    {
        $start_date = date('Y-m-d', strtotime(request('start_date')));
        $end_date = date('Y-m-d', strtotime(request('end_date')));

        if (request()->ajax()) {
            return datatables()->of(CashTransactionExpenditure::with('users:id,name')
                ->whereBetween('date', [$start_date, $end_date])->get())
                ->addIndexColumn()
                ->addColumn('note', fn ($model) => $model->note)
                ->addColumn('expenditure', fn ($model) => indonesian_currency($model->expenditure))
                ->addColumn('amount', fn ($model) => indonesian_currency($model->amount))
                ->addColumn('date', fn ($model) => date('d-m-Y', strtotime($model->date)))
                ->addColumn('status', 'cash_transaction_expenditures.datatable.status')
                ->rawColumns(['status'])
                ->toJson();
        }

        return view('cash_transaction_expenditures.filter.index');
    }
}
