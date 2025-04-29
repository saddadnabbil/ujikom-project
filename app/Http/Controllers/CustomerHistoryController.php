<?php

namespace App\Http\Controllers;

use App\Contracts\HistoryInterface;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CustomerHistoryController extends Controller implements HistoryInterface
{
    public function index(): View|JsonResponse
    {
        $customers = Customer::select(
            'id',
            'nama_customer',
            'email',
            'no_telp',
            'alamat'
        )->onlyTrashed()->get();

        if (request()->ajax()) {
            return datatables()->of($customers)
                ->addIndexColumn()
                ->addColumn('action', 'customer.history.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('customer.history.index');
    }

    public function restore(int $id): RedirectResponse
    {
        Customer::onlyTrashed()->findOrFail($id)->restore();
        return redirect()->route('customer.index.history')->with('success', 'Data customer berhasil dikembalikan!');
    }

    public function destroy(int $id): RedirectResponse
    {
        Customer::onlyTrashed()->findOrFail($id)->forceDelete();
        return redirect()->route('customer.index.history')->with('success', 'Data customer berhasil dihapus permanen!');
    }
}
