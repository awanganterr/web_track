<?php

namespace App\Http\Controllers;

use App\Services\SuratKeluarService;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SuratKeluarController extends Controller
{
    protected $suratKeluarService;

    public function __construct(SuratKeluarService $suratKeluarService)
    {
        $this->suratKeluarService = $suratKeluarService;
    }

    public function index()
    {
        $suratKeluars = $this->suratKeluarService->getAll();
        return view('surat_keluars.index', compact('suratKeluars'));
    }

    public function create()
    {
        Gate::authorize('create', SuratKeluar::class);
        return view('surat_keluars.create');
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

        $this->suratKeluarService->store($validated);

        return redirect()->route('surat-keluar.index')->with('success', 'Surat Keluar berhasil ditambahkan.');
    }

    public function show($id)
    {
        $suratKeluar = SuratKeluar::with(['kategori', 'creator'])->findOrFail($id);
        return view('surat_keluars.show', compact('suratKeluar'));
    }

    public function edit($id)
    {
        $suratKeluar = SuratKeluar::findOrFail($id);
        Gate::authorize('update', $suratKeluar);
        return view('surat_keluars.edit', compact('suratKeluar'));
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

        $this->suratKeluarService->update($id, $validated);

        return redirect()->route('surat-keluar.index')->with('success', 'Surat Keluar berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $suratKeluar = SuratKeluar::findOrFail($id);
        Gate::authorize('delete', $suratKeluar);

        $this->suratKeluarService->delete($id);
        return redirect()->route('surat-keluar.index')->with('success', 'Surat Keluar berhasil dihapus.');
    }

    public function approve($id)
    {
        $this->suratKeluarService->approve($id);
        return redirect()->back()->with('success', 'Surat Keluar disetujui.');
    }

    public function reject($id)
    {
        $this->suratKeluarService->reject($id);
        return redirect()->back()->with('success', 'Surat Keluar ditolak.');
    }
}
