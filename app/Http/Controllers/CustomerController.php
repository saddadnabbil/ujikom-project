<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(): View|JsonResponse
    {
        $customers = Customer::select('id', 'nama_customer', 'email', 'no_telp', 'alamat')
            ->orderBy('nama_customer')
            ->get();

        if (request()->ajax()) {
            return datatables()->of($customers)
                ->addIndexColumn()
                ->addColumn('action', 'customer.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }

        $totalCustomerCount = Customer::count(); // Total customers
        $customerTrashedCount = Customer::onlyTrashed()->count(); // Count of trashed customers

        return view('customer.index', compact('totalCustomerCount', 'customerTrashedCount'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CustomerStoreRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CustomerStoreRequest $request): RedirectResponse
    {
        Customer::create($request->validated());

        return redirect()->route('customer.index')->with('success', 'Customer berhasil ditambahkan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CustomerUpdateRequest  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CustomerUpdateRequest $request, Customer $customer): RedirectResponse
    {
        $customer->update($request->validated());

        return redirect()->route('customer.index')->with('success', 'Customer berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Customer $customer): RedirectResponse
    {
        $customer->delete();

        return redirect()->route('customer.index')->with('success', 'Customer berhasil dihapus!');
    }
}
