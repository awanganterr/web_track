<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\KategoriSurat;
use App\Models\JenisAgenda;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\AgendaKegiatan;
use Carbon\Carbon;

class SampleDataSeeder extends Seeder
{
    public function run()
    {
        $admin = User::where('role', 'admin')->first();
        $kategori = KategoriSurat::first();
        $jenis = JenisAgenda::first();

        // 5 Surat Masuk
        for ($i = 1; $i <= 5; $i++) {
            SuratMasuk::create([
                'nomor_agenda' => 'SM/2025/' . sprintf('%03d', $i),
                'nomor_surat_asal' => 'EXT-' . rand(100, 999),
                'tanggal_surat' => Carbon::now()->subDays(rand(1, 10)),
                'tanggal_diterima' => Carbon::now(),
                'asal_surat' => 'Instansi Luar ' . $i,
                'perihal' => 'Perihal Surat Masuk ' . $i,
                'isi_ringkas' => 'Isi ringkas surat masuk nomor ' . $i,
                'status_disposisi' => 'pending',
                'kategori_id' => $kategori->id,
                'created_by' => $admin->id,
            ]);
        }

        // 5 Surat Keluar
        for ($i = 1; $i <= 5; $i++) {
            SuratKeluar::create([
                'nomor_agenda' => 'SK/2025/' . sprintf('%03d', $i),
                'nomor_surat' => 'INT-' . rand(100, 999),
                'tanggal_surat' => Carbon::now(),
                'tujuan_surat' => 'Instansi Tujuan ' . $i,
                'perihal' => 'Perihal Surat Keluar ' . $i,
                'isi_ringkas' => 'Isi ringkas surat keluar nomor ' . $i,
                'status' => 'sent',
                'kategori_id' => $kategori->id,
                'created_by' => $admin->id,
            ]);
        }

        // 5 Agenda
        for ($i = 1; $i <= 5; $i++) {
             AgendaKegiatan::create([
                'nama_kegiatan' => 'Kegiatan Rutin ' . $i,
                'waktu_mulai' => Carbon::now()->addDays($i)->setHour(9)->setMinute(0),
                'waktu_selesai' => Carbon::now()->addDays($i)->setHour(12)->setMinute(0),
                'tempat' => 'Ruang Rapat ' . $i,
                'keterangan' => 'Keterangan kegiatan ' . $i,
                'status' => 'scheduled',
                'jenis_agenda_id' => $jenis->id,
                'created_by' => $admin->id,
            ]);
        }
    }
}
