@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
@section('content')
<div class="mt-4 mb-4">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Selamat Datang, {{ Auth::user()->name }}</h3>
        </div>
        <div class="card-body">
            <p>Anda login sebagai <span class="badge badge-info">{{ Auth::user()->role }}</span>.</p>
        </div>
    </div>
</div>

@if(Auth::user()->role === 'admin')
    <div class="grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem;">
        <!-- Card Surat Masuk -->
        <div class="card">
            <div class="card-body">
                <h3 class="text-muted text-sm" style="margin-top: 0;">Surat Masuk</h3>
                <p class="font-bold" style="font-size: 2rem; margin: 0.5rem 0;">{{ \App\Models\SuratMasuk::count() }}</p>
                <a href="{{ route('surat-masuk.index') }}" style="color: var(--primary-color); text-decoration: none; font-size: 0.875rem;">Kelola Data &rarr;</a>
            </div>
        </div>

        <!-- Card Surat Keluar -->
        <div class="card">
            <div class="card-body">
                <h3 class="text-muted text-sm" style="margin-top: 0;">Surat Keluar</h3>
                <p class="font-bold" style="font-size: 2rem; margin: 0.5rem 0;">{{ \App\Models\SuratKeluar::count() }}</p>
                <a href="{{ route('surat-keluar.index') }}" style="color: var(--primary-color); text-decoration: none; font-size: 0.875rem;">Kelola Data &rarr;</a>
            </div>
        </div>

        <!-- Card Agenda -->
        <div class="card">
            <div class="card-body">
                <h3 class="text-muted text-sm" style="margin-top: 0;">Agenda Kegiatan</h3>
                <p class="font-bold" style="font-size: 2rem; margin: 0.5rem 0;">{{ \App\Models\AgendaKegiatan::count() }}</p>
                <a href="{{ route('agenda.index') }}" style="color: var(--primary-color); text-decoration: none; font-size: 0.875rem;">Kelola Data &rarr;</a>
            </div>
        </div>
    </div>
@else
    <!-- User Dashboard View -->
    <div class="grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Agenda Hari Ini</h3>
            </div>
            <div class="card-body">
                @php
                    $todayAgendas = \App\Models\AgendaKegiatan::whereDate('waktu_mulai', \Carbon\Carbon::today())->get();
                @endphp
                
                @if($todayAgendas->count() > 0)
                    <ul style="padding-left: 1rem;">
                        @foreach($todayAgendas as $agenda)
                            <li>
                                <strong>{{ $agenda->nama_kegiatan }}</strong> 
                                <span class="text-muted text-sm">({{ \Carbon\Carbon::parse($agenda->waktu_mulai)->format('H:i') }})</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">Tidak ada agenda hari ini.</p>
                @endif
                <a href="{{ route('agenda.index') }}" class="btn btn-sm btn-secondary mt-4">Lihat Semua Agenda</a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Surat Terbaru</h3>
            </div>
            <div class="card-body">
                @php
                    $latestSurat = \App\Models\SuratMasuk::latest()->take(3)->get();
                @endphp
                
                @if($latestSurat->count() > 0)
                    <ul style="padding-left: 1rem;">
                        @foreach($latestSurat as $surat)
                            <li>
                                {{ Str::limit($surat->perihal, 30) }}
                                <span class="text-muted text-sm">({{ \Carbon\Carbon::parse($surat->tanggal_diterima)->format('d M') }})</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">Belum ada surat masuk.</p>
                @endif
                <a href="{{ route('surat-masuk.index') }}" class="btn btn-sm btn-secondary mt-4">Lihat Semua Surat</a>
            </div>
        </div>
    </div>
@endif
@endsection
