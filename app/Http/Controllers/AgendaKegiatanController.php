<?php

namespace App\Http\Controllers;

use App\Services\AgendaKegiatanService;
use App\Models\AgendaKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AgendaKegiatanController extends Controller
{
    protected $agendaService;

    public function __construct(AgendaKegiatanService $agendaService)
    {
        $this->agendaService = $agendaService;
    }

    public function index()
    {
        $agendas = $this->agendaService->getAll();
        return view('agenda_kegiatans.index', compact('agendas'));
    }

    public function create()
    {
        Gate::authorize('create', AgendaKegiatan::class);
        return view('agenda_kegiatans.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('create', AgendaKegiatan::class);

        $validated = $request->validate([
            'nama_kegiatan' => 'required|string',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'nullable|date|after_or_equal:waktu_mulai',
            'tempat' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'jenis_agenda_id' => 'required|exists:jenis_agendas,id',
        ]);

        $validated['created_by'] = Auth::id();

        $this->agendaService->store($validated);

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil ditambahkan.');
    }

    public function show($id)
    {
        $agenda = AgendaKegiatan::with(['jenisAgenda', 'creator'])->findOrFail($id);
        return view('agenda_kegiatans.show', compact('agenda'));
    }

    public function edit($id)
    {
        $agenda = AgendaKegiatan::findOrFail($id);
        Gate::authorize('update', $agenda);
        return view('agenda_kegiatans.edit', compact('agenda'));
    }

    public function update(Request $request, $id)
    {
        $agenda = AgendaKegiatan::findOrFail($id);
        Gate::authorize('update', $agenda);

        $validated = $request->validate([
            'nama_kegiatan' => 'required|string',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'nullable|date|after_or_equal:waktu_mulai',
            'tempat' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'jenis_agenda_id' => 'required|exists:jenis_agendas,id',
        ]);

        $this->agendaService->update($id, $validated);

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $agenda = AgendaKegiatan::findOrFail($id);
        Gate::authorize('delete', $agenda);

        $this->agendaService->delete($id);
        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil dihapus.');
    }

    public function approve($id)
    {
        $this->agendaService->approve($id);
        return redirect()->back()->with('success', 'Agenda disetujui.');
    }

    public function reject($id)
    {
        $this->agendaService->reject($id);
        return redirect()->back()->with('success', 'Agenda ditolak.');
    }
}
