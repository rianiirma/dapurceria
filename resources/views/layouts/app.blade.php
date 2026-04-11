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
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
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

        .nav-user {
            display: flex;
            align-items: center;
            gap: 10px;
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
        }

        .nav-user-name {
            font-size: 13px;
            font-weight: 600;
            color: rgba(255,255,255,.85);
        }

        .logout-form { display: inline; }

        /* ── HAMBURGER BUTTON ── */
        .hamburger {
            display: none;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 5px;
            width: 38px;
            height: 38px;
            background: rgba(255,255,255,.08);
            border: 1.5px solid rgba(255,255,255,.2);
            border-radius: 8px;
            cursor: pointer;
            padding: 0;
            flex-shrink: 0;
        }

        .hamburger span {
            display: block;
            width: 18px;
            height: 2px;
            background: #fff;
            border-radius: 2px;
            transition: all .25s;
            transform-origin: center;
        }

        .hamburger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
        .hamburger.open span:nth-child(2) { opacity: 0; transform: scaleX(0); }
        .hamburger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

        /* ── MOBILE DRAWER ── */
        .mobile-menu {
            display: none;
            position: fixed;
            top: 60px;
            left: 0; right: 0; bottom: 0;
            z-index: 999;
        }

        .mobile-backdrop {
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,.45);
        }

        .mobile-panel {
            position: absolute;
            top: 0; right: 0;
            width: 260px;
            height: 100%;
            background: #3D2010;
            padding: 8px 0 24px;
            overflow-y: auto;
            box-shadow: -4px 0 24px rgba(0,0,0,.3);
            transform: translateX(100%);
            transition: transform .25s ease;
        }

        .mobile-menu.open { display: block; }
        .mobile-menu.open .mobile-panel { transform: translateX(0); }

        /* User info di drawer */
        .mobile-user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px 20px 18px;
            border-bottom: 1px solid rgba(255,255,255,.1);
            margin-bottom: 6px;
        }

        .mobile-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #E8621A;
            color: #fff;
            font-size: 15px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .mobile-user-name {
            font-size: 14px;
            font-weight: 700;
            color: #fff;
        }

        .mobile-user-email {
            font-size: 11px;
            color: rgba(255,255,255,.45);
            margin-top: 1px;
        }

        /* Link di drawer */
        .mobile-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 20px;
            color: rgba(255,255,255,.78);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            border-left: 3px solid transparent;
            transition: background .15s, color .15s;
        }

        .mobile-link:hover,
        .mobile-link.active {
            background: rgba(255,255,255,.07);
            color: #fff;
            border-left-color: #E8621A;
        }

        .mobile-link-icon { font-size: 17px; width: 22px; text-align: center; }

        .mobile-divider {
            height: 1px;
            background: rgba(255,255,255,.09);
            margin: 6px 20px;
        }

        /* Keluar di drawer */
        .mobile-logout-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 20px;
            color: #F08070;
            font-size: 14px;
            font-weight: 600;
            width: 100%;
            background: none;
            border: none;
            border-left: 3px solid transparent;
            cursor: pointer;
            font-family: inherit;
            transition: background .15s;
        }

        .mobile-logout-btn:hover {
            background: rgba(255,255,255,.06);
            border-left-color: #F08070;
        }

        /* Auth buttons di drawer (guest) */
        .mobile-auth {
            padding: 16px 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .mobile-btn-masuk {
            display: block;
            text-align: center;
            padding: 11px;
            border: 1.5px solid rgba(255,255,255,.3);
            border-radius: 10px;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: background .15s;
        }

        .mobile-btn-masuk:hover { background: rgba(255,255,255,.08); }

        .mobile-btn-daftar {
            display: block;
            text-align: center;
            padding: 11px;
            background: #E8621A;
            border-radius: 10px;
            color: #fff;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            transition: background .15s;
        }

        .mobile-btn-daftar:hover { background: #C84E0E; }

        /* ── GLOBAL ALERTS ── */
        .global-alerts { padding: 12px 0 0; }

        .alert {
            padding: 12px 18px;
            border-radius: 12px;
            border-left: 4px solid;
            font-size: 13px;
            margin-bottom: 10px;
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }

        .alert-success { background: #D4F0E0; color: #1A6B3A; border-color: #2E7D32; }
        .alert-error   { background: #FDDEDE; color: #8B1A1A; border-color: #C62828; }
        .alert-warning { background: #FEF3C0; color: #856404; border-color: #B08010; }

        /* ── CONTENT ── */
        .content { min-height: calc(100vh - 60px - 64px); }

        /* ── BUTTONS ── */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 18px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: all .2s;
        }

        .btn-primary   { background: #E8621A; color: #fff; }
        .btn-primary:hover { background: #C84E0E; }
        .btn-success   { background: #2E7D32; color: #fff; }
        .btn-success:hover { background: #1B5E20; }
        .btn-danger    { background: #C62828; color: #fff; }
        .btn-danger:hover { background: #8B1A1A; }
        .btn-warning   { background: #B08010; color: #fff; }
        .btn-secondary { background: #7A3D1A; color: #fff; }
        .btn-outline-br { background: none; border: 1.5px solid #E0D0C0; color: #7A3D1A; }

        /* ── FOOTER ── */
        .footer {
            background: #3D2010;
            color: rgba(255,255,255,.5);
            text-align: center;
            padding: 20px 0;
            font-size: 12px;
        }

        .footer a { color: #F9946A; text-decoration: none; }

        /* ── RESPONSIVE ── */
        @media (max-width: 680px) {
            /* Sembunyikan menu desktop, tampilkan hamburger */
            .navbar-menu { display: none; }
            .hamburger   { display: flex; }
            .navbar-brand { font-size: 17px; }
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

        {{-- Desktop menu --}}
        <ul class="navbar-menu">
            <li><a href="{{ route('home') }}">Beranda</a></li>

            @auth
                @if(auth()->user()->role === 'admin')
                    @if(Route::has('admin.dashboard'))
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    @endif
                @else
                    @if(Route::has('user.resep.create'))
                        <li><a href="{{ route('user.resep.create') }}">Upload Resep</a></li>
                    @endif
                    @if(Route::has('user.resep.my'))
                        <li><a href="{{ route('user.resep.my') }}">Resep Saya</a></li>
                    @endif
                    @if(Route::has('favorit.index'))
                        <li><a href="{{ route('favorit.index') }}">Favorit</a></li>
                    @endif
                @endif

                <li>
                    <div class="nav-user">
                        <div class="nav-avatar">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                        <span class="nav-user-name">{{ auth()->user()->name }}</span>
                    </div>
                </li>
                <li>
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

        {{-- Hamburger (mobile only) --}}
        <button class="hamburger" id="hamburgerBtn" onclick="toggleDrawer()" aria-label="Buka menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</nav>

{{-- ── MOBILE DRAWER ── --}}
<div class="mobile-menu" id="mobileMenu">
    <div class="mobile-backdrop" onclick="closeDrawer()"></div>
    <div class="mobile-panel">

        @auth
            {{-- Info user --}}
            <div class="mobile-user-info">
                <div class="mobile-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
                <div>
                    <div class="mobile-user-name">{{ auth()->user()->name }}</div>
                    <div class="mobile-user-email">{{ auth()->user()->email }}</div>
                </div>
            </div>

            {{-- Links --}}
            <a href="{{ route('home') }}" class="mobile-link {{ request()->routeIs('home') ? 'active' : '' }}">
                <span class="mobile-link-icon">🏠</span> Beranda
            </a>

            @if(auth()->user()->role === 'admin')
                @if(Route::has('admin.dashboard'))
                    <a href="{{ route('admin.dashboard') }}" class="mobile-link">
                        <span class="mobile-link-icon">⚙️</span> Dashboard Admin
                    </a>
                @endif
            @else
                @if(Route::has('user.resep.create'))
                    <a href="{{ route('user.resep.create') }}" class="mobile-link {{ request()->routeIs('user.resep.create') ? 'active' : '' }}">
                        <span class="mobile-link-icon">📤</span> Upload Resep
                    </a>
                @endif
                @if(Route::has('user.resep.my'))
                    <a href="{{ route('user.resep.my') }}" class="mobile-link {{ request()->routeIs('user.resep.my') ? 'active' : '' }}">
                        <span class="mobile-link-icon">📋</span> Resep Saya
                    </a>
                @endif
                @if(Route::has('favorit.index'))
                    <a href="{{ route('favorit.index') }}" class="mobile-link {{ request()->routeIs('favorit.*') ? 'active' : '' }}">
                        <span class="mobile-link-icon">❤️</span> Favorit
                    </a>
                @endif
            @endif

            <div class="mobile-divider"></div>

            {{-- Keluar --}}
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="mobile-logout-btn">
                    <span class="mobile-link-icon">🚪</span> Keluar
                </button>
            </form>

        @else
            {{-- Guest --}}
            <a href="{{ route('home') }}" class="mobile-link">
                <span class="mobile-link-icon">🏠</span> Beranda
            </a>

            <div class="mobile-divider"></div>

            <div class="mobile-auth">
                <a href="{{ route('login') }}" class="mobile-btn-masuk">Masuk</a>
                <a href="{{ route('register') }}" class="mobile-btn-daftar">Daftar Sekarang</a>
            </div>
        @endauth

    </div>
</div>

{{-- ── CONTENT ── --}}
<div class="content">
    <div class="container">
        @if(session('success'))
            <div class="global-alerts">
                <div class="alert alert-success">✓ {{ session('success') }}</div>
            </div>
        @endif
        @if(session('error'))
            <div class="global-alerts">
                <div class="alert alert-error">⚠ {{ session('error') }}</div>
            </div>
        @endif
        @if(session('warning'))
            <div class="global-alerts">
                <div class="alert alert-warning">⚠ {{ session('warning') }}</div>
            </div>
        @endif
    </div>

    @yield('content')
</div>

{{-- ── FOOTER ── --}}
<footer class="footer">
    <div class="container">
        <p>&copy; 2024 DapurCeria. Semua hak dilindungi.</p>
    </div>
</footer>

@stack('scripts')

<script>
function toggleDrawer() {
    const menu  = document.getElementById('mobileMenu');
    const btn   = document.getElementById('hamburgerBtn');
    const panel = menu.querySelector('.mobile-panel');

    if (menu.classList.contains('open')) {
        closeDrawer();
    } else {
        menu.classList.add('open');
        btn.classList.add('open');
        document.body.style.overflow = 'hidden';
    }
}

function closeDrawer() {
    const menu  = document.getElementById('mobileMenu');
    const btn   = document.getElementById('hamburgerBtn');
    const panel = menu.querySelector('.mobile-panel');

    panel.style.transform = 'translateX(100%)';
    btn.classList.remove('open');
    document.body.style.overflow = '';

    setTimeout(() => {
        menu.classList.remove('open');
        panel.style.transform = '';
    }, 250);
}

// Auto-close saat layar diperbesar ke desktop
window.addEventListener('resize', () => {
    if (window.innerWidth > 680) closeDrawer();
});
</script>
</body>
</html>