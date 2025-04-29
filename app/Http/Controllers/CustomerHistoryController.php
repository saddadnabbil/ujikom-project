<?php

namespace App\Http\Controllers;

use App\Contracts\HistoryInterface;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CustomerHistoryController extends Controller implements HistoryInterface
{
    /**
     * Display a listing of the trashed customers.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(): View|JsonResponse
    {
        // Select only the required fields
        $customers = Customer::select(
            'id',
            'nama_customer',
            'perusahaan_cust', // Use 'perusahaan_cust' instead of 'email' and 'no_telp'
            'alamat'
        )->onlyTrashed() // Get only trashed customers
            ->get();

        if (request()->ajax()) {
            return datatables()->of($customers)
                ->addIndexColumn()
                ->addColumn('action', 'customer.history.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('customer.history.index');
    }

    /**
     * Restore a trashed customer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(int $id): RedirectResponse
    {
        // Restore the customer from the trashed state
        Customer::onlyTrashed()->findOrFail($id)->restore();
        return redirect()->route('customer.index.history')->with('success', 'Data customer berhasil dikembalikan!');
    }

    /**
     * Permanently delete a trashed customer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        // Permanently delete the customer
        Customer::onlyTrashed()->findOrFail($id)->forceDelete();
        return redirect()->route('customer.index.history')->with('success', 'Data customer berhasil dihapus permanen!');
    }
}
