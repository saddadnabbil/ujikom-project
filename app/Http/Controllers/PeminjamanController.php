<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User;
use App\Models\Denda;
use App\Models\Anggota;
use Illuminate\View\View;
use App\Models\Peminjaman;
use App\Models\DetailPinjam;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|JsonResponse
    {
        $peminjaman = Peminjaman::with(['anggota', 'user', 'denda'])->get();

        $anggotas = Anggota::all();
        $users = User::all();
        $dendas = Denda::all();

        if (request()->ajax()) {
            return datatables()
                ->of($peminjaman)
                ->addIndexColumn()
                ->addColumn('action', 'peminjaman.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }

        // Fetch totals and trashed counts
        $totalPeminjamanCount = Peminjaman::count();
        $peminjamanTrashedCount = Peminjaman::onlyTrashed()->count();

        // Pass the data to the view
        return view('peminjaman.index', compact(
            'totalPeminjamanCount',
            'peminjamanTrashedCount',
            'peminjaman',
            'anggotas',
            'users',
            'dendas'
        ));
    }

    // Other methods remain unchanged

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $anggotas = Anggota::all();
        $users = User::all();
        $dendas = Denda::all();
        $bukus = Buku::all();

        return view('peminjaman.create', compact('anggotas', 'users', 'dendas', 'bukus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the main peminjaman data
        $validator = Validator::make($request->all(), [
            'id_pinjam' => 'required|string|max:255|unique:peminjamen',
            'lama_pinjam' => 'required|integer',
            'nominal_denda' => 'required|numeric',
            'id_anggota' => 'required|exists:anggotas,id',
            'id_denda' => 'required|exists:dendas,id',
            'id_user' => 'required|exists:users,id',
            'id_buku.*' => 'required|exists:bukus,id',
            'tgl_kembali.*' => 'nullable|date',
            'status.*' => 'required|in:dipinjam,dikembalikan',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Begin transaction
            DB::beginTransaction();

            // Create new peminjaman
            $peminjaman = Peminjaman::create([
                'id_pinjam' => $request->id_pinjam,
                'lama_pinjam' => $request->lama_pinjam,
                'nominal_denda' => $request->nominal_denda,
                'id_anggota' => $request->id_anggota,
                'id_denda' => $request->id_denda,
                'id_user' => $request->id_user,
            ]);

            // Create detail_pinjam records
            if ($request->has('id_buku')) {
                foreach ($request->id_buku as $key => $bukuId) {
                    DetailPinjam::create([
                        'id_pinjam' => $peminjaman->id,
                        'id_buku' => $bukuId,
                        'tgl_kembali' => $request->tgl_kembali[$key] ?? null,
                        'status' => $request->status[$key] ?? 'dipinjam',
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('peminjaman.index')
                ->with('success', 'Peminjaman berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peminjaman $peminjaman): View
    {
        $peminjaman->load('detailPinjam.buku');

        $anggotas = Anggota::all();
        $users = User::all();
        $dendas = Denda::all();
        $bukus = Buku::all();

        return view('peminjaman.edit', compact('peminjaman', 'anggotas', 'users', 'dendas', 'bukus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Peminjaman $peminjaman): RedirectResponse
    {
        // Validate the main peminjaman data
        $validator = Validator::make($request->all(), [
            'id_pinjam' => 'required|string|max:255|unique:peminjamen,id_pinjam,' . $peminjaman->id,
            'lama_pinjam' => 'required|integer',
            'nominal_denda' => 'required|numeric',
            'id_anggota' => 'required|exists:anggotas,id',
            'id_denda' => 'required|exists:dendas,id',
            'id_user' => 'required|exists:users,id',
            'id_buku.*' => 'required|exists:bukus,id',
            'tgl_kembali.*' => 'nullable|date',
            'status.*' => 'required|in:dipinjam,dikembalikan',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Begin transaction
            DB::beginTransaction();

            // Update peminjaman
            $peminjaman->update([
                'id_pinjam' => $request->id_pinjam,
                'lama_pinjam' => $request->lama_pinjam,
                'nominal_denda' => $request->nominal_denda,
                'id_anggota' => $request->id_anggota,
                'id_denda' => $request->id_denda,
                'id_user' => $request->id_user,
            ]);

            // Handle detail_pinjam records
            // Get existing detail IDs
            $existingDetailIds = $peminjaman->detailPinjam->pluck('id')->toArray();
            $submittedDetailIds = [];

            if ($request->has('detail_id') && $request->has('id_buku')) {
                foreach ($request->detail_id as $key => $detailId) {
                    // Create new detail record
                    if ($detailId === 'new') {
                        DetailPinjam::create([
                            'id_pinjam' => $peminjaman->id,
                            'id_buku' => $request->id_buku[$key],
                            'tgl_kembali' => $request->tgl_kembali[$key] ?? null,
                            'status' => $request->status[$key] ?? 'dipinjam',
                        ]);
                    }
                    // Update existing detail record
                    else {
                        $detailPinjam = DetailPinjam::find($detailId);
                        if ($detailPinjam) {
                            $detailPinjam->update([
                                'id_buku' => $request->id_buku[$key],
                                'tgl_kembali' => $request->tgl_kembali[$key] ?? null,
                                'status' => $request->status[$key] ?? 'dipinjam',
                            ]);
                            $submittedDetailIds[] = (int) $detailId;
                        }
                    }
                }
            }

            // Delete detail records that were not included in the form
            $detailsToDelete = array_diff($existingDetailIds, $submittedDetailIds);
            if (!empty($detailsToDelete)) {
                DetailPinjam::whereIn('id', $detailsToDelete)->delete();
            }

            DB::commit();

            return redirect()->route('peminjaman.index')
                ->with('success', 'Peminjaman berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Get all books as JSON for AJAX request
     */
    public function getBooks(): JsonResponse
    {
        $books = Buku::select('id', 'judul')->get();
        return response()->json($books);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peminjaman $peminjaman): RedirectResponse
    {
        try {
            DB::beginTransaction();

            // Soft delete all related DetailPinjam records
            DetailPinjam::where('id_pinjam', $peminjaman->id)->delete();

            // Soft delete the Peminjaman
            $peminjaman->delete();

            DB::commit();
            return redirect()->route('peminjaman.index')
                ->with('success', 'Peminjaman berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('peminjaman.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Restore the specified resource from trash.
     */
    public function restore($id): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $peminjaman = Peminjaman::onlyTrashed()->findOrFail($id);
            $peminjaman->restore();

            // Restore related detail pinjam records
            DetailPinjam::onlyTrashed()
                ->where('id_pinjam', $peminjaman->id)
                ->restore();

            DB::commit();
            return redirect()->route('peminjaman.index')
                ->with('success', 'Peminjaman berhasil dipulihkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('peminjaman.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Permanently delete the specified resource from storage.
     */
    public function forceDelete($id): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $peminjaman = Peminjaman::onlyTrashed()->findOrFail($id);

            // Permanently delete related DetailPinjam records
            DetailPinjam::onlyTrashed()
                ->where('id_pinjam', $peminjaman->id)
                ->forceDelete();

            // Permanently delete the Peminjaman
            $peminjaman->forceDelete();

            DB::commit();
            return redirect()->route('peminjaman.trashed')
                ->with('success', 'Peminjaman berhasil dihapus permanen!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('peminjaman.trashed')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    public function generatePdf()
    {
        $peminjaman = Peminjaman::with(['anggota', 'user', 'denda'])
            ->orderBy('id_pinjam')
            ->get();

        $pdf = Pdf::loadView('peminjaman.pdf', compact('peminjaman'))
            ->setPaper('A4', 'landscape');

        return $pdf->stream('anggota.pdf');
    }
}
