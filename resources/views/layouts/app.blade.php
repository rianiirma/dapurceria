<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Dapur Ceria') }} - @yield('title', 'Resep Masakan')</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <span class="text-2xl font-bold text-orange-600">🍳 Dapur Ceria</span>
                    </a>
                    
                    <!-- Navigation Links -->
                    <div class="hidden md:flex ml-10 space-x-8">
                        <a href="{{ route('home') }}" class="text-gray-700 hover:text-orange-600 px-3 py-2 text-sm font-medium">
                            Home
                        </a>
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-orange-600 px-3 py-2 text-sm font-medium">
                                Dashboard
                            </a>
                            <a href="{{ route('user.resep.my-recipes') }}" class="text-gray-700 hover:text-orange-600 px-3 py-2 text-sm font-medium">
                                Resep Saya
                            </a>
                            <a href="{{ route('favorit.index') }}" class="text-gray-700 hover:text-orange-600 px-3 py-2 text-sm font-medium">
                                Favorit
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Search -->
                <div class="hidden md:flex items-center flex-1 max-w-md mx-8">
                    <form action="{{ route('resep.search') }}" method="GET" class="w-full">
                        <input type="text" name="q" placeholder="Cari resep..." 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                            value="{{ request('q') }}">
                    </form>
                </div>

                <!-- Right Side -->
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('user.resep.create') }}" class="bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700 text-sm font-medium">
                            + Upload Resep
                        </a>
                        
                        <!-- Dropdown User -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 hover:text-orange-600">
                                <img src="{{ auth()->user()->foto_profil ? asset('storage/' . auth()->user()->foto_profil) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}" 
                                    class="w-8 h-8 rounded-full">
                                <span class="text-sm font-medium">{{ auth()->user()->name }}</span>
                            </button>
                            
                            <div x-show="open" @click.away="open = false" 
                                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Admin Dashboard
                                    </a>
                                @endif
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Profil
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-orange-600 px-3 py-2 text-sm font-medium">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700 text-sm font-medium">
                            Register
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Alert Messages -->
    @if(session('success'))
        <x-alert type="success" :message="session('success')" />
    @endif
    
    @if(session('error'))
        <x-alert type="error" :message="session('error')" />
    @endif

    <!-- Main Content -->
    <main class="py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <p class="text-lg font-bold">🍳 Dapur Ceria</p>
                <p class="text-gray-400 mt-2">Platform berbagi resep masakan terbaik</p>
                <p class="text-gray-400 mt-4">&copy; 2024 Dapur Ceria. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Alpine.js for dropdown -->
    {{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
</body>
</html>