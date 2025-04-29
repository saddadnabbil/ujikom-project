<?php

namespace App\Http\Controllers;

use App\Contracts\HistoryInterface;
use App\Models\Produk;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProdukHistoryController extends Controller implements HistoryInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(): View|JsonResponse
    {
        $products = Produk::select(
            'id_produk',
            'nama_produk',
            'price',
            'stock',
            'jenis',
            'created_at',
            'updated_at'
        )->onlyTrashed()->get();

        if (request()->ajax()) {
            return datatables()->of($products)
                ->addIndexColumn()
                ->addColumn('action', 'produk.history.datatable.action') // Menyesuaikan dengan view bagian action
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('produk.history.index');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(int $id): RedirectResponse
    {
        Produk::onlyTrashed()->findOrFail($id)->restore(); // Mengembalikan produk yang dihapus (soft deleted)

        return redirect()->route('produk.index.history')->with('success', 'Produk berhasil dikembalikan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $product = Produk::onlyTrashed()->findOrFail($id); // Mendapatkan produk yang telah dihapus
        $product->forceDelete(); // Menghapus produk secara permanen

        return redirect()->route('produk.index.history')->with('success', 'Produk berhasil dihapus secara permanen!');
    }
}
