@extends('layouts.app')

@section('title', 'Detail Surat Masuk')

@section('content')
<div class="card" style="max-width: 800px; margin: 0 auto;">
    <div class="card-header">
        <h2 class="card-title">Detail Surat Masuk</h2>
        <div class="flex gap-2">
            <a href="{{ route('surat-masuk.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
            @if(Auth::user()->role === 'admin')
            <a href="{{ route('surat-masuk.edit', $suratMasuk->id) }}" class="btn btn-sm btn-primary">Edit</a>
            @endif
        </div>
    </div>
    <div class="card-body">
        <table class="table">
            <tr>
                <td style="width: 200px; font-weight: 600;">Nomor Agenda</td>
                <td>{{ $suratMasuk->nomor_agenda ?? '-' }}</td>
            </tr>
            <tr>
                <td style="font-weight: 600;">Nomor Surat Asal</td>
                <td>{{ $suratMasuk->nomor_surat_asal }}</td>
            </tr>
            <tr>
                <td style="font-weight: 600;">Asal Surat</td>
                <td>{{ $suratMasuk->asal_surat }}</td>
            </tr>
            <tr>
                <td style="font-weight: 600;">Perihal</td>
                <td>{{ $suratMasuk->perihal }}</td>
            </tr>
            <tr>
                <td style="font-weight: 600;">Tanggal Surat</td>
                <td>{{ \Carbon\Carbon::parse($suratMasuk->tanggal_surat)->format('d F Y') }}</td>
            </tr>
            <tr>
                <td style="font-weight: 600;">Tanggal Diterima</td>
                <td>{{ \Carbon\Carbon::parse($suratMasuk->tanggal_diterima)->format('d F Y') }}</td>
            </tr>
            <tr>
                <td style="font-weight: 600;">Kategori</td>
                <td><span class="badge badge-info">{{ $suratMasuk->kategori->nama_kategori }}</span></td>
            </tr>
            <tr>
                <td style="font-weight: 600;">Status</td>
                <td>
                    @if($suratMasuk->status == 'pending')
                        <span class="badge badge-warning">Menunggu Persetujuan</span>
                    @elseif($suratMasuk->status == 'approved')
                        <span class="badge badge-success">Disetujui</span>
                    @else
                        <span class="badge badge-danger">Ditolak</span>
                    @endif
                </td>
            </tr>
            <tr>
                <td style="font-weight: 600;">Status Disposisi</td>
                <td><span class="badge badge-info">{{ $suratMasuk->status_disposisi }}</span></td>
            </tr>
            <tr>
                <td style="font-weight: 600;">Isi Ringkas</td>
                <td>{{ $suratMasuk->isi_ringkas ?? '-' }}</td>
            </tr>
            <tr>
                <td style="font-weight: 600;">Dibuat Oleh</td>
                <td>{{ $suratMasuk->creator->name }}</td>
            </tr>
        </table>

        @if(Auth::user()->role === 'admin' && $suratMasuk->status === 'pending')
        <div class="mt-4 pt-4 border-t flex gap-2">
            <form action="{{ route('surat-masuk.approve', $suratMasuk->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success" onclick="return confirm('Setujui surat ini?')">✓ Setujui</button>
            </form>
            <form action="{{ route('surat-masuk.reject', $suratMasuk->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger" onclick="return confirm('Tolak surat ini?')">✕ Tolak</button>
            </form>
        </div>
        @endif
    </div>
</div>
@endsection
