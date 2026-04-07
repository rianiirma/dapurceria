@extends('layouts.app')

@section('title', 'Dapur Ceria - Temukan Resep Favoritmu')

@section('styles')
<style>
    /* Hero Carousel */
    .hero-carousel {
        position: relative;
        width: 100%;
        height: 500px;
        overflow: hidden;
        border-radius: 20px;
        margin-bottom: 3rem;
        box-shadow: 0 10px 40px rgba(0,0,0,0.15);
    }
    .carousel-container {
        display: flex;
        transition: transform 0.5s ease;
        height: 100%;
    }
    .carousel-slide {
        min-width: 100%;
        height: 100%;
        position: relative;
        background-size: cover;
        background-position: center;
    }
    .carousel-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(255,152,0,0.9) 0%, rgba(255,193,7,0.7) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        color: white;
        text-align: center;
        padding: 2rem;
    }
    .carousel-slide h2 {
        font-size: 3rem;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }
    .carousel-slide p {
        font-size: 1.2rem;
        margin-bottom: 2rem;
        max-width: 600px;
    }
    .carousel-controls {
        position: absolute;
        bottom: 2rem;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 0.5rem;
        z-index: 10;
    }
    .carousel-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(255,255,255,0.5);
        cursor: pointer;
        transition: all 0.3s;
    }
    .carousel-dot.active {
        background: white;
        width: 30px;
        border-radius: 6px;
    }
    .carousel-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255,255,255,0.3);
        color: white;
        border: none;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 1.5rem;
        backdrop-filter: blur(10px);
        transition: all 0.3s;
    }
    .carousel-btn:hover {
        background: rgba(255,255,255,0.5);
    }
    .carousel-btn.prev {
        left: 2rem;
    }
    .carousel-btn.next {
        right: 2rem;
    }

    /* Section Headers */
    .section-header {
        text-align: center;
        margin: 4rem 0 2rem 0;
    }
    .section-header h2 {
        font-size: 2.5rem;
        color: #333;
        margin-bottom: 0.5rem;
    }
    .section-header p {
        color: #666;
        font-size: 1.1rem;
    }

    /* Categories Grid */
    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 1.5rem;
        margin-bottom: 4rem;
    }
    .category-card {
        background: white;
        padding: 1.5rem;
        border-radius: 15px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        text-decoration: none;
        color: inherit;
    }
    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(255,152,0,0.2);
    }
    .category-icon {
        font-size: 3rem;
        margin-bottom: 0.5rem;
    }
    .category-name {
        font-size: 0.9rem;
        font-weight: 600;
        color: #333;
    }

    /* Filter Section */
    .filter-section {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        margin-bottom: 3rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    .filter-row {
        display: flex;
        gap: 1rem;
        align-items: end;
    }
    .filter-group {
        flex: 1;
    }
    .filter-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: #333;
    }
    .filter-input {
        width: 100%;
        padding: 0.85rem;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        font-size: 1rem;
        transition: border 0.3s;
    }
    .filter-input:focus {
        outline: none;
        border-color: #ff9800;
    }
    .filter-btn {
        padding: 0.85rem 2rem;
        background: linear-gradient(135deg, #ff9800 0%, #ffc107 100%);
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }
    .filter-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255,152,0,0.3);
    }

    /* Resep Grid */
    .resep-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }
    .resep-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        transition: all 0.3s;
        text-decoration: none;
        color: inherit;
    }
    .resep-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(255,152,0,0.2);
    }
    .resep-img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        background: #f0f0f0;
    }
    .resep-body {
        padding: 1.5rem;
    }
    .resep-category {
        display: inline-block;
        padding: 0.4rem 1rem;
        background: linear-gradient(135deg, #ff9800 0%, #ffc107 100%);
        color: white;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 0.8rem;
    }
    .resep-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 0.5rem;
        line-height: 1.4;
    }
    .resep-desc {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 1rem;
        line-height: 1.6;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .resep-meta {
        display: flex;
        gap: 1.5rem;
        font-size: 0.9rem;
        color: #666;
        padding-top: 1rem;
        border-top: 1px solid #f0f0f0;
    }
    .resep-meta-item {
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }
    .resep-author {
        font-size: 0.85rem;
        color: #999;
        margin-top: 0.5rem;
    }

    /* CTA Section */
    .cta-section {
        background: linear-gradient(135deg, #ff9800 0%, #ffc107 100%);
        padding: 4rem 2rem;
        border-radius: 20px;
        text-align: center;
        color: white;
        margin: 4rem 0;
    }
    .cta-section h2 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }
    .cta-section p {
        font-size: 1.2rem;
        margin-bottom: 2rem;
        opacity: 0.9;
    }
    .cta-btn {
        padding: 1rem 3rem;
        background: white;
        color: #ff9800;
        border: none;
        border-radius: 50px;
        font-size: 1.1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }
    .cta-btn:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #999;
    }
    .empty-state h3 {
        font-size: 1.5rem;
        color: #666;
        margin-bottom: 0.5rem;
    }

    /* Pagination */
    .pagination {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 3rem;
    }
    .pagination a,
    .pagination span {
        padding: 0.7rem 1.3rem;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        text-decoration: none;
        color: #333;
        transition: all 0.3s;
        font-weight: 500;
    }
    .pagination a:hover {
        border-color: #ff9800;
        background: #fff8f0;
    }
    .pagination .active {
        background: linear-gradient(135deg, #ff9800 0%, #ffc107 100%);
        color: white;
        border-color: #ff9800;
    }
</style>
@endsection

@section('content')
<!-- Hero Carousel -->
<div class="hero-carousel">
    <div class="carousel-container" id="carouselContainer">
        @php
            $popularReseps = \App\Models\Resep::where('status', 'approved')
                ->withCount('sukas')
                ->orderBy('sukas_count', 'desc')
                ->take(5)
                ->get();
        @endphp

        @forelse($popularReseps as $resep)
        <div class="carousel-slide" style="background-image: url('{{ $resep->gambar ? asset('storage/' . $resep->gambar) : 'https://via.placeholder.com/1200x500/ff9800/ffffff?text=Dapur+Ceria' }}');">
            <div class="carousel-overlay">
                <h2>{{ $resep->judul }}</h2>
                <p>{{ Str::limit($resep->deskripsi, 150) }}</p>
                <a href="{{ route('resep.show', $resep->id) }}" class="cta-btn">Lihat Resep</a>
            </div>
        </div>
        @empty
        <div class="carousel-slide" style="background: linear-gradient(135deg, #ff9800 0%, #ffc107 100%);">
            <div class="carousel-overlay">
                <h2>🍳 Selamat Datang di Dapur Ceria!</h2>
                <p>Temukan berbagai resep masakan lezat dan mudah</p>
                <a href="{{ route('login') }}" class="cta-btn">Mulai Sekarang</a>
            </div>
        </div>
        @endforelse
    </div>

    @if($popularReseps->count() > 1)
    <button class="carousel-btn prev" onclick="moveCarousel(-1)">‹</button>
    <button class="carousel-btn next" onclick="moveCarousel(1)">›</button>
    <div class="carousel-controls" id="carouselDots"></div>
    @endif
</div>

<!-- Categories Section -->
<div class="section-header">
    <h2>🗂️ Kategori</h2>
    <p>Pilih kategori resep dan dapatkan list resep kesukaanmu</p>
</div>

<div class="categories-grid">
    @foreach($kategoris as $kategori)
    <a href="/?kategori={{ $kategori->id }}" class="category-card">
        <div class="category-icon">
            @switch($kategori->nama_kategori)
                @case('Makanan Utama')
                @case('Masakan Utama')
                    🍛
                    @break
                @case('Dessert')
                @case('Makanan Penutup')
                    🍰
                    @break
                @case('Minuman')
                    🥤
                    @break
                @case('Makanan Ringan')
                @case('Snack')
                    🍪
                    @break
                @case('Sarapan')
                    🍳
                    @break
                @default
                    🍴
            @endswitch
        </div>
        <div class="category-name">{{ $kategori->nama_kategori }}</div>
    </a>
    @endforeach
</div>

<!-- Filter Section -->
<div class="filter-section">
    <form action="{{ route('home') }}" method="GET" class="filter-row">
        <div class="filter-group">
            <label>Cari Resep</label>
            <input type="text" name="search" class="filter-input" placeholder="Cari resep favoritmu..." value="{{ request('search') }}">
        </div>
        <div class="filter-group">
            <label>Kategori</label>
            <select name="kategori" class="filter-input">
                <option value="">Semua Kategori</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="filter-btn">Filter</button>
    </form>
</div>

<!-- Resep Terbaru Section -->
<div class="section-header">
    <h2>🍽️ Resep Dapur Umami : Inspirasi Masakan Lezat dan Praktis</h2>
    <p>Berbagai ide masak baru hadir setiap hari untuk sajian spesial keluarga tercinta!</p>
</div>

@if($reseps->count() > 0)
<div class="resep-grid">
    @foreach($reseps as $resep)
    <a href="{{ route('resep.show', $resep->id) }}" class="resep-card">
        <img src="{{ $resep->gambar ? asset('storage/' . $resep->gambar) : 'https://via.placeholder.com/400x250/ff9800/ffffff?text=No+Image' }}" 
             alt="{{ $resep->judul }}" 
             class="resep-img">
        <div class="resep-body">
            <span class="resep-category">{{ $resep->kategori->nama_kategori }}</span>
            <h3 class="resep-title">{{ $resep->judul }}</h3>
            <p class="resep-desc">{{ Str::limit($resep->deskripsi, 100) }}</p>
            <div class="resep-meta">
                <div class="resep-meta-item">
                    <span>⏱️</span>
                    <span>{{ $resep->waktu_memasak }} menit</span>
                </div>
                <div class="resep-meta-item">
                    <span>🍽️</span>
                    <span>{{ $resep->porsi }} porsi</span>
                </div>
                <div class="resep-meta-item">
                    <span>⭐</span>
                    <span>{{ number_format($resep->averageRating(), 1) }}</span>
                </div>
            </div>
            <div class="resep-author">Oleh: {{ $resep->user->name }}</div>
        </div>
    </a>
    @endforeach
</div>

<!-- Pagination -->
<div class="pagination">
    @if ($reseps->onFirstPage())
        <span>&laquo;</span>
    @else
        <a href="{{ $reseps->previousPageUrl() }}">&laquo;</a>
    @endif

    @for ($i = 1; $i <= $reseps->lastPage(); $i++)
        @if ($i == $reseps->currentPage())
            <span class="active">{{ $i }}</span>
        @else
            <a href="{{ $reseps->url($i) }}">{{ $i }}</a>
        @endif
    @endfor

    @if ($reseps->hasMorePages())
        <a href="{{ $reseps->nextPageUrl() }}">&raquo;</a>
    @else
        <span>&raquo;</span>
    @endif
</div>
@else
<div class="empty-state">
    <h3>🔍 Tidak ada resep ditemukan</h3>
    <p>Coba kata kunci atau kategori lain</p>
</div>
@endif

<!-- CTA Section -->
@guest
<div class="cta-section">
    <h2>🎉 Ayo Upload Resep Andalanmu Sekarang</h2>
    <p>Mulai upload resep andalanmu di sini dan jadi inspirasi untuk Member Dapur Ceria yang lain.</p>
    <a href="{{ route('register') }}" class="cta-btn">Daftar Sekarang</a>
</div>
@else
<div class="cta-section">
    <h2>🎉 Punya Resep Andalan?</h2>
    <p>Bagikan resep favoritmu dan inspirasi ribuan pengguna lainnya!</p>
    <a href="{{ route('user.resep.create') }}" class="cta-btn">Upload Resep</a>
</div>
@endguest

<script>
// Carousel functionality
let currentSlide = 0;
const slides = document.querySelectorAll('.carousel-slide');
const totalSlides = slides.length;

if (totalSlides > 1) {
    // Create dots
    const dotsContainer = document.getElementById('carouselDots');
    for (let i = 0; i < totalSlides; i++) {
        const dot = document.createElement('div');
        dot.className = 'carousel-dot' + (i === 0 ? ' active' : '');
        dot.onclick = () => goToSlide(i);
        dotsContainer.appendChild(dot);
    }

    function updateCarousel() {
        const container = document.getElementById('carouselContainer');
        container.style.transform = `translateX(-${currentSlide * 100}%)`;
        
        // Update dots
        document.querySelectorAll('.carousel-dot').forEach((dot, index) => {
            dot.classList.toggle('active', index === currentSlide);
        });
    }

    function moveCarousel(direction) {
        currentSlide += direction;
        if (currentSlide < 0) currentSlide = totalSlides - 1;
        if (currentSlide >= totalSlides) currentSlide = 0;
        updateCarousel();
    }

    function goToSlide(index) {
        currentSlide = index;
        updateCarousel();
    }

    // Auto slide every 5 seconds
    setInterval(() => {
        moveCarousel(1);
    }, 5000);
}
</script>
@endsection