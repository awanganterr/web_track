<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="logo-text">WebTrack</div>
        <div class="logo-sub">Management System</div>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-label">Main</div>
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
            </svg>
            <span>Dashboard</span>
        </a>

        <div class="nav-label">Administrasi</div>
        
        <a href="{{ route('surat-masuk.index') }}" class="nav-link {{ request()->routeIs('surat-masuk.*') ? 'active' : '' }}">
            <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
            </svg>
            <span>Surat Masuk</span>
            @if(isset($pendingSuratMasuk) && $pendingSuratMasuk > 0)
                <span class="sidebar-badge">{{ $pendingSuratMasuk }}</span>
            @endif
        </a>

        <a href="{{ route('surat-keluar.index') }}" class="nav-link {{ request()->routeIs('surat-keluar.*') ? 'active' : '' }}">
            <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
               <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
            </svg>
            <span>Surat Keluar</span>
            @if(isset($pendingSuratKeluar) && $pendingSuratKeluar > 0)
                <span class="sidebar-badge">{{ $pendingSuratKeluar }}</span>
            @endif
        </a>

        <a href="{{ route('agenda.index') }}" class="nav-link {{ request()->routeIs('agenda.*') ? 'active' : '' }}">
            <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
            </svg>
            <span>Agenda Kegiatan</span>
            @if(isset($pendingAgenda) && $pendingAgenda > 0)
                <span class="sidebar-badge">{{ $pendingAgenda }}</span>
            @endif
        </a>
    </nav>
</aside>
