<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_agenda',
        'nomor_surat',
        'tanggal_surat',
        'tujuan_surat',
        'perihal',
        'isi_ringkas',
        'lampiran_file',
        'isi_ringkas',
        'status',
        'kategori_id',
        'created_by',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriSurat::class, 'kategori_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
