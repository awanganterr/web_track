<?php

namespace App\Http\Controllers;

use App\Services\SuratKeluarService;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use App\Traits\ApiResponse;

class SuratKeluarController extends Controller
{
    use ApiResponse;

    protected $suratKeluarService;

    public function __construct(SuratKeluarService $suratKeluarService)
    {
        $this->suratKeluarService = $suratKeluarService;
    }


    public function index()
    {
        $suratKeluars = $this->suratKeluarService->getAll();
        return $this->successResponse($suratKeluars, 'List Surat Keluar fetched successfully');
    }

    public function store(Request $request)
    {
        Gate::authorize('create', SuratKeluar::class);

        $validated = $request->validate([
            'nomor_agenda' => 'nullable|string',
            'nomor_surat' => 'required|string',
            'tanggal_surat' => 'required|date',
            'tujuan_surat' => 'required|string',
            'perihal' => 'required|string',
            'isi_ringkas' => 'nullable|string',
            'kategori_id' => 'required|exists:kategori_surats,id',
        ]);

        $validated['created_by'] = Auth::id();

        $suratKeluar = $this->suratKeluarService->store($validated);

        return $this->successResponse($suratKeluar, 'Surat Keluar berhasil ditambahkan', 201);
    }

    public function show($id)
    {
        $suratKeluar = SuratKeluar::with(['kategori', 'creator'])->findOrFail($id);
        return $this->successResponse($suratKeluar, 'Detail Surat Keluar fetched successfully');
    }

    public function update(Request $request, $id)
    {
        $suratKeluar = SuratKeluar::findOrFail($id);
        Gate::authorize('update', $suratKeluar);

        $validated = $request->validate([
            'nomor_agenda' => 'nullable|string',
            'nomor_surat' => 'required|string',
            'tanggal_surat' => 'required|date',
            'tujuan_surat' => 'required|string',
            'perihal' => 'required|string',
            'isi_ringkas' => 'nullable|string',
            'kategori_id' => 'required|exists:kategori_surats,id',
        ]);

        $suratKeluar = $this->suratKeluarService->update($id, $validated);

        return $this->successResponse($suratKeluar, 'Surat Keluar berhasil diperbarui');
    }

    public function destroy($id)
    {
        $suratKeluar = SuratKeluar::findOrFail($id);
        Gate::authorize('delete', $suratKeluar);

        $this->suratKeluarService->delete($id);
        return $this->successResponse(null, 'Surat Keluar berhasil dihapus');
    }

    public function approve($id)
    {
        $this->suratKeluarService->approve($id);
        return $this->successResponse(null, 'Surat Keluar disetujui');
    }

    public function reject($id)
    {
        $this->suratKeluarService->reject($id);
        return $this->successResponse(null, 'Surat Keluar ditolak');
    }
}
