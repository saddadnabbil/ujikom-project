<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\KategoriStoreRequest;
use App\Http\Requests\KategoriUpdateRequest;

class KategoriController extends Controller
{
    public function index(): View|JsonResponse
    {
        $kategoris = Kategori::orderBy('kategori_buku')
            ->get();

        if (request()->ajax()) {
            return datatables()->of($kategoris)
                ->addIndexColumn()
                ->addColumn('action', 'kategori.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }

        $totalKategoriCount = Kategori::count(); // Total Kategoris
        $kategoriTrashedCount = Kategori::onlyTrashed()->count(); // Count of trashed Kategoris

        return view('kategori.index', compact('totalKategoriCount', 'kategoriTrashedCount', 'kategoris'));
    }

    public function store(KategoriStoreRequest $request): RedirectResponse
    {
        Kategori::create($request->validated());

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function update(KategoriUpdateRequest $request, Kategori $kategori): RedirectResponse
    {
        $kategori->update($request->validated());

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(Kategori $kategori): RedirectResponse
    {
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
