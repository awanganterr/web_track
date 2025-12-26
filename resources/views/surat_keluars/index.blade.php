@extends('layouts.app')

@section('title', 'Surat Keluar')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h2 class="card-title" style="font-size: 1.5rem;">Daftar Surat Keluar</h2>
    @can('create', App\Models\SuratKeluar::class)
    <a href="{{ route('surat-keluar.create') }}" class="btn btn-primary">
        + Tambah Surat Keluar
    </a>
    @endcan
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No. Agenda</th>
                    <th>Tujuan Surat</th>
                    <th>Perihal</th>
                    <th>Tanggal Surat</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($suratKeluars as $surat)
                <tr>
                    <td>{{ $surat->nomor_agenda }}</td>
                    <td>
                        <div class="font-bold">{{ $surat->tujuan_surat }}</div>
                        <div class="text-sm text-muted">{{ $surat->nomor_surat }}</div>
                    </td>
                    <td>{{ Str::limit($surat->perihal, 50) }}</td>
                    <td>{{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d M Y') }}</td>
                    <td>
                        @if($surat->status == 'pending')
                            <span class="badge badge-warning">Pending</span>
                        @elseif($surat->status == 'approved')
                            <span class="badge badge-success">Approved</span>
                        @else
                            <span class="badge badge-danger">Rejected</span>
                        @endif
                    </td>
                    <td>
                        <div class="flex gap-2">
                            <a href="{{ route('surat-keluar.show', $surat->id) }}" class="btn btn-sm btn-secondary">Detail</a>
                            @can('update', $surat)
                            <a href="{{ route('surat-keluar.edit', $surat->id) }}" class="btn btn-sm btn-secondary" style="color: var(--primary-color);">Edit</a>
                            @endcan
                            @can('delete', $surat)
                            <form action="{{ route('surat-keluar.destroy', $surat->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                            @endcan
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada data surat keluar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
