<?php

namespace App\Http\Controllers;

use App\Services\SuratMasukService;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use App\Traits\ApiResponse;

class SuratMasukController extends Controller
{
    use ApiResponse;

    protected $suratMasukService;

    public function __construct(SuratMasukService $suratMasukService)
    {
        $this->suratMasukService = $suratMasukService;
    }


    public function index()
    {
        $suratMasuks = $this->suratMasukService->getAll();
        return $this->successResponse($suratMasuks, 'List Surat Masuk fetched successfully');
    }

    public function store(Request $request)
    {
        Gate::authorize('create', SuratMasuk::class);

        $validated = $request->validate([
            'nomor_agenda' => 'nullable|string',
            'nomor_surat_asal' => 'required|string',
            'tanggal_surat' => 'required|date',
            'tanggal_diterima' => 'required|date',
            'asal_surat' => 'required|string',
            'perihal' => 'required|string',
            'isi_ringkas' => 'nullable|string',
            'kategori_id' => 'required|exists:kategori_surats,id',
            // File upload validation can be added here
        ]);

        $validated['created_by'] = Auth::id();

        $suratMasuk = $this->suratMasukService->store($validated);

        return $this->successResponse($suratMasuk, 'Surat Masuk berhasil ditambahkan', 201);
    }

    public function show($id)
    {
        $suratMasuk = SuratMasuk::with(['kategori', 'creator'])->findOrFail($id);
        return $this->successResponse($suratMasuk, 'Detail Surat Masuk fetched successfully');
    }

    public function update(Request $request, $id)
    {
        $suratMasuk = SuratMasuk::findOrFail($id);
        Gate::authorize('update', $suratMasuk);

        $validated = $request->validate([
            'nomor_agenda' => 'nullable|string',
            'nomor_surat_asal' => 'required|string',
            'tanggal_surat' => 'required|date',
            'tanggal_diterima' => 'required|date',
            'asal_surat' => 'required|string',
            'perihal' => 'required|string',
            'isi_ringkas' => 'nullable|string',
            'kategori_id' => 'required|exists:kategori_surats,id',
        ]);

        $suratMasuk = $this->suratMasukService->update($id, $validated);

        return $this->successResponse($suratMasuk, 'Surat Masuk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $suratMasuk = SuratMasuk::findOrFail($id);
        Gate::authorize('delete', $suratMasuk);
        
        $this->suratMasukService->delete($id);
        return $this->successResponse(null, 'Surat Masuk berhasil dihapus');
    }

    public function approve($id)
    {
        $this->suratMasukService->approve($id);
        return $this->successResponse(null, 'Surat Masuk disetujui');
    }

    public function reject($id)
    {
        $this->suratMasukService->reject($id);
        return $this->successResponse(null, 'Surat Masuk ditolak');
    }
}
