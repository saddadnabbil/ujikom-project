<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdukStoreRequest;
use App\Http\Requests\ProdukUpdateRequest;
use App\Models\Produk;
use App\Repositories\ProdukRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProdukController extends Controller
{

    public function __construct(
        private ProdukRepository $produkRepository
    ) {}

    public function index(): View|JsonResponse
    {
        $produks = Produk::select('id', 'nama_produk', 'price')
            ->orderBy('nama_produk')
            ->get();

        if (request()->ajax()) {
            return datatables()->of($produks)
                ->addIndexColumn()
                ->addColumn('action', 'produk.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }

        $totalProductCount = Produk::count(); // Total products
        $produkTrashedCount = Produk::onlyTrashed()->count(); // Count of trashed products


        return view('produk.index', compact('totalProductCount', 'produkTrashedCount'));
    }

    public function store(ProdukStoreRequest $request): RedirectResponse
    {
        Produk::create($request->validated());

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function update(ProdukUpdateRequest $request, Produk $produk): RedirectResponse
    {
        $produk->update($request->validated());

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Produk $produk): RedirectResponse
    {
        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}
