<?php

namespace App\Http\Controllers;

use App\Services\SuratMasukService;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SuratMasukController extends Controller
{
    protected $suratMasukService;

    public function __construct(SuratMasukService $suratMasukService)
    {
        $this->suratMasukService = $suratMasukService;
    }

    public function index()
    {
        $suratMasuks = $this->suratMasukService->getAll();
        return view('surat_masuks.index', compact('suratMasuks'));
    }

    public function create()
    {
        Gate::authorize('create', SuratMasuk::class);
        return view('surat_masuks.create');
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

        $this->suratMasukService->store($validated);

        return redirect()->route('surat-masuk.index')->with('success', 'Surat Masuk berhasil ditambahkan.');
    }

    public function show($id)
    {
        $suratMasuk = SuratMasuk::with(['kategori', 'creator'])->findOrFail($id);
        return view('surat_masuks.show', compact('suratMasuk'));
    }

    public function edit($id)
    {
        $suratMasuk = SuratMasuk::findOrFail($id);
        Gate::authorize('update', $suratMasuk);
        return view('surat_masuks.edit', compact('suratMasuk'));
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

        $this->suratMasukService->update($id, $validated);

        return redirect()->route('surat-masuk.index')->with('success', 'Surat Masuk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $suratMasuk = SuratMasuk::findOrFail($id);
        Gate::authorize('delete', $suratMasuk);
        
        $this->suratMasukService->delete($id);
        return redirect()->route('surat-masuk.index')->with('success', 'Surat Masuk berhasil dihapus.');
    }

    public function approve($id)
    {
        $this->suratMasukService->approve($id);
        return redirect()->back()->with('success', 'Surat Masuk disetujui.');
    }

    public function reject($id)
    {
        $this->suratMasukService->reject($id);
        return redirect()->back()->with('success', 'Surat Masuk ditolak.');
    }
}
