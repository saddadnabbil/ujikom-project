<?php

namespace App\Http\Controllers;

use App\Models\DetailFaktur;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DetailFakturHistoryController extends Controller
{
    /**
     * Menampilkan list Detail Faktur yang sudah dihapus (history).
     */
    public function index(): View|JsonResponse
    {
        $detailFakturs = DetailFaktur::onlyTrashed()->with(['produk', 'faktur'])->get();

        if (request()->ajax()) {
            return datatables()->of($detailFakturs)
                ->addIndexColumn()
                ->addColumn('produk', function ($row) {
                    return $row->produk->nama_produk ?? '-';
                })
                ->addColumn('faktur', function ($row) {
                    return $row->faktur->nomor_faktur ?? '-';
                })
                ->addColumn('action', 'detail-faktur.history.datatable.action') // file blade action
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('detail-faktur.history.index');
    }

    /**
     * Restore Detail Faktur yang terhapus.
     */
    public function restore(int $id): RedirectResponse
    {
        DetailFaktur::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->route('detail-faktur.index.history')->with('success', 'Detail Faktur berhasil dikembalikan!');
    }

    /**
     * Menghapus permanen Detail Faktur.
     */
    public function destroy(int $id): RedirectResponse
    {
        DetailFaktur::onlyTrashed()->findOrFail($id)->forceDelete();

        return redirect()->route('detail-faktur.index.history')->with('success', 'Detail Faktur berhasil dihapus permanen!');
    }
}
