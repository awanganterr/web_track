@extends('layouts.app')

@section('title', 'Tambah Surat Masuk')

@section('content')
<div class="card" style="max-width: 800px; margin: 0 auto;">
    <div class="card-header">
        <h2 class="card-title">Form Tambah Surat Masuk</h2>
        <a href="{{ route('surat-masuk.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
    </div>
    <div class="card-body">
        <form action="{{ route('surat-masuk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <!-- Kiri -->
                <div>
                    <div class="form-group">
                        <label class="form-label">Nomor Agenda (Opsional)</label>
                        <input type="text" name="nomor_agenda" class="form-control" value="{{ old('nomor_agenda') }}" placeholder="Contoh: SM/2025/001">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Nomor Surat Asal <span style="color: red;">*</span></label>
                        <input type="text" name="nomor_surat_asal" class="form-control" value="{{ old('nomor_surat_asal') }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Asal Surat <span style="color: red;">*</span></label>
                        <input type="text" name="asal_surat" class="form-control" value="{{ old('asal_surat') }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Kategori <span style="color: red;">*</span></label>
                        <select name="kategori_id" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach(\App\Models\KategoriSurat::all() as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Kanan -->
                <div>
                    <div class="form-group">
                        <label class="form-label">Tanggal Surat <span style="color: red;">*</span></label>
                        <input type="date" name="tanggal_surat" class="form-control" value="{{ old('tanggal_surat') }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tanggal Diterima <span style="color: red;">*</span></label>
                        <input type="date" name="tanggal_diterima" class="form-control" value="{{ old('tanggal_diterima', date('Y-m-d')) }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Lampiran File (PDF/Docs)</label>
                        <input type="file" name="lampiran_file" class="form-control">
                        <small class="text-muted">Maks: 2MB</small>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Perihal <span style="color: red;">*</span></label>
                <input type="text" name="perihal" class="form-control" value="{{ old('perihal') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Isi Ringkas</label>
                <textarea name="isi_ringkas" class="form-control" rows="3">{{ old('isi_ringkas') }}</textarea>
            </div>

            <div class="text-right mt-4">
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
        </form>
    </div>
</div>
@endsection
