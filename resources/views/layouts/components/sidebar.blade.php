<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        {{-- <a href="{{ route('dashboard') }}" class="app-brand-link"> --}}
            <span class="app-brand-logo demo">
                <!-- Logo SVG bisa diganti sesuai branding Dapur Ceria -->
                <img src="{{ asset('images/logo-dapurceria.png') }}" alt="Dapur Ceria" width="30">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Dapur Ceria</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        {{-- <li class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div>Dashboard</div>
            </a>
        </li> --}}

        <!-- User -->
        <li class="menu-item {{ request()->is('user*') ? 'active' : '' }}">
            <a href="{{ route('user.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-circle"></i>
                <div>User</div>
            </a>
        </li>

        <!-- Kategori -->
        <li class="menu-item {{ request()->is('kategori*') ? 'active' : '' }}">
            <a href="{{ route('kategori.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-category"></i>
                <div>Kategori</div>
            </a>
        </li>

        <!-- Resep -->
        <li class="menu-item {{ request()->is('resep*') ? 'active' : '' }}">
            <a href="{{ route('resep.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-book-alt"></i>
                <div>Resep</div>
            </a>
        </li>

        <!-- Bahan -->
        <li class="menu-item {{ request()->is('bahan*') ? 'active' : '' }}">
            <a href="{{ route('bahan.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div>Bahan</div>
            </a>
        </li>

        <!-- Langkah -->
        <li class="menu-item {{ request()->is('langkah*') ? 'active' : '' }}">
            <a href="{{ route('langkah.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-task"></i>
                <div>Langkah</div>
            </a>
        </li>

        <!-- Komentar -->
        <li class="menu-item {{ request()->is('komentar*') ? 'active' : '' }}">
            <a href="{{ route('komentar.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-comment"></i>
                <div>Komentar</div>
            </a>
        </li>

        <!-- Favorit -->
        <li class="menu-item {{ request()->is('favorit*') ? 'active' : '' }}">
            <a href="{{ route('favorit.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-heart"></i>
                <div>Favorit</div>
            </a>
        </li>

        <!-- Logout -->
        <li class="menu-item">
            {{-- <a href="#" class="menu-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="menu-icon tf-icons bx bx-log-out"></i>
                <div>Logout</div>
            </a> --}}
            {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> --}}
                @csrf
            </form>
        </li>
    </ul>
</aside>

