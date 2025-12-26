@extends('layouts.app')

@section('title', 'Edit Surat Keluar')

@section('content')
<div class="card" style="max-width: 800px; margin: 0 auto;">
    <div class="card-header">
        <h2 class="card-title">Edit Surat Keluar: {{ $suratKeluar->nomor_surat }}</h2>
        <a href="{{ route('surat-keluar.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
    </div>
    <div class="card-body">
        <form action="{{ route('surat-keluar.update', $suratKeluar->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <!-- Kiri -->
                <div>
                    <div class="form-group">
                        <label class="form-label">Nomor Agenda</label>
                        <input type="text" name="nomor_agenda" class="form-control" value="{{ old('nomor_agenda', $suratKeluar->nomor_agenda) }}">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Nomor Surat <span style="color: red;">*</span></label>
                        <input type="text" name="nomor_surat" class="form-control" value="{{ old('nomor_surat', $suratKeluar->nomor_surat) }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tujuan Surat <span style="color: red;">*</span></label>
                        <input type="text" name="tujuan_surat" class="form-control" value="{{ old('tujuan_surat', $suratKeluar->tujuan_surat) }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Kategori <span style="color: red;">*</span></label>
                        <select name="kategori_id" class="form-control" required>
                            @foreach(\App\Models\KategoriSurat::all() as $kategori)
                                <option value="{{ $kategori->id }}" {{ $suratKeluar->kategori_id == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Kanan -->
                <div>
                    <div class="form-group">
                        <label class="form-label">Tanggal Surat <span style="color: red;">*</span></label>
                        <input type="date" name="tanggal_surat" class="form-control" value="{{ old('tanggal_surat', $suratKeluar->tanggal_surat) }}" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Perihal <span style="color: red;">*</span></label>
                <input type="text" name="perihal" class="form-control" value="{{ old('perihal', $suratKeluar->perihal) }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Isi Ringkas</label>
                <textarea name="isi_ringkas" class="form-control" rows="3">{{ old('isi_ringkas', $suratKeluar->isi_ringkas) }}</textarea>
            </div>

            <div class="text-right mt-4">
                <button type="submit" class="btn btn-primary">Update Data</button>
            </div>
        </form>
    </div>
</div>
@endsection
