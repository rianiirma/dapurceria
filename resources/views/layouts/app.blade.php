<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DapurCeria')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* ── RESET & BASE ── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif;
            background: #FDF6EC;
            color: #3D2010;
            line-height: 1.6;
            overflow-x: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            width: 100%;
        }

        /* ── NAVBAR ── */
        .navbar {
            background: #3D2010;
            padding: 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(255,255,255,.07);
        }

        .navbar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 60px;
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            font-weight: 700;
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .navbar-brand-dot {
            width: 8px;
            height: 8px;
            background: #F9946A;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .navbar-menu {
            display: flex;
            align-items: center;
            gap: 6px;
            list-style: none;
        }

        .navbar-menu a {
            color: rgba(255,255,255,.7);
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            padding: 6px 10px;
            border-radius: 8px;
            transition: color .2s, background .2s;
        }

        .navbar-menu a:hover {
            color: #fff;
            background: rgba(255,255,255,.08);
        }

        .btn-nav-outline {
            padding: 6px 16px;
            border: 1.5px solid rgba(255,255,255,.4);
            border-radius: 20px;
            color: rgba(255,255,255,.85) !important;
            font-size: 12px !important;
            font-weight: 600 !important;
            background: none;
            cursor: pointer;
            font-family: inherit;
            transition: all .2s;
        }

        .btn-nav-outline:hover {
            border-color: #fff;
            color: #fff !important;
            background: rgba(255,255,255,.1) !important;
        }

        .btn-nav-fill {
            padding: 6px 16px;
            border: 1.5px solid #E8621A;
            border-radius: 20px;
            background: #E8621A;
            color: #fff !important;
            font-size: 12px !important;
            font-weight: 600 !important;
            text-decoration: none;
            cursor: pointer;
            font-family: inherit;
            transition: background .2s;
        }

        .btn-nav-fill:hover {
            background: #C84E0E !important;
            border-color: #C84E0E;
        }

        /* Nav User Link (Desktop) */
        .nav-user-link {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            padding: 4px 8px;
            border-radius: 10px;
            transition: background .2s;
        }

        .nav-user-link:hover {
            background: rgba(255,255,255,.08);
        }

        .nav-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #E8621A;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            border: 2px solid rgba(255,255,255,.25);
            flex-shrink: 0;
            overflow: hidden; /* Biar foto tidak keluar lingkaran */
        }

        .nav-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .nav-user-name {
            font-size: 13px;
            font-weight: 600;
            color: rgba(255,255,255,.85);
        }

        .nav-admin-badge {
            background: #E8621A;
            color: #fff;
            font-size: 9px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 8px;
            letter-spacing: .5px;
        }

        .logout-form { display: inline; }

        /* ── HAMBURGER BUTTON ── */
        .navbar-hamburger {
            display: none;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 5px;
            width: 36px;
            height: 36px;
            cursor: pointer;
            background: none;
            border: none;
            padding: 4px;
        }

        .navbar-hamburger span {
            display: block;
            width: 22px;
            height: 2px;
            background: rgba(255,255,255,.85);
            border-radius: 2px;
            transition: all .3s;
        }

        /* ── MOBILE SIDEBAR OVERLAY ── */
        .mobile-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.45);
            z-index: 1100;
        }

        .mobile-overlay.open { display: block; }

        /* ── MOBILE SIDEBAR ── */
        .mobile-sidebar {
            position: fixed;
            top: 0;
            right: -100%;
            width: 78%;
            max-width: 300px;
            height: 100%;
            background: #3D2010;
            z-index: 1200;
            transition: right .3s ease;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .mobile-sidebar.open { right: 0; }

        .mobile-sidebar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 18px 12px;
            border-bottom: 1px solid rgba(255,255,255,.08);
        }

        .mobile-sidebar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 18px;
            font-weight: 700;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 7px;
            text-decoration: none;
        }

        .mobile-sidebar-close {
            background: rgba(255,255,255,.12);
            border: none;
            color: #fff;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
        }

        .mobile-sidebar-user {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 18px 18px 14px;
            border-bottom: 1px solid rgba(255,255,255,.08);
            text-decoration: none;
            transition: background .2s;
        }

        .mobile-sidebar-user:hover {
            background: rgba(255,255,255,.03);
        }

        .mobile-sidebar-avatar {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: #E8621A;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            font-weight: 700;
            border: 2px solid rgba(255,255,255,.25);
            flex-shrink: 0;
            overflow: hidden;
        }

        .mobile-sidebar-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .mobile-sidebar-user-info { display: flex; flex-direction: column; gap: 2px; }
        .mobile-sidebar-user-name { font-size: 15px; font-weight: 700; color: #fff; }
        .mobile-sidebar-user-email { font-size: 11px; color: rgba(255,255,255,.5); }

        .mobile-sidebar-nav { list-style: none; padding: 10px 0; flex: 1; }

        .mobile-sidebar-nav li a,
        .mobile-sidebar-nav li button {
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            padding: 13px 18px;
            color: rgba(255,255,255,.75);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            background: none;
            border: none;
            font-family: inherit;
            cursor: pointer;
            text-align: left;
            transition: background .2s, color .2s;
            border-left: 3px solid transparent;
        }

        .mobile-sidebar-nav li a:hover,
        .mobile-sidebar-nav li button:hover {
            background: rgba(255,255,255,.06);
            color: #fff;
        }

        .mobile-sidebar-nav li.active-sidebar a {
            background: rgba(232,98,26,.15);
            color: #F9946A;
            border-left-color: #E8621A;
            font-weight: 600;
        }

        .mobile-sidebar-nav li.logout-item {
            border-top: 1px solid rgba(255,255,255,.08);
            margin-top: 10px;
            padding-top: 5px;
        }

        .mobile-sidebar-nav li.logout-item button {
            color: #F9946A;
        }

        .mobile-sidebar-nav .sidebar-icon { font-size: 18px; width: 22px; text-align: center; }

        /* ── RESPONSIVE ── */
        @media (max-width: 680px) {
            .navbar-menu .nav-hide-sm { display: none; }
            .navbar-menu .nav-user-item { display: none; } 
            .navbar-brand { font-size: 17px; }
            .navbar-hamburger { display: flex; }
        }
    </style>
    @stack('styles')
</head>
<body>

    {{-- ── NAVBAR ── --}}
    <nav class="navbar">
        <div class="container">
            <a href="{{ route('home') }}" class="navbar-brand">
                <div class="navbar-brand-dot"></div>
                DapurCeria
            </a>

            <ul class="navbar-menu">
                <li class="nav-hide-sm"><a href="{{ route('home') }}">Beranda</a></li>

                @auth
                    @if(auth()->user()->role === 'admin')
                        <li class="nav-hide-sm"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><span class="nav-admin-badge">ADMIN</span></li>
                    @else
                        <li class="nav-hide-sm"><a href="{{ route('user.resep.create') }}">Upload Resep</a></li>
                        <li class="nav-hide-sm"><a href="{{ route('user.resep.my') }}">Resep Saya</a></li>
                        <li class="nav-hide-sm"><a href="{{ route('favorit.index') }}">Favorit</a></li>
                    @endif

                    {{-- Link User Profile Laptop --}}
                    <li class="nav-user-item">
                        <a href="{{ route('profile.edit') }}" class="nav-user-link">
                            <div class="nav-avatar">
                                @if(auth()->user()->foto)
                                    <img src="{{ asset('storage/' . auth()->user()->foto) }}" alt="Profile">
                                @else
                                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                                @endif
                            </div>
                            <span class="nav-user-name nav-hide-sm">
                                {{ auth()->user()->name }}
                            </span>
                        </a>
                    </li>
                    <li class="nav-hide-sm">
                        <form action="{{ route('logout') }}" method="POST" class="logout-form">
                            @csrf
                            <button type="submit" class="btn-nav-outline">Keluar</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}" class="btn-nav-outline">Masuk</a></li>
                    <li><a href="{{ route('register') }}" class="btn-nav-fill">Daftar</a></li>
                @endauth
            </ul>

            @auth
            <button class="navbar-hamburger" id="hamburgerBtn" aria-label="Buka menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
            @endauth
        </div>
    </nav>

    {{-- ── MOBILE SIDEBAR ── --}}
    @auth
    <div class="mobile-overlay" id="mobileOverlay"></div>
    <div class="mobile-sidebar" id="mobileSidebar">

        <div class="mobile-sidebar-header">
            <a href="{{ route('home') }}" class="mobile-sidebar-brand">
                <div class="navbar-brand-dot"></div>
                DapurCeria
            </a>
            <button class="mobile-sidebar-close" id="sidebarClose">&#x2715;</button>
        </div>

        <a href="{{ route('profile.edit') }}" class="mobile-sidebar-user">
            <div class="mobile-sidebar-avatar">
                @if(auth()->user()->foto)
                    <img src="{{ asset('storage/' . auth()->user()->foto) }}" alt="Profile">
                @else
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                @endif
            </div>
            <div class="mobile-sidebar-user-info">
                <span class="mobile-sidebar-user-name">{{ auth()->user()->name }}</span>
                <span class="mobile-sidebar-user-email">{{ auth()->user()->email }}</span>
            </div>
        </a>

        <ul class="mobile-sidebar-nav">
            <li class="{{ request()->routeIs('home') ? 'active-sidebar' : '' }}">
                <a href="{{ route('home') }}">
                    <span class="sidebar-icon">🏠</span> Beranda
                </a>
            </li>

            @if(auth()->user()->role === 'admin')
                <li class="{{ request()->routeIs('admin.dashboard') ? 'active-sidebar' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <span class="sidebar-icon">📊</span> Dashboard
                    </a>
                </li>
            @else
                <li class="{{ request()->routeIs('user.resep.create') ? 'active-sidebar' : '' }}">
                    <a href="{{ route('user.resep.create') }}">
                        <span class="sidebar-icon">📤</span> Upload Resep
                    </a>
                </li>
                <li class="{{ request()->routeIs('user.resep.my') ? 'active-sidebar' : '' }}">
                    <a href="{{ route('user.resep.my') }}">
                        <span class="sidebar-icon">📝</span> Resep Saya
                    </a>
                </li>
                <li class="{{ request()->routeIs('favorit.*') ? 'active-sidebar' : '' }}">
                    <a href="{{ route('favorit.index') }}">
                        <span class="sidebar-icon">❤️</span> Favorit
                    </a>
                </li>
            @endif

            <li class="logout-item">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">
                        <span class="sidebar-icon">🚪</span> Keluar
                    </button>
                </form>
            </li>
        </ul>
    </div>
    @endauth

    <div class="content">
        @yield('content')
    </div>

    <script>
        const hamburger  = document.getElementById('hamburgerBtn');
        const sidebar    = document.getElementById('mobileSidebar');
        const overlay    = document.getElementById('mobileOverlay');
        const closeBtn   = document.getElementById('sidebarClose');

        function openSidebar()  { sidebar.classList.add('open'); overlay.classList.add('open'); document.body.style.overflow = 'hidden'; }
        function closeSidebar() { sidebar.classList.remove('open'); overlay.classList.remove('open'); document.body.style.overflow = ''; }

        hamburger?.addEventListener('click', openSidebar);
        closeBtn?.addEventListener('click', closeSidebar);
        overlay?.addEventListener('click', closeSidebar);
    </script>
@stack('scripts')
</body>
</html>