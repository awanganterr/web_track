<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgendaKegiatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kegiatan',
        'waktu_mulai',
        'waktu_selesai',
        'tempat',
        'keterangan',
        'keterangan',
        'status',
        'jenis_agenda_id',
        'surat_masuk_id',
        'surat_keluar_id',
        'created_by',
    ];

    public function jenisAgenda()
    {
        return $this->belongsTo(JenisAgenda::class, 'jenis_agenda_id');
    }

    public function suratMasuk()
    {
        return $this->belongsTo(SuratMasuk::class, 'surat_masuk_id');
    }

    public function suratKeluar()
    {
        return $this->belongsTo(SuratKeluar::class, 'surat_keluar_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
