<?php

namespace App\Services;

use App\Models\AgendaKegiatan;

class AgendaKegiatanService
{
    public function getAll()
    {
        return AgendaKegiatan::with(['jenisAgenda', 'suratMasuk', 'suratKeluar', 'creator'])->latest()->get();
    }

    public function store(array $data)
    {
        return AgendaKegiatan::create($data);
    }

    public function update($id, array $data)
    {
        $agenda = AgendaKegiatan::findOrFail($id);
        $agenda->update($data);
        return $agenda;
    }

    public function delete($id)
    {
        $data = AgendaKegiatan::findOrFail($id);
        return $data->delete();
    }

    public function approve($id)
    {
        $data = AgendaKegiatan::findOrFail($id);
        $data->update(['status' => 'approved']);
        return $data;
    }

    public function reject($id)
    {
        $data = AgendaKegiatan::findOrFail($id);
        $data->update(['status' => 'rejected']);
        return $data;
    }
}
