<?php

namespace App\Services;

use App\Models\SuratMasuk;

class SuratMasukService
{
    public function getAll()
    {
        return SuratMasuk::with(['kategori', 'creator'])->latest()->get();
    }

    public function store(array $data)
    {
        return SuratMasuk::create($data);
    }

    public function update($id, array $data)
    {
        $suratMasuk = SuratMasuk::findOrFail($id);
        $suratMasuk->update($data);
        return $suratMasuk;
    }

    public function delete($id)
    {
        $data = SuratMasuk::findOrFail($id);
        return $data->delete();
    }

    public function approve($id)
    {
        $data = SuratMasuk::findOrFail($id);
        $data->update(['status' => 'approved']);
        return $data;
    }

    public function reject($id)
    {
        $data = SuratMasuk::findOrFail($id);
        $data->update(['status' => 'rejected']);
        return $data;
    }
}
