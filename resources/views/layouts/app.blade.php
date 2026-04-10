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

        /* nav buttons */
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

        /* user dropdown area */
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

        /* admin badge in nav */
        .nav-admin-badge {
            background: #E8621A;
            color: #fff;
            font-size: 9px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 8px;
            letter-spacing: .5px;
        }

        /* logout form inline */
        .logout-form { display: inline; }

        /* ── GLOBAL ALERTS ── */
        .global-alerts {
            padding: 12px 0 0;
        }

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

        .alert-success {
            background: #D4F0E0;
            color: #1A6B3A;
            border-color: #2E7D32;
        }

        .alert-error {
            background: #FDDEDE;
            color: #8B1A1A;
            border-color: #C62828;
        }

        .alert-warning {
            background: #FEF3C0;
            color: #856404;
            border-color: #B08010;
        }

        /* ── CONTENT ── */
        .content {
            min-height: calc(100vh - 60px - 64px);
        }

        /* ── BUTTONS (global helpers) ── */
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
        .btn-outline-br {
            background: none;
            border: 1.5px solid #E0D0C0;
            color: #7A3D1A;
        }

        /* ── FOOTER ── */
        .footer {
            background: #3D2010;
            color: rgba(255,255,255,.5);
            text-align: center;
            padding: 20px 0;
            font-size: 12px;
        }

        .footer a {
            color: #F9946A;
            text-decoration: none;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 680px) {
            .navbar-menu .nav-hide-sm { display: none; }
            .navbar-brand { font-size: 17px; }
        }
    </style>

    {{-- Per-page styles --}}
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
                    {{-- Admin menu --}}
                    @if(auth()->user()->role === 'admin')
                        <li class="nav-hide-sm"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="nav-hide-sm"><a href="{{ route('admin.resep.index') }}">Kelola Resep</a></li>
                        <li class="nav-hide-sm"><a href="{{ route('admin.users.index') }}">Kelola User</a></li>
                        <li><span class="nav-admin-badge">ADMIN</span></li>
                    @else
                        {{-- User menu --}}
                        <li class="nav-hide-sm"><a href="{{ route('user.resep.create') }}">Upload Resep</a></li>
                        <li class="nav-hide-sm"><a href="{{ route('user.resep.my') }}">Resep Saya</a></li>
                        <li class="nav-hide-sm"><a href="{{ route('favorit.index') }}">Favorit</a></li>
                    @endif

                    {{-- User info + logout --}}
                    <li>
                        <div class="nav-user">
                            <div class="nav-avatar">
                                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                            </div>
                            <span class="nav-user-name nav-hide-sm">
                                {{ auth()->user()->name }}
                            </span>
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
        </div>
    </nav>

    {{-- ── CONTENT ── --}}
    <div class="content">
        <div class="container">

            {{-- Global flash messages --}}
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

        {{-- Content tanpa container (full-width pages bisa atur sendiri) --}}
        @yield('content')
    </div>

    {{-- ── FOOTER ── --}}
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 DapurCeria. Semua hak dilindungi.</p>
        </div>
    </footer>

    {{-- Per-page scripts --}}
    @stack('scripts')
</body>
</html>