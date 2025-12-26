@extends('layouts.app')

@section('title', 'Detail Surat Keluar')

@section('content')
<div class="card" style="max-width: 800px; margin: 0 auto;">
    <div class="card-header">
        <h2 class="card-title">Detail Surat Keluar</h2>
        <div class="flex gap-2">
            <a href="{{ route('surat-keluar.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
            @if(Auth::user()->role === 'admin')
            <a href="{{ route('surat-keluar.edit', $suratKeluar->id) }}" class="btn btn-sm btn-primary">Edit</a>
            @endif
        </div>
    </div>
    <div class="card-body">
        <table class="table">
            <tr>
                <td style="width: 200px; font-weight: 600;">Nomor Agenda</td>
                <td>{{ $suratKeluar->nomor_agenda ?? '-' }}</td>
            </tr>
            <tr>
                <td style="font-weight: 600;">Nomor Surat</td>
                <td>{{ $suratKeluar->nomor_surat }}</td>
            </tr>
            <tr>
                <td style="font-weight: 600;">Tujuan Surat</td>
                <td>{{ $suratKeluar->tujuan_surat }}</td>
            </tr>
            <tr>
                <td style="font-weight: 600;">Perihal</td>
                <td>{{ $suratKeluar->perihal }}</td>
            </tr>
            <tr>
                <td style="font-weight: 600;">Tanggal Surat</td>
                <td>{{ \Carbon\Carbon::parse($suratKeluar->tanggal_surat)->format('d F Y') }}</td>
            </tr>
            <tr>
                <td style="font-weight: 600;">Kategori</td>
                <td><span class="badge badge-info">{{ $suratKeluar->kategori->nama_kategori }}</span></td>
            </tr>
            <tr>
                <td style="font-weight: 600;">Status</td>
                <td>
                    @if($suratKeluar->status == 'pending')
                        <span class="badge badge-warning">Menunggu Persetujuan</span>
                    @elseif($suratKeluar->status == 'approved')
                        <span class="badge badge-success">Disetujui</span>
                    @else
                        <span class="badge badge-danger">Ditolak</span>
                    @endif
                </td>
            </tr>
            <tr>
                <td style="font-weight: 600;">Isi Ringkas</td>
                <td>{{ $suratKeluar->isi_ringkas ?? '-' }}</td>
            </tr>
            <tr>
                <td style="font-weight: 600;">Dibuat Oleh</td>
                <td>{{ $suratKeluar->creator->name }}</td>
            </tr>
        </table>

        @if(Auth::user()->role === 'admin' && $suratKeluar->status === 'pending')
        <div class="mt-4 pt-4 border-t flex gap-2">
            <form action="{{ route('surat-keluar.approve', $suratKeluar->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success" onclick="return confirm('Setujui surat ini?')">✓ Setujui</button>
            </form>
            <form action="{{ route('surat-keluar.reject', $suratKeluar->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger" onclick="return confirm('Tolak surat ini?')">✕ Tolak</button>
            </form>
        </div>
        @endif
    </div>
</div>
@endsection
