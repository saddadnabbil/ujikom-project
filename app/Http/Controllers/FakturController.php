<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Faktur;
use App\Models\Produk;
use App\Models\Customer;
use Illuminate\View\View;
use App\Models\Perusahaan;
use Barryvdh\DomPDF\Facade\Pdf;
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
        $produks = Produk::all();

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
    /**
     * Store a newly created resource in storage.
     *
     * @param FakturStoreRequest $request
     * @return RedirectResponse
     */
    public function store(FakturStoreRequest $request): RedirectResponse
    {
        $product = Produk::where('id_produk', 1)->first();

        $validated = $request->validated();

        // Get details and remove from main data
        $details = $validated['details'];
        unset($validated['details']);

        // Generate a new faktur number or take the provided one
        $validated['no_faktur'] = $this->generateFakturNumber(); // Assuming a method to generate no_faktur

        // Format date
        $validated['tanggal_faktur'] = Carbon::parse($validated['tanggal_faktur'])->format('Y-m-d');
        $validated['due_date'] = Carbon::parse($validated['due_date'])->format('Y-m-d');

        // Start a database transaction
        \DB::beginTransaction();

        try {
            // Create the faktur
            $faktur = Faktur::create($validated);

            foreach ($details as $detail) {
                \App\Models\DetailFaktur::create([
                    'no_faktur' => $faktur->no_faktur,
                    'id_produk' => $detail['id_produk'], // Ensure this is correct
                    'qty' => $detail['qty'],
                    'price' => $detail['price'],
                    'subtotal' => $detail['subtotal'],
                ]);
            }

            // Commit the transaction
            \DB::commit();

            return redirect()->route('faktur.index')->with('success', 'Faktur berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Roll back the transaction if something fails
            \DB::rollback();

            dd($e);

            return redirect()->route('faktur.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    private function generateFakturNumber(): string
    {
        // Example: generate a simple faktur number based on current date and sequence
        return 'FKT-' . Carbon::now()->format('YmdHis');
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
        $validated = $request->validated();

        // Get details and remove from main data
        $details = $validated['details'] ?? null;
        unset($validated['details']);


        // Format date
        $validated['tanggal_faktur'] = Carbon::parse($validated['tanggal_faktur'])->format('Y-m-d');
        $validated['due_date'] = Carbon::parse($validated['due_date'])->format('Y-m-d');

        // Start a database transaction
        \DB::beginTransaction();

        try {
            // Update the faktur
            $faktur->update($validated);

            // If details exist, update them as well
            if ($details) {
                // Delete existing details first if any
                $faktur->detailFakturs()->delete();

                // Create new details
                foreach ($details as $detail) {
                    $faktur->detailFakturs()->create([
                        'id_produk' => $detail['id_produk'],
                        'qty' => $detail['qty'],
                        'price' => $detail['price'],
                        'subtotal' => $detail['subtotal'],  // Optional
                    ]);
                }
            }

            // Commit the transaction
            \DB::commit();

            return redirect()->route('faktur.index')->with('success', 'Faktur berhasil diperbarui!');
        } catch (\Exception $e) {
            // Roll back the transaction if something fails
            \DB::rollback();

            return redirect()->route('faktur.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
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

    public function print($id)
    {
        $faktur = Faktur::with(['customer', 'perusahaan', 'detailFakturs.produk'])->findOrFail($id);
        $pdf = Pdf::loadView('faktur.pdf', compact('faktur'))->setPaper('A4', 'portrait');

        return $pdf->stream('Faktur_' . $faktur->no_faktur . '.pdf');
    }
}
