@extends('layouts.app')

@section('title', 'Detail Agenda')

@section('content')
<div class="card" style="max-width: 800px; margin: 0 auto;">
    <div class="card-header">
        <h2 class="card-title">Detail Agenda</h2>
        <div class="flex gap-2">
            <a href="{{ route('agenda.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
            @if(Auth::user()->role === 'admin')
            <a href="{{ route('agenda.edit', $agenda->id) }}" class="btn btn-sm btn-primary">Edit</a>
            @endif
        </div>
    </div>
    <div class="card-body">
        <table class="table">
            <tr>
                <td style="width: 200px; font-weight: 600;">Nama Kegiatan</td>
                <td>{{ $agenda->nama_kegiatan }}</td>
            </tr>
            <tr>
                <td style="font-weight: 600;">Jenis Agenda</td>
                <td><span class="badge badge-info">{{ $agenda->jenisAgenda->nama_jenis }}</span></td>
            </tr>
            <tr>
                <td style="font-weight: 600;">Waktu Mulai</td>
                <td>{{ \Carbon\Carbon::parse($agenda->waktu_mulai)->format('d F Y, H:i') }} WIB</td>
            </tr>
            <tr>
                <td style="font-weight: 600;">Waktu Selesai</td>
                <td>{{ $agenda->waktu_selesai ? \Carbon\Carbon::parse($agenda->waktu_selesai)->format('d F Y, H:i') . ' WIB' : '-' }}</td>
            </tr>
            <tr>
                <td style="font-weight: 600;">Tempat</td>
                <td>{{ $agenda->tempat ?? '-' }}</td>
            </tr>
            <tr>
                <td style="font-weight: 600;">Status</td>
                <td>
                    @if($agenda->status == 'pending')
                        <span class="badge badge-warning">Menunggu Persetujuan</span>
                    @elseif($agenda->status == 'approved')
                        <span class="badge badge-success">Disetujui</span>
                    @else
                        <span class="badge badge-danger">Ditolak</span>
                    @endif
                </td>
            </tr>
            <tr>
                <td style="font-weight: 600;">Keterangan</td>
                <td>{{ $agenda->keterangan ?? '-' }}</td>
            </tr>
            <tr>
                <td style="font-weight: 600;">Dibuat Oleh</td>
                <td>{{ $agenda->creator->name }}</td>
            </tr>
        </table>

        @if(Auth::user()->role === 'admin' && $agenda->status === 'pending')
        <div class="mt-4 pt-4 border-t flex gap-2">
            <form action="{{ route('agenda.approve', $agenda->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success" onclick="return confirm('Setujui agenda ini?')">✓ Setujui</button>
            </form>
            <form action="{{ route('agenda.reject', $agenda->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger" onclick="return confirm('Tolak agenda ini?')">✕ Tolak</button>
            </form>
        </div>
        @endif
    </div>
</div>
@endsection
