@extends('layouts.app')

@section('title', 'Edit Agenda')

@section('content')
<div class="card" style="max-width: 800px; margin: 0 auto;">
    <div class="card-header">
        <h2 class="card-title">Edit Agenda: {{ $agenda->nama_kegiatan }}</h2>
        <a href="{{ route('agenda.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
    </div>
    <div class="card-body">
        <form action="{{ route('agenda.update', $agenda->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label class="form-label">Nama Kegiatan <span style="color: red;">*</span></label>
                <input type="text" name="nama_kegiatan" class="form-control" value="{{ old('nama_kegiatan', $agenda->nama_kegiatan) }}" required>
            </div>
            
            <div class="grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div>
                    <div class="form-group">
                        <label class="form-label">Jenis Agenda <span style="color: red;">*</span></label>
                        <select name="jenis_agenda_id" class="form-control" required>
                            @foreach(\App\Models\JenisAgenda::all() as $jenis)
                                <option value="{{ $jenis->id }}" {{ $agenda->jenis_agenda_id == $jenis->id ? 'selected' : '' }}>{{ $jenis->nama_jenis }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tempat</label>
                        <input type="text" name="tempat" class="form-control" value="{{ old('tempat', $agenda->tempat) }}">
                    </div>
                </div>

                <div>
                    <div class="form-group">
                        <label class="form-label">Waktu Mulai <span style="color: red;">*</span></label>
                        <input type="datetime-local" name="waktu_mulai" class="form-control" value="{{ old('waktu_mulai', \Carbon\Carbon::parse($agenda->waktu_mulai)->format('Y-m-d\TH:i')) }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Waktu Selesai</label>
                        <input type="datetime-local" name="waktu_selesai" class="form-control" value="{{ old('waktu_selesai', $agenda->waktu_selesai ? \Carbon\Carbon::parse($agenda->waktu_selesai)->format('Y-m-d\TH:i') : '') }}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="3">{{ old('keterangan', $agenda->keterangan) }}</textarea>
            </div>

            <div class="text-right mt-4">
                <button type="submit" class="btn btn-primary">Update Agenda</button>
            </div>
        </form>
    </div>
</div>
@endsection
