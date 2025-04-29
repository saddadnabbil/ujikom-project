<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\CashTransaction;
use Illuminate\Http\JsonResponse;
use App\Contracts\HistoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Models\CashTransactionExpenditure;

class CashTransactionExpenditureHistoryController extends Controller implements HistoryInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(): View|JsonResponse
    {
        // TODO: Date column on view should be DD-MM-YYYY format!
        $cashTransactionExpenditures = CashTransactionExpenditure::
        select('id', 'note', 'expenditure', 'date')
        ->onlyTrashed()->get();


        if (request()->ajax()) {
            return datatables()->of($cashTransactionExpenditures)
                ->addIndexColumn()
                ->addColumn('note', fn ($model) => $model->note)
                ->addColumn('expenditure', fn ($model) => indonesian_currency($model->expenditure))
                ->addColumn('date', fn ($model) => date('d-m-Y', strtotime($model->date)))
                ->addColumn('action', 'cash_transaction_expenditures.history.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('cash_transaction_expenditures.history.index');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(int $id): RedirectResponse
    {
        CashTransactionExpenditure::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->route('cash-transaction-expenditures.index.history')->with('success', 'Data berhasil dikembalikan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        CashTransactionExpenditure::onlyTrashed()->findOrFail($id)->forceDelete();

        return redirect()->route('cash-transaction-expenditures.index.history')->with('success', 'Data berhasil dihapus!');
    }
}
