@extends('layouts.app')

@section('title', $resep->judul . ' - Dapur Ceria')

@section('styles')
<style>
    .detail-container {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .detail-header {
        position: relative;
    }
    .detail-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
        background: #f0f0f0;
    }
    .detail-content {
        padding: 2rem;
    }
    .kategori-badge {
        display: inline-block;
        padding: 0.5rem 1rem;
        background: #ff6b6b;
        color: rgb(255, 255, 255);
        border-radius: 20px;
        font-size: 0.875rem;
        margin-bottom: 1rem;
    }
    .detail-title {
        font-size: 2rem;
        margin-bottom: 1rem;
        color: #333;
    }
    .detail-meta {
        display: flex;
        gap: 2rem;
        margin-bottom: 2rem;
        padding-bottom: 2rem;
        border-bottom: 2px solid #f0f0f0;
    }
    .meta-item {
        display: flex;
        flex-direction: column;
    }
    .meta-label {
        font-size: 0.875rem;
        color: #666;
    }
    .meta-value {
        font-size: 1.25rem;
        font-weight: bold;
        color: #333;
    }
    .action-buttons {
        display: flex;
        gap: 1rem;
        margin: 1.5rem 0;
    }
    .section {
        margin-bottom: 2rem;
    }
    .section-title {
        font-size: 1.5rem;
        margin-bottom: 1rem;
        color: #333;
        border-left: 4px solid #ffd93d;
        padding-left: 1rem;
    }
    .video-container {
        position: relative;
        padding-bottom: 56.25%;
        height: 0;
        overflow: hidden;
        margin-bottom: 2rem;
        border-radius: 8px;
    }
    .video-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
    .rating-section {
        background: #f8f9fa;
        padding: 1.5rem;
        border-radius: 8px;
        margin-bottom: 2rem;
    }
    .rating-display {
        text-align: center;
        margin-bottom: 1rem;
    }
    .rating-number {
        font-size: 3rem;
        font-weight: bold;
        color: #ffd93d;
    }
    .stars {
        font-size: 2rem;
        color: #ffd43b;
    }
    .rating-form {
        text-align: center;
    }
    .rating-input {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
        flex-direction: row-reverse;
    }
    .rating-input input {
        display: none;
    }
    
    /* Style bintang default - tidak berwarna */
    .rating-input label {
        font-size: 2.5rem;
        cursor: pointer;
        color: #ddd;
        transition: transform 0.2s ease, color 0.3s ease;
        position: relative;
        order: 0;
    }
    
    /* Hover effect - scale sedikit */
    .rating-input label:hover {
        transform: scale(1.15);
    }
    
    /* Class untuk bintang yang ter-hover atau ter-select */
    .rating-input label.filled {
        color: #ffd93d;
    }
    
    .komentar-section {
        margin-top: 2rem;
    }
    .komentar-item {
        padding: 1rem;
        border: 1px solid #eee;
        border-radius: 8px;
        margin-bottom: 1rem;
    }
    .komentar-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.5rem;
    }
    .komentar-user {
        font-weight: bold;
        color: #333;
    }
    .komentar-date {
        font-size: 0.875rem;
        color: #999;
    }
    .form-group {
        margin-bottom: 1rem;
    }
    .form-control {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
    textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }
</style>
@endsection

@section('content')
<div class="detail-container">
    <!-- Header with Image -->
    <div class="detail-header">
        @if($resep->gambar)
            <img src="{{ asset('storage/' . $resep->gambar) }}" alt="{{ $resep->judul }}" class="detail-image">
        @else
            <div class="detail-image" style="display: flex; align-items: center; justify-content: center; font-size: 5rem;"><i class='bx bx-food-menu'></i></div>
        @endif
    </div>

    <div class="detail-content">
        <span class="kategori-badge">{{ $resep->kategori->nama_kategori }}</span>
        
        <h1 class="detail-title">{{ $resep->judul }}</h1>
        
        <p style="color: #666; font-size: 1.1rem; margin-bottom: 2rem;">{{ $resep->deskripsi }}</p>

        <!-- Meta Info -->
        <div class="detail-meta">
            <div class="meta-item">
                <span class="meta-label">Waktu Memasak</span>
                <span class="meta-value"><i class='bx bx-time'></i> {{ $resep->waktu_memasak }} menit</span>
            </div>
            <div class="meta-item">
                <span class="meta-label">Porsi</span>
                <span class="meta-value"><i class='bx bx-dish'></i> {{ $resep->porsi }} porsi</span>
            </div>
            <div class="meta-item">
                <span class="meta-label">Tingkat Kesulitan</span>
                <span class="meta-value">
                    @if($resep->tingkat_kesulitan == 'mudah')  Mudah
                    @elseif($resep->tingkat_kesulitan == 'sedang')  Sedang
                    @else  Sulit
                    @endif
                </span>
            </div>
            <div class="meta-item">
                <span class="meta-label">Rating</span>
                <span class="meta-value"><i class='bx bxs-star' style='color:#ffd93d'></i> {{ number_format($resep->averageRating(), 1) }}</span>
            </div>
            <div class="meta-item">
                <span class="meta-label">Disukai</span>
                <span class="meta-value"><i class='bx bxs-heart' style="color: red "></i> {{ $resep->totalSuka() }}</span>
            </div>
        </div>

        <div style="margin-bottom: 2rem; padding-bottom: 2rem; border-bottom: 2px solid #f0f0f0;">
            <p style="color: #999;">Dibuat oleh: <strong>{{ $resep->user->name }}</strong></p>
            <p style="color: #999;">{{ $resep->created_at->diffForHumans() }}</p>
        </div>

        <!-- Action Buttons -->
        @auth
        <div class="action-buttons">
            <form action="{{ route('suka.toggle', $resep->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn {{ $resep->isSukaBy(auth()->id()) ? 'btn-danger' : 'btn-secondary' }}">
                    {{ $resep->isSukaBy(auth()->id()) ? '❤️ Disukai' : '🤍 Suka' }}
                </button>
            </form>
            <form action="{{ route('favorit.toggle', $resep->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn {{ $resep->isFavoritBy(auth()->id()) ? 'btn-warning' : 'btn-secondary' }}">
                    {{ $resep->isFavoritBy(auth()->id()) ? '⭐ Difavoritkan' : '☆ Favorit' }}
                </button>
            </form>
        </div>
        @else
        <p style="background: #f8f9fa; padding: 1rem; border-radius: 5px; margin-bottom: 2rem;">
            <a href="{{ route('login') }}" style="color: #ffd93d; font-weight: bold;">Login</a> untuk menyukai, memfavoritkan, dan memberi rating resep ini.
        </p>
        @endauth

        <!-- Video (if available) -->
        @if($resep->video_url)
        <div class="section">
            <h2 class="section-title"><i class='bx bx-video'></i> Video Tutorial</h2>
            <div class="video-container">
                @php
                    $videoId = '';
                    if (strpos($resep->video_url, 'youtube.com') !== false) {
                        parse_str(parse_url($resep->video_url, PHP_URL_QUERY), $params);
                        $videoId = $params['v'] ?? '';
                    } elseif (strpos($resep->video_url, 'youtu.be') !== false) {
                        $videoId = basename(parse_url($resep->video_url, PHP_URL_PATH));
                    }
                @endphp
                @if($videoId)
                    <iframe src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allowfullscreen></iframe>
                @else
                    <a href="{{ $resep->video_url }}" target="_blank" class="btn btn-primary">Tonton Video</a>
                @endif
            </div>
        </div>
        @endif

        <!-- Bahan-bahan -->
        <div class="section">
            <h2 class="section-title"><i class='bx bx-bowl-hot'></i> Bahan-bahan</h2>
            <div style="white-space: pre-line; line-height: 1.8;">{{ $resep->bahan }}</div>
        </div>

        <!-- Langkah-langkah -->
        <div class="section">
            <h2 class="section-title"><i class='bx bx-detail'></i> Langkah-langkah</h2>
            <div style="white-space: pre-line; line-height: 1.8;">{{ $resep->langkah_langkah }}</div>
        </div>

        <!-- Rating Section -->
        <div class="rating-section">
            <h2 class="section-title"><i class='bx bxs-star' style='color:#ffd93d'></i> Rating & Ulasan</h2>
            <div class="rating-display">
                <div class="rating-number">{{ number_format($resep->averageRating(), 1) }}</div>
                <div class="stars">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= round($resep->averageRating()))
                            <i class='bx bxs-star' style='color:#ffd93d'></i>
                        @else
                            <i class='bx bx-star' style='color:#ffd93d'></i>
                        @endif
                    @endfor
                </div>
                <p>{{ $resep->ratings->count() }} rating</p>
            </div>

            @auth
                @php
                    $userRating = $resep->ratings()->where('id_user', auth()->id())->first();
                @endphp
                <div class="rating-form">
                    <p><strong>Berikan rating Anda:</strong></p>
                    <form action="{{ route('rating.store', $resep->id) }}" method="POST" id="rating-form">
                        @csrf
                        <div class="rating-input" id="star-rating-container">
                            @for($i = 1; $i <= 5; $i++)
                                <input type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}" {{ $userRating && $userRating->rating == $i ? 'checked' : '' }} required>
                                <label for="star{{ $i }}" data-value="{{ $i }}" style="order: {{ 6 - $i }}">
                                    <i class='bx bxs-star'></i>
                                </label>
                            @endfor
                        </div>
                        <button type="submit" class="btn btn-primary">
                            {{ $userRating ? 'Update Rating' : 'Beri Rating' }}
                        </button>
                    </form>
                </div>
            @endauth
        </div>

        <!-- Komentar Section -->
        <div class="komentar-section">
            <h2 class="section-title"><i class='bx bx-message-dots'></i> Komentar ({{ $resep->totalKomentar() }})</h2>

            @auth
            <form action="{{ route('komentar.store', $resep->id) }}" method="POST" style="margin-bottom: 2rem;">
                @csrf
                <div class="form-group">
                    <textarea name="isi_komentar" class="form-control" placeholder="Tulis komentar Anda..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kirim Komentar</button>
            </form>
            @else
            <p style="background: #f8f9fa; padding: 1rem; border-radius: 5px; margin-bottom: 2rem;">
                <a href="{{ route('login') }}" style="color: #ffd93d; font-weight: bold;">Login</a> untuk berkomentar.
            </p>
            @endauth

            <!-- List Komentar -->
            @forelse($resep->komentars()->latest()->get() as $komentar)
            <div class="komentar-item">
                <div class="komentar-header">
                    <span class="komentar-user">{{ $komentar->user->name }}</span>
                    <span class="komentar-date">{{ $komentar->created_at->diffForHumans() }}</span>
                </div>
                <p style="margin: 0;">{{ $komentar->isi_komentar }}</p>
            </div>
            @empty
            <p style="text-align: center; color: #999; padding: 2rem;">Belum ada komentar. Jadilah yang pertama!</p>
            @endforelse
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('star-rating-container');
    const stars = document.querySelectorAll('.rating-input label');
    const inputs = document.querySelectorAll('.rating-input input');
    let selectedValue = 0;
    
    // Buat array bintang terurut dari kiri ke kanan (1,2,3,4,5)
    const starsArray = Array.from(stars).sort((a, b) => {
        return parseInt(a.dataset.value) - parseInt(b.dataset.value);
    });
    
    // Cek apakah sudah ada rating sebelumnya
    inputs.forEach(input => {
        if (input.checked) {
            selectedValue = parseInt(input.value);
            fillStars(selectedValue, true);
        }
    });
    
    // Event hover untuk setiap bintang
    stars.forEach((star) => {
        star.addEventListener('mouseenter', function() {
            const value = parseInt(this.dataset.value);
            fillStars(value, false);
        });
        
        // Event click untuk select rating
        star.addEventListener('click', function() {
            const value = parseInt(this.dataset.value);
            
            // Kalau klik bintang yang sama dengan yang sudah dipilih = reset/cancel rating
            if (selectedValue === value) {
                selectedValue = 0;
                clearStars();
                // Uncheck semua input
                inputs.forEach(inp => inp.checked = false);
            } else {
                selectedValue = value;
                // Check input radio yang sesuai
                const input = document.getElementById('star' + value);
                if (input) {
                    input.checked = true;
                }
                fillStars(value, true);
            }
        });
    });
    
    // Event ketika mouse keluar dari container
    container.addEventListener('mouseleave', function() {
        // Kalau belum ada yang dipilih, reset semua
        if (selectedValue === 0) {
            clearStars();
        } else {
            // Kalau sudah ada yang dipilih, tampilkan yang dipilih tanpa animasi
            fillStars(selectedValue, true);
        }
    });
    
    // Fungsi untuk mengisi bintang dengan animasi dari kiri ke kanan
    function fillStars(count, instant = false) {
        starsArray.forEach((star, index) => {
            const starValue = parseInt(star.dataset.value);
            
            if (starValue <= count) {
                if (instant) {
                    // Langsung tanpa animasi (untuk restore state)
                    star.classList.add('filled');
                } else {
                    // Dengan delay animasi dari kiri ke kanan (index 0 = bintang 1)
                    setTimeout(() => {
                        star.classList.add('filled');
                    }, index * 80); // Delay 80ms per bintang dari kiri
                }
            } else {
                star.classList.remove('filled');
            }
        });
    }
    
    // Fungsi untuk clear semua bintang
    function clearStars() {
        stars.forEach(star => {
            star.classList.remove('filled');
        });
    }
    
    // Validasi sebelum submit - pastikan ada rating yang dipilih
    const form = document.getElementById('rating-form');
    form.addEventListener('submit', function(e) {
        if (selectedValue === 0) {
            e.preventDefault();
            alert('Silakan pilih rating terlebih dahulu!');
        }
    });
});
</script>
@endsection