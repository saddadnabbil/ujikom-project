<?php

namespace App\Http\Controllers;

use App\Models\Denda;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\DendaStoreRequest;
use App\Http\Requests\DendaUpdateRequest;

class DendaController extends Controller
{
    public function index(): View|JsonResponse
    {
        $dendas = Denda::orderBy('nominal')
            ->get();

        if (request()->ajax()) {
            return datatables()->of($dendas)
                ->addIndexColumn()
                ->addColumn('action', 'denda.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }

        $totalDendaCount = Denda::count(); // Total Dendas
        $dendaTrashedCount = Denda::onlyTrashed()->count(); // Count of trashed Dendas

        return view('denda.index', compact('totalDendaCount', 'dendaTrashedCount', 'dendas'));
    }

    public function store(DendaStoreRequest $request): RedirectResponse
    {
        Denda::create($request->validated());

        return redirect()->route('denda.index')->with('success', 'Denda berhasil ditambahkan!');
    }

    public function update(DendaUpdateRequest $request, Denda $denda): RedirectResponse
    {
        $denda->update($request->validated());

        return redirect()->route('denda.index')->with('success', 'Denda berhasil diperbarui!');
    }

    public function destroy(Denda $denda): RedirectResponse
    {
        $denda->delete();

        return redirect()->route('denda.index')->with('success', 'Denda berhasil dihapus!');
    }
}
