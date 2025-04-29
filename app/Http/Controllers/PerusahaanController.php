<?php

namespace App\Http\Controllers;

use App\Http\Requests\PerusahaanStoreRequest;
use App\Http\Requests\PerusahaanUpdateRequest;
use App\Models\Perusahaan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(): View|JsonResponse
    {
        $perusahaans = Perusahaan::select('id', 'nama_perusahaan', 'alamat', 'no_telp', 'fax')
            ->orderBy('nama_perusahaan')
            ->get();

        if (request()->ajax()) {
            return datatables()->of($perusahaans)
                ->addIndexColumn()
                ->addColumn('action', 'perusahaan.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }

        $totalPerusahaanCount = Perusahaan::count(); // Total companies
        $perusahaanTrashedCount = Perusahaan::onlyTrashed()->count(); // Count of trashed companies

        return view('perusahaan.index', compact('totalPerusahaanCount', 'perusahaanTrashedCount'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PerusahaanStoreRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PerusahaanStoreRequest $request): RedirectResponse
    {
        Perusahaan::create($request->validated());

        return redirect()->route('perusahaan.index')->with('success', 'Perusahaan berhasil ditambahkan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PerusahaanUpdateRequest  $request
     * @param  \App\Models\Perusahaan  $perusahaan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PerusahaanUpdateRequest $request, Perusahaan $perusahaan): RedirectResponse
    {
        $perusahaan->update($request->validated());

        return redirect()->route('perusahaan.index')->with('success', 'Perusahaan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perusahaan  $perusahaan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Perusahaan $perusahaan): RedirectResponse
    {
        $perusahaan->delete();

        return redirect()->route('perusahaan.index')->with('success', 'Perusahaan berhasil dihapus!');
    }
}
