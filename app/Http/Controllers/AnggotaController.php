<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\AnggotaStoreRequest;
use App\Http\Requests\AnggotaUpdateRequest;

class AnggotaController extends Controller
{
    public function index(): View|JsonResponse
    {
        $anggotas = Anggota::orderBy('nama')
            ->get();

        if (request()->ajax()) {
            return datatables()->of($anggotas)
                ->addIndexColumn()
                ->addColumn('action', 'anggota.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }

        $totalAnggotaCount = Anggota::count(); // Total Anggotas

        return view('anggota.index', compact('totalAnggotaCount', 'anggotas'));
    }

    public function store(AnggotaStoreRequest $request): RedirectResponse
    {
        Anggota::create($request->validated());

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil ditambahkan!');
    }

    public function update(AnggotaUpdateRequest $request, Anggota $kategori): RedirectResponse
    {
        $kategori->update($request->validated());

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil diperbarui!');
    }

    public function destroy(Anggota $kategori): RedirectResponse
    {
        $kategori->delete();

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil dihapus!');
    }
}
