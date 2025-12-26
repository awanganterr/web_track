@extends('layouts.app')

@section('title', 'Agenda Kegiatan')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h2 class="card-title" style="font-size: 1.5rem;">Daftar Agenda Kegiatan</h2>
    @can('create', App\Models\AgendaKegiatan::class)
    <a href="{{ route('agenda.create') }}" class="btn btn-primary">
        + Tambah Agenda
    </a>
    @endcan
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Kegiatan</th>
                    <th>Waktu</th>
                    <th>Tempat</th>
                    <th>Jenis</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($agendas as $agenda)
                <tr>
                    <td>
                        <div class="font-bold">{{ $agenda->nama_kegiatan }}</div>
                        <div class="text-sm text-muted">{{ Str::limit($agenda->keterangan, 30) }}</div>
                    </td>
                    <td>
                        <div>{{ \Carbon\Carbon::parse($agenda->waktu_mulai)->format('d M Y H:i') }}</div>
                        <div class="text-sm text-muted">s/d {{ $agenda->waktu_selesai ? \Carbon\Carbon::parse($agenda->waktu_selesai)->format('H:i') : 'Selesai' }}</div>
                    </td>
                    <td>{{ $agenda->tempat ?? '-' }}</td>
                    <td><span class="badge badge-info">{{ $agenda->jenisAgenda->nama_jenis }}</span></td>
                    <td>
                        @if($agenda->status == 'pending')
                            <span class="badge badge-warning">Pending</span>
                        @elseif($agenda->status == 'approved')
                            <span class="badge badge-success">Approved</span>
                        @else
                            <span class="badge badge-danger">Rejected</span>
                        @endif
                    </td>
                    <td>
                        <div class="flex gap-2">
                            <a href="{{ route('agenda.show', $agenda->id) }}" class="btn btn-sm btn-secondary">Detail</a>
                            @can('update', $agenda)
                            <a href="{{ route('agenda.edit', $agenda->id) }}" class="btn btn-sm btn-secondary" style="color: var(--primary-color);">Edit</a>
                            @endcan
                            @can('delete', $agenda)
                            <form action="{{ route('agenda.destroy', $agenda->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?')">
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
                    <td colspan="6" class="text-center text-muted">Belum ada agenda kegiatan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
