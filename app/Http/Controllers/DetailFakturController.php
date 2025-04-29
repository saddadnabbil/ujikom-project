<?php

namespace App\Http\Controllers;

use App\Models\DetailFaktur;
use App\Models\Faktur;
use App\Models\Produk;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\DetailFakturStoreRequest;
use App\Http\Requests\DetailFakturUpdateRequest;

class DetailFakturController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Faktur $faktur
     * @return View|JsonResponse
     */
    public function index(Faktur $faktur): View|JsonResponse
    {
        $detailFakturs = DetailFaktur::with(['produk'])
            ->where('faktur_id', $faktur->id)
            ->get();

        $produks = Produk::all(); // Fetch all products

        if (request()->ajax()) {
            return datatables()->of($detailFakturs)
                ->addIndexColumn()
                ->addColumn('produk', function ($row) {
                    return $row->produk->nama_produk ?? '-';
                })
                ->addColumn('action', 'detail-faktur.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }

        // Count total detail faktur records for this faktur
        $totalDetailFakturCount = DetailFaktur::where('faktur_id', $faktur->id)->count();

        // If using soft deletes for DetailFaktur model, count the trashed records
        // Uncomment this if DetailFaktur uses SoftDeletes trait
        // $detailFakturTrashedCount = DetailFaktur::where('faktur_id', $faktur->id)->onlyTrashed()->count();

        // If not using soft deletes, set this to 0 or remove from the view
        $detailFakturTrashedCount = 0;

        return view('detail-faktur.index', compact(
            'faktur',
            'produks',
            'totalDetailFakturCount',
            'detailFakturTrashedCount'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DetailFakturStoreRequest $request
     * @param Faktur $faktur
     * @return RedirectResponse
     */
    public function store(DetailFakturStoreRequest $request, Faktur $faktur): RedirectResponse
    {
        // Get the validated data
        $validated = $request->validated();

        // Ensure faktur_id is set correctly
        $validated['faktur_id'] = $faktur->id;

        // Create the record
        DetailFaktur::create($validated);

        return redirect()->route('detail-faktur.index', $faktur->id)->with('success', 'Detail Faktur berhasil ditambahkan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DetailFakturUpdateRequest $request
     * @param DetailFaktur $detailFaktur
     * @return RedirectResponse
     */
    public function update(DetailFakturUpdateRequest $request, DetailFaktur $detailFaktur): RedirectResponse
    {
        $detailFaktur->update($request->validated());

        return redirect()->route('detail-faktur.index', $detailFaktur->faktur_id)->with('success', 'Detail Faktur berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DetailFaktur $detailFaktur
     * @return RedirectResponse
     */
    public function destroy(DetailFaktur $detailFaktur): RedirectResponse
    {
        $fakturId = $detailFaktur->faktur_id;
        $detailFaktur->delete();

        return redirect()->route('detail-faktur.index', $fakturId)->with('success', 'Detail Faktur berhasil dihapus!');
    }
}
