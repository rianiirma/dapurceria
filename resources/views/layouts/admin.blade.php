<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>@yield('title', 'Admin - Dapur Ceria')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #FEF3C7;
            color: #333;
            line-height: 1.6;
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* =============================================
           SIDEBAR
        ============================================= */
        .sidebar {
            width: 250px;
            background: linear-gradient(180deg, #78350F 0%, #92400E 100%);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 100;
            transition: transform 0.3s ease;
        }

        .sidebar-brand {
            padding: 1.5rem;
            background: linear-gradient(135deg, #F59E0B, #FBBF24);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-brand h2 {
            font-size: 1.25rem;
            color: white;
            font-weight: 700;
        }

        .sidebar-section {
            padding: 1rem 1.5rem 0.4rem;
            font-size: 10px;
            font-weight: 700;
            color: #D97706;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0.5rem 0;
        }

        .sidebar-menu li a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0.75rem 1.5rem;
            color: #FEF3C7;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .sidebar-menu li a i {
            font-size: 1.1rem;
            width: 20px;
        }

        .sidebar-menu li a:hover {
            background: rgba(245, 158, 11, 0.2);
            color: #FBBF24;
        }

        .sidebar-menu li a.active {
            background: rgba(245, 158, 11, 0.25);
            color: #FCD34D;
            border-left: 3px solid #FBBF24;
            font-weight: 600;
        }

        .sidebar-menu li a .badge-count {
            margin-left: auto;
            background: #EF4444;
            color: white;
            border-radius: 99px;
            font-size: 10px;
            font-weight: 700;
            min-width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 5px;
        }

        .sidebar-divider {
            border: none;
            border-top: 1px solid rgba(245, 158, 11, 0.2);
            margin: 0.75rem 1.5rem;
        }

        /* Footer sidebar — bisa diklik ke profil */
        .sidebar-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(245, 158, 11, 0.2);
            position: absolute;
            bottom: 0;
            width: 100%;
            background: #78350F;
        }

        .sidebar-footer a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #FEF3C7;
            text-decoration: none;
            font-size: 0.875rem;
            transition: all 0.2s;
            padding: 6px 8px;
            border-radius: 8px;
        }

        .sidebar-footer a:hover {
            background: rgba(245, 158, 11, 0.15);
            color: #FBBF24;
        }

        .sidebar-footer-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, #F59E0B, #FBBF24);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
            overflow: hidden;
            border: 2px solid rgba(255,255,255,0.25);
        }

        .sidebar-footer-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .sidebar-footer-info {
            flex: 1;
            min-width: 0;
        }

        .sidebar-footer-name {
            font-size: 13px;
            font-weight: 600;
            color: white;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-footer-role {
            font-size: 11px;
            color: rgba(255,255,255,0.45);
        }

        .sidebar-footer-arrow {
            font-size: 16px;
            color: rgba(255,255,255,0.35);
            flex-shrink: 0;
        }

        .sidebar::-webkit-scrollbar { width: 4px; }
        .sidebar::-webkit-scrollbar-track { background: transparent; }
        .sidebar::-webkit-scrollbar-thumb { background: #D97706; border-radius: 99px; }

        /* =============================================
           MAIN CONTENT
        ============================================= */
        .main-content {
            margin-left: 250px;
            flex: 1;
            padding: 2rem;
            padding-bottom: 4rem;
        }

        /* =============================================
           TOPBAR
        ============================================= */
        .topbar {
            background: linear-gradient(135deg, #F59E0B, #FBBF24);
            padding: 1rem 1.5rem;
            margin: -2rem -2rem 2rem -2rem;
            box-shadow: 0 2px 10px rgba(245, 158, 11, 0.3);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .topbar h1 {
            font-size: 1.25rem;
            color: white;
            font-weight: 600;
        }

        /* Tombol hamburger mobile */
        .hamburger-btn {
            display: none;
            background: rgba(255,255,255,0.2);
            border: none;
            color: white;
            font-size: 1.4rem;
            border-radius: 6px;
            width: 36px;
            height: 36px;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.2s;
        }

        .hamburger-btn:hover {
            background: rgba(255,255,255,0.3);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        /* Avatar di topbar — bisa diklik ke profil */
        .topbar-user-link {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            padding: 4px 8px;
            border-radius: 8px;
            transition: background 0.2s;
        }

        .topbar-user-link:hover {
            background: rgba(255,255,255,0.15);
        }

        .user-avatar {
            width: 34px;
            height: 34px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 13px;
            border: 2px solid rgba(255, 255, 255, 0.5);
            overflow: hidden;
            flex-shrink: 0;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-name {
            font-size: 0.875rem;
            color: white;
            font-weight: 500;
        }

        /* =============================================
           CARD
        ============================================= */
        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(245, 158, 11, 0.1);
            margin-bottom: 1.5rem;
            border: 1px solid #FDE68A;
            overflow: hidden;
        }

        .card-header {
            border-bottom: 1px solid #FDE68A;
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, #FFFBEB, #FEF3C7);
        }

        .card-header h3 {
            font-size: 1rem;
            color: #78350F;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-header h3 i {
            color: #F59E0B;
            font-size: 1.1rem;
        }

        /* =============================================
           STATS
        ============================================= */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .stat-card {
            background: white;
            padding: 1.25rem 1.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(245, 158, 11, 0.1);
            border-left: 4px solid #F59E0B;
            border-top: 1px solid #FDE68A;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.2);
        }

        .stat-card h4 {
            color: #92400E;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.5rem;
        }

        .stat-card .stat-value {
            font-size: 1.875rem;
            font-weight: 700;
            color: #78350F;
            line-height: 1;
        }

        .stat-card p {
            color: #A8A29E;
            font-size: 0.75rem;
            margin-top: 0.4rem;
        }

        /* =============================================
           TABLE
        ============================================= */
        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th {
            padding: 0.75rem 1rem;
            text-align: left;
            border-bottom: 1px solid #FDE68A;
            background: #FFFBEB;
            font-weight: 600;
            font-size: 0.75rem;
            color: #92400E;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .table td {
            padding: 0.875rem 1rem;
            border-bottom: 1px solid #FEF9EE;
            font-size: 0.875rem;
            color: #44403C;
            vertical-align: middle;
        }

        .table tr:last-child td { border-bottom: none; }
        .table tr:hover td { background: #FFFBEB; }

        /* =============================================
           BUTTONS
        ============================================= */
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            font-size: 0.875rem;
            font-weight: 500;
            font-family: inherit;
        }

        .btn-primary {
            background: linear-gradient(135deg, #F59E0B, #FBBF24);
            color: white;
            box-shadow: 0 2px 5px rgba(245, 158, 11, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #D97706, #F59E0B);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
            color: white;
            text-decoration: none;
        }

        .btn-success {
            background: linear-gradient(135deg, #10B981, #34D399);
            color: white;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #059669, #10B981);
            transform: translateY(-1px);
            color: white;
            text-decoration: none;
        }

        .btn-danger {
            background: linear-gradient(135deg, #EF4444, #F87171);
            color: white;
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #DC2626, #EF4444);
            color: white;
            text-decoration: none;
        }

        .btn-warning {
            background: linear-gradient(135deg, #FBBF24, #FCD34D);
            color: #78350F;
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #F59E0B, #FBBF24);
            color: #78350F;
            text-decoration: none;
        }

        .btn-secondary {
            background: #92400E;
            color: white;
        }

        .btn-secondary:hover {
            background: #78350F;
            color: white;
            text-decoration: none;
        }

        .btn-sm {
            padding: 0.3rem 0.65rem;
            font-size: 0.75rem;
            border-radius: 6px;
        }

        /* =============================================
           FORM
        ============================================= */
        .form-group { margin-bottom: 1.5rem; }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            font-size: 0.875rem;
            color: #78350F;
        }

        .form-control {
            width: 100%;
            padding: 0.625rem 0.875rem;
            border: 1px solid #FDE68A;
            border-radius: 8px;
            font-size: 0.9rem;
            font-family: inherit;
            color: #333;
            background: white;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: #F59E0B;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.15);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        /* =============================================
           ALERT
        ============================================= */
        .alert {
            padding: 0.875rem 1.25rem;
            margin-bottom: 1.25rem;
            border-radius: 10px;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 8px;
            border-left: 4px solid;
        }

        .alert-success {
            background: #D1FAE5;
            color: #065F46;
            border-color: #10B981;
        }

        .alert-error {
            background: #FEE2E2;
            color: #991B1B;
            border-color: #EF4444;
        }

        .alert-warning {
            background: #FEF3C7;
            color: #92400E;
            border-color: #F59E0B;
        }

        /* =============================================
           BADGE
        ============================================= */
        .badge {
            display: inline-block;
            padding: 0.2rem 0.65rem;
            border-radius: 99px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        .badge-success {
            background: #D1FAE5;
            color: #065F46;
            border: 1px solid #6EE7B7;
        }

        .badge-danger {
            background: #FEE2E2;
            color: #991B1B;
            border: 1px solid #FCA5A5;
        }

        .badge-warning {
            background: #FEF3C7;
            color: #92400E;
            border: 1px solid #FCD34D;
        }

        .badge-primary {
            background: #FDE68A;
            color: #78350F;
            border: 1px solid #FBBF24;
        }

        /* =============================================
           PAGINATION
        ============================================= */
        .pagination {
            display: flex;
            gap: 4px;
            justify-content: center;
            padding: 1rem;
            border-top: 1px solid #FDE68A;
        }

        .pagination .page-link {
            padding: 6px 12px;
            border-radius: 6px;
            border: 1px solid #FDE68A;
            color: #92400E;
            text-decoration: none;
            font-size: 13px;
            transition: all 0.2s;
        }

        .pagination .page-link:hover,
        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #F59E0B, #FBBF24);
            border-color: #F59E0B;
            color: white;
        }

        /* =============================================
           OVERLAY MOBILE
        ============================================= */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 99;
        }

        /* =============================================
           RESPONSIVE
        ============================================= */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.sidebar-open {
                transform: translateX(0);
            }

            .sidebar-overlay.overlay-open {
                display: block;
            }

            .main-content {
                margin-left: 0;
            }

            .hamburger-btn {
                display: flex;
            }

            .user-name {
                display: none;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .topbar {
                padding: 0.75rem 1rem;
                margin: -2rem -2rem 1.5rem -2rem;
            }
        }

        @media (max-width: 480px) {
            .stats-grid {
                grid-template-columns: 1fr 1fr;
            }

            .main-content {
                padding: 1rem;
                padding-bottom: 3rem;
            }
        }
    </style>
    @yield('styles')
</head>

<body>
    <div class="admin-wrapper">

        {{-- ===== SIDEBAR ===== --}}
        <aside class="sidebar" id="admin-sidebar">
            <div class="sidebar-brand">
                <span style="font-size:1.5rem;">🍳</span>
                <h2>Dapur Ceria</h2>
            </div>

            <p class="sidebar-section">Menu Utama</p>
            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class='bx bx-home-alt'></i> Dashboard
                        @php $pendingCount = \App\Models\Resep::where('status','pending')->count(); @endphp
                        @if($pendingCount > 0)
                            <span class="badge-count">{{ $pendingCount }}</span>
                        @endif
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.resep.index') }}"
                        class="{{ request()->routeIs('admin.resep.*') ? 'active' : '' }}">
                        <i class='bx bx-food-menu'></i> Resep
                        @if($pendingCount > 0)
                            <span class="badge-count">{{ $pendingCount }}</span>
                        @endif
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.kategori.index') }}"
                        class="{{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
                        <i class='bx bx-category'></i> Kategori
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.komentar.index') }}"
                        class="{{ request()->routeIs('admin.komentar.*') ? 'active' : '' }}">
                        <i class='bx bx-message-square-dots'></i> Komentar
                        @php $unreadCount = \App\Models\Komentar::where('is_read', false)->count(); @endphp
                        @if($unreadCount > 0)
                            <span class="badge-count">{{ $unreadCount }}</span>
                        @endif
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.user.index') }}"
                        class="{{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                        <i class='bx bx-group'></i> Pengguna
                    </a>
                </li>
            </ul>

            <hr class="sidebar-divider">

            <p class="sidebar-section">Lainnya</p>
            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('home') }}" target="_blank">
                        <i class='bx bx-globe'></i> Lihat Website
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile.show') }}"
                        class="{{ request()->routeIs('profile.*') ? 'active' : '' }}">
                        <i class='bx bx-user-circle'></i> Profil Saya
                    </a>
                </li>
            </ul>

            {{-- Footer sidebar — klik ke profil --}}
            <div class="sidebar-footer">
                <a href="{{ route('profile.show') }}">
                    <div class="sidebar-footer-avatar">
                        @if(auth()->user()->foto_profil)
                            <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}" alt="foto">
                        @else
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        @endif
                    </div>
                    <div class="sidebar-footer-info">
                        <div class="sidebar-footer-name">{{ auth()->user()->name }}</div>
                        <div class="sidebar-footer-role">Administrator</div>
                    </div>
                    <div class="sidebar-footer-arrow">›</div>
                </a>
            </div>
        </aside>

        {{-- Overlay mobile --}}
        <div class="sidebar-overlay" id="sidebar-overlay" onclick="tutupSidebar()"></div>

        {{-- ===== MAIN CONTENT ===== --}}
        <main class="main-content">
            <div class="topbar">
                <div class="topbar-left">
                    {{-- Hamburger (mobile only) --}}
                    <button class="hamburger-btn" onclick="toggleSidebar()" id="hamburger-btn">
                        <i class='bx bx-menu'></i>
                    </button>
                    <h1>@yield('page-title', 'Dashboard')</h1>
                </div>

                <div class="user-info">
                    {{-- Avatar topbar — klik ke profil --}}
                    <a href="{{ route('profile.show') }}" class="topbar-user-link">
                        <div class="user-avatar">
                            @if(auth()->user()->foto_profil)
                                <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}" alt="foto">
                            @else
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            @endif
                        </div>
                        <span class="user-name">{{ auth()->user()->name }}</span>
                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm"
                            style="border: 2px solid white; color: white; background: transparent; font-size: 0.8rem;">
                            <i class='bx bx-log-out'></i> Logout
                        </button>
                    </form>
                </div>
            </div>

            {{-- Flash messages --}}
            @if(session('success'))
                <div class="alert alert-success">
                    <i class='bx bx-check-circle'></i> {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-error">
                    <i class='bx bx-error-circle'></i> {{ session('error') }}
                </div>
            @endif
            @if(session('warning'))
                <div class="alert alert-warning">
                    <i class='bx bx-info-circle'></i> {{ session('warning') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar  = document.getElementById('admin-sidebar');
            const overlay  = document.getElementById('sidebar-overlay');
            const hamburger = document.getElementById('hamburger-btn');
            const terbuka  = sidebar.classList.toggle('sidebar-open');
            overlay.classList.toggle('overlay-open', terbuka);
            hamburger.innerHTML = terbuka
                ? "<i class='bx bx-x'></i>"
                : "<i class='bx bx-menu'></i>";
        }

        function tutupSidebar() {
            document.getElementById('admin-sidebar').classList.remove('sidebar-open');
            document.getElementById('sidebar-overlay').classList.remove('overlay-open');
            document.getElementById('hamburger-btn').innerHTML = "<i class='bx bx-menu'></i>";
        }

        // Tutup sidebar kalau layar diperbesar lagi
        window.addEventListener('resize', function () {
            if (window.innerWidth > 768) tutupSidebar();
        });
    </script>

    @stack('scripts')
</body>

</html>