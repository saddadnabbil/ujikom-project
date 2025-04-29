<?php

namespace App\Http\Controllers;

use App\Contracts\HistoryInterface;
use App\Models\Faktur;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FakturHistoryController extends Controller implements HistoryInterface
{
    public function index(): View|JsonResponse
    {
        $fakturs = Faktur::onlyTrashed()->with(['customer', 'perusahaan'])->get();

        if (request()->ajax()) {
            return datatables()->of($fakturs)
                ->addIndexColumn()
                ->addColumn('customer', function ($row) {
                    return $row->customer->nama_customer ?? '-';
                })
                ->addColumn('perusahaan', function ($row) {
                    return $row->perusahaan->nama_perusahaan ?? '-';
                })
                ->addColumn('action', 'faktur.history.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('faktur.history.index');
    }

    public function restore(int $id): RedirectResponse
    {
        Faktur::onlyTrashed()->findOrFail($id)->restore();
        return redirect()->route('faktur.index.history')->with('success', 'Faktur berhasil dikembalikan!');
    }

    public function destroy(int $id): RedirectResponse
    {
        Faktur::onlyTrashed()->findOrFail($id)->forceDelete();
        return redirect()->route('faktur.index.history')->with('success', 'Faktur berhasil dihapus permanen!');
    }
}
