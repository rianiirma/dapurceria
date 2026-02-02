<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - {{ config('app.name', 'Dapur Ceria') }}</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white">
            <div class="p-6">
                <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold text-orange-400">
                    🍳 Admin Panel
                </a>
            </div>
            
            <nav class="mt-6">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700 border-l-4 border-orange-400' : 'hover:bg-gray-700' }}">
                    <span>📊 Dashboard</span>
                </a>
                
                <a href="{{ route('admin.kategori.index') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('admin.kategori.*') ? 'bg-gray-700 border-l-4 border-orange-400' : 'hover:bg-gray-700' }}">
                    <span>📁 Kategori</span>
                </a>
                
                <a href="{{ route('admin.resep.index') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('admin.resep.*') ? 'bg-gray-700 border-l-4 border-orange-400' : 'hover:bg-gray-700' }}">
                    <span>🍲 Resep</span>
                </a>
                
                <a href="{{ route('admin.komentar.index') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('admin.komentar.*') ? 'bg-gray-700 border-l-4 border-orange-400' : 'hover:bg-gray-700' }}">
                    <span>💬 Komentar</span>
                    @if($unreadKomentars ?? 0 > 0)
                        <span class="ml-auto bg-red-500 text-xs px-2 py-1 rounded-full">{{ $unreadKomentars }}</span>
                    @endif
                </a>
                
                <a href="{{ route('admin.users.index') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('admin.users.*') ? 'bg-gray-700 border-l-4 border-orange-400' : 'hover:bg-gray-700' }}">
                    <span>👥 Users</span>
                </a>
                
                <hr class="my-4 border-gray-700">
                
                <a href="{{ route('home') }}" class="flex items-center px-6 py-3 hover:bg-gray-700">
                    <span>🏠 Lihat Website</span>
                </a>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-6 py-3 hover:bg-gray-700 text-left">
                        <span>🚪 Logout</span>
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between px-6 py-4">
                    <h1 class="text-2xl font-semibold text-gray-800">@yield('header', 'Dashboard')</h1>
                    
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-600">{{ auth()->user()->name }}</span>
                        <img src="{{ auth()->user()->foto_profil ? asset('storage/' . auth()->user()->foto_profil) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}" 
                            class="w-10 h-10 rounded-full">
                    </div>
                </div>
            </header>

            <!-- Alert Messages -->
            @if(session('success'))
                <x-alert type="success" :message="session('success')" />
            @endif
            
            @if(session('error'))
                <x-alert type="error" :message="session('error')" />
            @endif

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                @yield('content')
            </main>
        </div>
    </div>

    {{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
</body>
</html>