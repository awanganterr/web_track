<?php

namespace App\Http\Controllers;

use App\Services\AgendaKegiatanService;
use App\Models\AgendaKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use App\Traits\ApiResponse;

class AgendaKegiatanController extends Controller
{
    use ApiResponse;

    protected $agendaService;

    public function __construct(AgendaKegiatanService $agendaService)
    {
        $this->agendaService = $agendaService;
    }


    public function index()
    {
        $agendas = $this->agendaService->getAll();
        return $this->successResponse($agendas, 'List Agenda fetched successfully');
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

        $agenda = $this->agendaService->store($validated);

        return $this->successResponse($agenda, 'Agenda berhasil ditambahkan', 201);
    }

    public function show($id)
    {
        $agenda = AgendaKegiatan::with(['jenisAgenda', 'creator'])->findOrFail($id);
        return $this->successResponse($agenda, 'Detail Agenda fetched successfully');
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

        $agenda = $this->agendaService->update($id, $validated);

        return $this->successResponse($agenda, 'Agenda berhasil diperbarui');
    }

    public function destroy($id)
    {
        $agenda = AgendaKegiatan::findOrFail($id);
        Gate::authorize('delete', $agenda);

        $this->agendaService->delete($id);
        return $this->successResponse(null, 'Agenda berhasil dihapus');
    }

    public function approve($id)
    {
        $this->agendaService->approve($id);
        return $this->successResponse(null, 'Agenda disetujui');
    }

    public function reject($id)
    {
        $this->agendaService->reject($id);
        return $this->successResponse(null, 'Agenda ditolak');
    }
}
