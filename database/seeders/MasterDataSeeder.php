<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriSurat;
use App\Models\JenisAgenda;

class MasterDataSeeder extends Seeder
{
    public function run()
    {
        // Kategori Surat
        $kategori = ['Dinas', 'Undangan', 'Pemberitahuan', 'Edaran', 'Keputusan'];
        foreach ($kategori as $kat) {
            KategoriSurat::create([
                'nama_kategori' => $kat,
                'deskripsi' => 'Kategori untuk ' . $kat
            ]);
        }

        // Jenis Agenda
        $jenis = ['Rapat', 'Perjalanan Dinas', 'Upacara', 'Sosialisasi', 'Pelatihan'];
        foreach ($jenis as $j) {
            JenisAgenda::create([
                'nama_jenis' => $j,
                'deskripsi' => 'Agenda kegiatan ' . $j
            ]);
        }
    }
}
