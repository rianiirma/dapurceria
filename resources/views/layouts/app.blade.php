<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>@yield('title', 'Dapur Ceria')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background: #f5f5f5;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        /* Navbar */
        .navbar {
            background: #ff6b6b;
            color: white;
            padding: 1rem 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .navbar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .navbar-menu {
            display: flex;
            gap: 1.5rem;
            align-items: center;
            list-style: none;
        }
        .navbar-menu a {
            color: white;
            text-decoration: none;
            transition: opacity 0.3s;
            font-weight: 500;
        }
        .navbar-menu a:hover {
            opacity: 0.8;
        }
        .btn {
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            font-size: 0.95rem;
            font-weight: 500;
        }
        .btn-primary {
            background: #ff6b6b;
            color: white;
        }
        .btn-primary:hover {
            background: #ee5a52;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 107, 107, 0.4);
        }
        .btn-success {
            background: #51cf66;
            color: white;
        }
        .btn-success:hover {
            background: #40c057;
            transform: translateY(-2px);
        }
        .btn-danger {
            background: #ff6b6b;
            color: white;
        }
        .btn-danger:hover {
            background: #ee5a52;
        }
        .btn-warning {
            background: #ffd43b;
            color: #333;
        }
        .btn-secondary {
            background: #868e96;
            color: white;
        }
        .btn-outline {
            background: transparent;
            border: 2px solid white;
            color: white;
        }
        .btn-outline:hover {
            background: white;
            color: #ff6b6b;
        }
        /* Alert */
        .alert {
            padding: 1rem 1.5rem;
            margin: 1rem 0;
            border-radius: 10px;
            border-left: 4px solid;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
            border-color: #51cf66;
        }
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border-color: #ff6b6b;
        }
        /* Content */
        .content {
            min-height: calc(100vh - 200px);
            padding: 2rem 0;
        }
        /* Footer */
        .footer {
            background: #343a40;
            color: white;
            text-align: center;
            padding: 2rem 0;
            margin-top: 3rem;
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <a href="{{ route('home') }}" class="navbar-brand">🍳 Dapur Ceria</a>
            <ul class="navbar-menu">
                <li><a href="{{ route('home') }}">Beranda</a></li>
                
                @auth
                    <li><a href="{{ route('user.resep.create') }}">Upload Resep</a></li>
                    <li><a href="{{ route('user.resep.my') }}">Resep Saya</a></li>
                    <li><a href="{{ route('favorit.index') }}">Favorit</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-outline">Logout ({{ auth()->user()->name }})</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}" class="btn btn-outline">Login</a></li>
                    <li><a href="{{ route('register') }}" class="btn btn-success">Daftar</a></li>
                @endauth
            </ul>
        </div>
    </nav>

    <!-- Content -->
    <div class="content">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2026 Dapur Ceria. Semua hak dilindungi.</p>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>     