<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dapur Ceria</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center">
        <div class="text-center">
            <h1 class="text-6xl font-bold text-orange-600 mb-4">🍳 Dapur Ceria</h1>
            <p class="text-xl text-gray-600 mb-8">Platform Berbagi Resep Masakan</p>
            
            <div class="space-x-4">
                @guest
                    <a href="{{ route('login') }}" class="bg-orange-600 text-white px-6 py-3 rounded-lg hover:bg-orange-700 inline-block">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 inline-block">
                        Register
                    </a>
                @else
                    <a href="{{ route('dashboard') }}" class="bg-orange-600 text-white px-6 py-3 rounded-lg hover:bg-orange-700 inline-block">
                        Dashboard
                    </a>
                @endguest
            </div>
        </div>
    </div>
</body>
</html>