<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\View\View;
use App\Models\CashTransaction;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\CashTransactionExpenditure;
use App\Repositories\CashTransactionExpenditureRepository;
use App\Http\Requests\CashTransactionExpenditureStoreRequest;
use App\Http\Requests\CashTransactionExpenditureUpdateRequest;

class CashTransactionExpenditureController extends Controller
{
    private $cashTransactionExpenditureRepository, $startOfWeek, $endOfWeek;

    public function __construct(CashTransactionExpenditureRepository $cashTransactionExpenditureRepository )
    {
        $this->cashTransactionExpenditureRepository = $cashTransactionExpenditureRepository;
        $this->startOfWeek = now()->startOfWeek()->format('Y-m-d');
        $this->endOfWeek = now()->endOfWeek()->format('Y-m-d');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(): View|JsonResponse
    {
        $cashTransactionExpenditures = CashTransactionExpenditure::
            select('id', 'note', 'expenditure', 'amount', 'date')
            ->whereBetween('date', [$this->startOfWeek, $this->endOfWeek])
            ->latest()
            ->get();

        // $students = Student::select('id', 'student_identification_number', 'name')
        //     ->whereDoesntHave(
        //         'cash_transactions',
        //         fn (Builder $query) => $query->select(['date'])
        //             ->whereBetween('date', [$this->startOfWeek, $this->endOfWeek])
        //     )->get();

        if (request()->ajax()) {
            return datatables()->of($cashTransactionExpenditures)
                ->addIndexColumn()
                ->addColumn('note', fn ($model) => $model->note)
                ->addColumn('expenditure', fn ($model) => indonesian_currency($model->expenditure))
                ->addColumn('amount', fn ($model) => indonesian_currency($model->amount))
                ->addColumn('date', fn ($model) => date('d-m-Y', strtotime($model->date)))
                ->addColumn('action', 'cash_transaction_expenditures.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }

        $cashTransactionExpendituresTrashedCount = CashTransactionExpenditure::onlyTrashed()->count();

        return view('cash_transaction_expenditures.index', [
            // 'students' => $students,
            'data' => $this->cashTransactionExpenditureRepository->results(),
            'cashTransactionExpendituresTrashedCount' => $cashTransactionExpendituresTrashedCount
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CashTransactionExpenditureStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CashTransactionExpenditureStoreRequest $request): RedirectResponse
    {
            Auth::user()->cash_transaction_expenditures()->create([
                // 'student_id' => $student_id,
                'expenditure' => $request->expenditure,
                'amount' => $request->amount,
                'date' => $request->date,
                'note' => $request->note
            ]);

        return redirect()->route('cash-transaction-expenditures.index')->with('success', 'Data berhasil ditambahkan!');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\CashTransactionExpenditureUpdateRequest  $request
     * @param  \App\Models\CashTransactionExpenditure  $cashTransactionExpenditure
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CashTransactionExpenditureUpdateRequest $request, CashTransactionExpenditure $cashTransactionExpenditure): RedirectResponse
    {
        $cashTransactionExpenditure->update($request->validated());

        return redirect()->route('cash-transaction-expenditures.index')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CashTransactionExpenditure  $cashTransactionExpenditure
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(CashTransactionExpenditure $cashTransactionExpenditure): RedirectResponse
    {
        $cashTransactionExpenditure->delete();

        return redirect()->route('cash-transaction-expenditures.index')->with('success', 'Data berhasil dihapus!');
    }
}
