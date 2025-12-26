<?php

namespace App\Services;

use App\Models\SuratKeluar;

class SuratKeluarService
{
    public function getAll()
    {
        return SuratKeluar::with(['kategori', 'creator'])->latest()->get();
    }

    public function store(array $data)
    {
        return SuratKeluar::create($data);
    }

    public function update($id, array $data)
    {
        $suratKeluar = SuratKeluar::findOrFail($id);
        $suratKeluar->update($data);
        return $suratKeluar;
    }

    public function delete($id)
    {
        $data = SuratKeluar::findOrFail($id);
        return $data->delete();
    }

    public function approve($id)
    {
        $data = SuratKeluar::findOrFail($id);
        $data->update(['status' => 'approved']);
        return $data;
    }

    public function reject($id)
    {
        $data = SuratKeluar::findOrFail($id);
        $data->update(['status' => 'rejected']);
        return $data;
    }
}
