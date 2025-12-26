<nav class="top-navbar">
    <div style="display: flex; align-items: center;">
        <button id="sidebar-toggle" style="background: none; border: none; font-size: 1.5rem; cursor: pointer; display: none;">
            ☰
        </button>
        <span style="font-weight: 600; margin-left: 10px;">@yield('title', 'Dashboard')</span>
    </div>
    <div style="display: flex; align-items: center; gap: 1rem;">
        <span style="font-size: 0.875rem;">{{ Auth::user()->name ?? 'Guest' }}</span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-sm btn-secondary">Logout</button>
        </form>
    </div>
</nav>

<script>
    // Simple script to handle Sidebar on mobile (if we add toggle functionality later)
</script>
