@props(['resep'])

<div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition duration-300">
    <a href="{{ route('resep.show', $resep) }}">
        <div class="relative h-48">
            @if($resep->gambar)
                <img src="{{ asset('storage/' . $resep->gambar) }}" alt="{{ $resep->judul }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center">
                    <span class="text-white text-6xl">🍳</span>
                </div>
            @endif
            
            <!-- Badge Kesulitan -->
            <span class="absolute top-2 right-2 px-3 py-1 rounded-full text-xs font-semibold
                {{ $resep->tingkat_kesulitan === 'mudah' ? 'bg-green-500 text-white' : '' }}
                {{ $resep->tingkat_kesulitan === 'sedang' ? 'bg-yellow-500 text-white' : '' }}
                {{ $resep->tingkat_kesulitan === 'sulit' ? 'bg-red-500 text-white' : '' }}">
                {{ ucfirst($resep->tingkat_kesulitan) }}
            </span>
        </div>
    </a>
    
    <div class="p-4">
        <a href="{{ route('resep.show', $resep) }}">
            <h3 class="font-bold text-lg text-gray-800 hover:text-orange-600 line-clamp-2">{{ $resep->judul }}</h3>
        </a>
        
        <p class="text-gray-600 text-sm mt-2 line-clamp-2">{{ Str::limit($resep->deskripsi, 100) }}</p>
        
        <div class="flex items-center justify-between mt-4">
            <div class="flex items-center space-x-4 text-sm text-gray-500">
                <span class="flex items-center">
                    ⏱️ {{ $resep->waktu_memasak }} menit
                </span>
                <span class="flex items-center">
                    👥 {{ $resep->porsi }} porsi
                </span>
            </div>
        </div>
        
        <div class="flex items-center justify-between mt-4 pt-4 border-t">
            <div class="flex items-center space-x-1">
                <span class="text-yellow-400">⭐</span>
                <span class="text-sm font-semibold">{{ number_format($resep->averageRating(), 1) }}</span>
                <span class="text-xs text-gray-500">({{ $resep->totalRating() }})</span>
            </div>
            
            <div class="flex items-center space-x-4 text-sm text-gray-500">
                <span>❤️ {{ $resep->totalSuka() }}</span>
                <span>💬 {{ $resep->totalKomentar() }}</span>
            </div>
        </div>
        
        <div class="mt-3 flex items-center text-xs text-gray-500">
            <img src="{{ $resep->user->foto_profil ? asset('storage/' . $resep->user->foto_profil) : 'https://ui-avatars.com/api/?name=' . urlencode($resep->user->name) }}" 
                class="w-6 h-6 rounded-full mr-2">
            <span>{{ $resep->user->name }}</span>
            <span class="mx-2">•</span>
            <span>{{ $resep->kategori->nama_kategori }}</span>
        </div>
    </div>
</div>