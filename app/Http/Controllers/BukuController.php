<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\BukuStoreRequest;
use App\Http\Requests\BukuUpdateRequest;

class BukuController extends Controller
{
    public function index(): View|JsonResponse
    {
        $bukus = Buku::orderBy('judul')
            ->get();
        $kategoris = Kategori::orderBy('kategori_buku')
            ->get();

        if (request()->ajax()) {
            return datatables()->of($bukus)
                ->addIndexColumn()
                ->addColumn('action', 'buku.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }

        $totalBukuCount = Buku::count(); // Total Bukus
        $bukuTrashedCount = Buku::onlyTrashed()->count(); // Count of trashed Bukus

        return view('buku.index', compact('totalBukuCount', 'bukuTrashedCount', 'kategoris'));
    }

    public function store(BukuStoreRequest $request): RedirectResponse
    {
        Buku::create($request->validated());

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function update(BukuUpdateRequest $request, Buku $buku): RedirectResponse
    {
        $buku->update($request->validated());

        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui!');
    }

    public function destroy(Buku $buku): RedirectResponse
    {
        $buku->delete();

        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus!');
    }

    public function generatePdf()
    {
        $bukus = Buku::with('kategori')->orderBy('judul')->get();

        $pdf = Pdf::loadView('buku.pdf', compact('bukus'))->setPaper('A4', 'portrait');

        return $pdf->stream('Anggota.pdf');
    }
}
