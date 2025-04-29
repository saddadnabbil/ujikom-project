<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Faktur;
use App\Models\Produk;
use App\Models\Customer;
use Illuminate\View\View;
use App\Models\Perusahaan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\FakturStoreRequest;
use App\Http\Requests\FakturUpdateRequest;

class FakturController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View|JsonResponse
     */
    public function index(): View|JsonResponse
    {
        $fakturs = Faktur::with(['customer', 'perusahaan'])
            ->select('id', 'customer_id', 'perusahaan_id', 'tanggal_faktur', 'total')
            ->orderBy('tanggal_faktur', 'desc')
            ->get();

        $customers = Customer::all();
        $perusahaans = Perusahaan::all();
        $produks = Produk::all(); // Add this line

        if (request()->ajax()) {
            return datatables()->of($fakturs)
                ->addIndexColumn()
                ->addColumn('customer', function ($row) {
                    return $row->customer->nama_customer ?? '-';
                })
                ->addColumn('perusahaan', function ($row) {
                    return $row->perusahaan->nama_perusahaan ?? '-';
                })
                ->addColumn('action', 'faktur.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }

        $totalFakturCount = Faktur::count();
        $fakturTrashedCount = Faktur::onlyTrashed()->count();

        return view('faktur.index', compact('totalFakturCount', 'fakturTrashedCount', 'customers', 'perusahaans', 'produks'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param FakturStoreRequest $request
     * @return RedirectResponse
     */
    public function store(FakturStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // Get details and remove from main data
        $details = $validated['details'];
        unset($validated['details']);

        // Format date
        $validated['tanggal_faktur'] = Carbon::parse($validated['tanggal_faktur'])->format('Y-m-d');

        // Start a database transaction
        \DB::beginTransaction();

        try {
            // Create the faktur
            $faktur = Faktur::create($validated);

            // Create all detail fakturs
            foreach ($details as $detail) {
                $faktur->detailFakturs()->create([
                    'produk_id' => $detail['produk_id'],
                    'jumlah' => $detail['jumlah'],
                    'harga_satuan' => $detail['harga_satuan'],
                    'subtotal' => $detail['subtotal'],
                ]);
            }

            // Commit the transaction
            \DB::commit();

            return redirect()->route('faktur.index')->with('success', 'Faktur berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Roll back the transaction if something fails
            \DB::rollback();

            return redirect()->route('faktur.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FakturUpdateRequest $request
     * @param Faktur $faktur
     * @return RedirectResponse
     */
    public function update(FakturUpdateRequest $request, Faktur $faktur): RedirectResponse
    {
        $faktur->update($request->validated());

        return redirect()->route('faktur.index')->with('success', 'Faktur berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Faktur $faktur
     * @return RedirectResponse
     */
    public function destroy(Faktur $faktur): RedirectResponse
    {
        $faktur->delete();

        return redirect()->route('faktur.index')->with('success', 'Faktur berhasil dihapus!');
    }
}
