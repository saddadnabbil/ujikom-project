<?php

namespace App\Http\Controllers;

use App\Contracts\HistoryInterface;
use App\Models\Perusahaan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PerusahaanHistoryController extends Controller implements HistoryInterface
{
    public function index(): View|JsonResponse
    {
        $perusahaans = Perusahaan::select('id', 'nama_perusahaan', 'alamat')->onlyTrashed()->get();

        if (request()->ajax()) {
            return datatables()->of($perusahaans)
                ->addIndexColumn()
                ->addColumn('action', 'perusahaan.history.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('perusahaan.history.index');
    }

    public function restore(int $id): RedirectResponse
    {
        Perusahaan::onlyTrashed()->findOrFail($id)->restore();
        return redirect()->route('perusahaan.index.history')->with('success', 'Data perusahaan berhasil dikembalikan!');
    }

    public function destroy(int $id): RedirectResponse
    {
        Perusahaan::onlyTrashed()->findOrFail($id)->forceDelete();
        return redirect()->route('perusahaan.index.history')->with('success', 'Data perusahaan berhasil dihapus permanen!');
    }
}
