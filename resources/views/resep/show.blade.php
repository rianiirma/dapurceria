@extends('layouts.app')
@section('title', $resep->judul . ' - DapurCeria')

@push('styles')
<style>
    body { background: #FDF6EC; }

    /* ── HERO IMAGE ── */
    .detail-hero {
        width: 100%;
        height: 340px;
        position: relative;
        overflow: hidden;
        background: #F0E8DC;
    }

    .detail-hero img {
        width: 100%; height: 100%;
        object-fit: cover;
    }

    .detail-hero-fallback {
        width: 100%; height: 100%;
        display: flex; align-items: center; justify-content: center;
        font-size: 72px;
        background: linear-gradient(135deg, #FFB870, #E05010);
    }

    .detail-hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(61,32,16,.7) 0%, transparent 50%);
    }

    .detail-hero-badge {
        position: absolute;
        top: 16px; left: 16px;
        background: #E8621A;
        color: #fff;
        font-size: 11px; font-weight: 700;
        padding: 5px 14px;
        border-radius: 14px;
        letter-spacing: .3px;
    }

    .detail-hero-back {
        position: absolute;
        top: 16px; right: 16px;
        background: rgba(255,255,255,.2);
        backdrop-filter: blur(8px);
        color: #fff;
        border: none;
        width: 36px; height: 36px;
        border-radius: 50%;
        font-size: 18px;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer;
        text-decoration: none;
        transition: background .2s;
    }

    .detail-hero-back:hover { background: rgba(255,255,255,.35); }

    /* ── MAIN CARD ── */
    .detail-card {
        background: #FFFBF5;
        border-radius: 24px 24px 0 0;
        margin-top: -24px;
        position: relative;
        z-index: 2;
        padding: 28px 20px 0;
        min-height: 80vh;
    }

    /* ── TITLE AREA ── */
    .detail-title {
        font-family: 'Playfair Display', serif;
        font-size: 24px;
        line-height: 1.3;
        color: #3D2010;
        margin-bottom: 8px;
    }

    .detail-author-row {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 20px;
    }

    .author-avatar {
        width: 28px; height: 28px;
        border-radius: 50%;
        background: #E8621A;
        color: #fff;
        font-size: 11px; font-weight: 700;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }

    .author-name {
        font-size: 13px;
        color: #9A8070;
        font-weight: 500;
    }

    .author-time {
        font-size: 12px;
        color: #C0A090;
        margin-left: auto;
    }

    /* ── STATS ROW ── */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
        margin-bottom: 20px;
    }

    .stat-chip {
        background: #F5EDE3;
        border-radius: 12px;
        padding: 10px 8px;
        text-align: center;
    }

    .stat-chip-icon { font-size: 18px; }

    .stat-chip-val {
        font-size: 13px;
        font-weight: 700;
        color: #3D2010;
        margin-top: 3px;
    }

    .stat-chip-lbl {
        font-size: 10px;
        color: #9A8070;
        margin-top: 1px;
    }

    /* difficulty badge */
    .diff-badge {
        display: inline-block;
        font-size: 10px;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 10px;
    }

    .diff-mudah  { background: #D4F0E0; color: #1A6B3A; }
    .diff-sedang { background: #FEF3C0; color: #856404; }
    .diff-sulit  { background: #FDDEDE; color: #8B1A1A; }

    /* ── DESCRIPTION ── */
    .detail-desc {
        font-size: 14px;
        color: #7A6050;
        line-height: 1.7;
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #EDE3D8;
    }

    /* ── ACTION BUTTONS ── */
    .action-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-bottom: 24px;
    }

    .action-btn {
        padding: 12px;
        border-radius: 14px;
        border: 1.5px solid #E0D0C0;
        background: #fff;
        font-size: 13px;
        font-weight: 600;
        font-family: inherit;
        color: #7A3D1A;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all .2s;
        width: 100%;
    }

    .action-btn:hover { background: #FEF0E6; border-color: #E8621A; }

    .action-btn.active-suka  { background: #FDDEDE; border-color: #C62828; color: #8B1A1A; }
    .action-btn.active-favorit { background: #FEF3C0; border-color: #B08010; color: #856404; }

    .login-notice {
        background: #FDE8D0;
        border-radius: 14px;
        padding: 14px 16px;
        font-size: 13px;
        color: #7A3D1A;
        margin-bottom: 24px;
        text-align: center;
        line-height: 1.6;
    }

    .login-notice a {
        color: #E8621A;
        font-weight: 700;
        text-decoration: none;
    }

    /* ── SECTION BLOCKS ── */
    .section-block {
        margin-bottom: 28px;
    }

    .section-block-title {
        font-family: 'Playfair Display', serif;
        font-size: 18px;
        color: #3D2010;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-block-title::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #EDE3D8;
    }

    /* ── VIDEO ── */
    .video-wrap {
        position: relative;
        padding-bottom: 56.25%;
        height: 0;
        overflow: hidden;
        border-radius: 16px;
        margin-bottom: 4px;
    }

    .video-wrap iframe {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        border: none;
    }

    /* ── BAHAN ── */
    .bahan-card {
        background: #fff;
        border: 1px solid #EDE3D8;
        border-radius: 14px;
        padding: 16px 18px;
    }

    .bahan-text {
        font-size: 13px;
        color: #5A3A20;
        line-height: 2;
        white-space: pre-line;
    }

    /* ── LANGKAH ── */
    .langkah-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .langkah-item {
        background: #fff;
        border: 1px solid #EDE3D8;
        border-radius: 14px;
        padding: 14px 16px;
        display: flex;
        gap: 14px;
        align-items: flex-start;
    }

    .langkah-num {
        width: 28px; height: 28px;
        border-radius: 50%;
        background: #E8621A;
        color: #fff;
        font-size: 12px;
        font-weight: 700;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        margin-top: 1px;
    }

    .langkah-text {
        font-size: 13px;
        color: #5A3A20;
        line-height: 1.7;
        flex: 1;
    }

    /* ── RATING SECTION ── */
    .rating-card {
        background: #fff;
        border: 1px solid #EDE3D8;
        border-radius: 16px;
        padding: 20px;
    }

    .rating-summary {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 20px;
        padding-bottom: 16px;
        border-bottom: 1px solid #EDE3D8;
    }

    .rating-big {
        font-family: 'Playfair Display', serif;
        font-size: 44px;
        font-weight: 700;
        color: #3D2010;
        line-height: 1;
    }

    .rating-stars-display { font-size: 18px; color: #F0C840; margin-bottom: 4px; }
    .rating-count { font-size: 12px; color: #9A8070; }

    /* star input */
    .star-input-row {
        display: flex;
        gap: 8px;
        margin-bottom: 14px;
        justify-content: center;
    }

    .star-input-row input { display: none; }

    .star-label {
        font-size: 32px;
        cursor: pointer;
        color: #E0D0C0;
        transition: color .2s, transform .15s;
        line-height: 1;
    }

    .star-label:hover,
    .star-label.filled { color: #F0C840; }

    .star-label:hover { transform: scale(1.15); }

    .rating-submit {
        width: 100%;
        padding: 11px;
        background: #E8621A;
        color: #fff;
        border: none;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 700;
        font-family: inherit;
        cursor: pointer;
        transition: background .2s;
    }

    .rating-submit:hover { background: #C84E0E; }

    /* ── KOMENTAR ── */
    .komentar-input-wrap {
        background: #fff;
        border: 1.5px solid #E0D0C0;
        border-radius: 14px;
        overflow: hidden;
        margin-bottom: 16px;
    }

    .komentar-textarea {
        width: 100%;
        padding: 14px 16px;
        border: none;
        outline: none;
        font-size: 13px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #3D2010;
        background: transparent;
        resize: none;
        min-height: 90px;
    }

    .komentar-textarea::placeholder { color: #C0A090; }

    .komentar-submit {
        width: 100%;
        padding: 11px;
        background: #E8621A;
        color: #fff;
        border: none;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 700;
        font-family: inherit;
        cursor: pointer;
        margin-bottom: 20px;
        transition: background .2s;
    }

    .komentar-submit:hover { background: #C84E0E; }

    .komentar-item {
        background: #fff;
        border: 1px solid #EDE3D8;
        border-radius: 14px;
        padding: 14px 16px;
        margin-bottom: 10px;
    }

    .komentar-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 8px;
    }

    .komentar-avatar {
        width: 30px; height: 30px;
        border-radius: 50%;
        background: #E8621A;
        color: #fff;
        font-size: 11px; font-weight: 700;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }

    .komentar-name {
        font-size: 13px;
        font-weight: 600;
        color: #3D2010;
    }

    .komentar-time {
        font-size: 11px;
        color: #C0A090;
        margin-left: auto;
    }

    .komentar-isi {
        font-size: 13px;
        color: #7A6050;
        line-height: 1.6;
        margin: 0;
    }

    .empty-komentar {
        text-align: center;
        padding: 32px 0;
        color: #C0A090;
        font-size: 13px;
    }

    .empty-komentar-icon { font-size: 36px; margin-bottom: 8px; }

    /* ── RESPONSIVE ── */
    @media (min-width: 640px) {
        .detail-card { padding: 32px 32px 0; max-width: 720px; margin: -24px auto 0; }
        .detail-hero { height: 420px; }
    }
</style>
@endpush

@section('content')

{{-- HERO --}}
<div class="detail-hero">
    @if($resep->gambar)
        <img src="{{ asset('storage/' . $resep->gambar) }}" alt="{{ $resep->judul }}" loading="eager">
    @else
        <div class="detail-hero-fallback">🍳</div>
    @endif
    <div class="detail-hero-overlay"></div>
    <span class="detail-hero-badge">{{ $resep->kategori->nama_kategori }}</span>
    <a href="{{ url()->previous() }}" class="detail-hero-back">←</a>
</div>

{{-- MAIN CARD --}}
<div class="detail-card">

    {{-- Title --}}
    <h1 class="detail-title">{{ $resep->judul }}</h1>

    {{-- Author row --}}
    <div class="detail-author-row">
        <div class="author-avatar">{{ strtoupper(substr($resep->user->name, 0, 2)) }}</div>
        <span class="author-name">{{ $resep->user->name }}</span>
        <span class="author-time">{{ $resep->created_at->diffForHumans() }}</span>
    </div>

    {{-- Stats --}}
    <div class="stats-row">
        <div class="stat-chip">
            <div class="stat-chip-icon">⏱</div>
            <div class="stat-chip-val">{{ $resep->waktu_memasak }}</div>
            <div class="stat-chip-lbl">Menit</div>
        </div>
        <div class="stat-chip">
            <div class="stat-chip-icon">🍽</div>
            <div class="stat-chip-val">{{ $resep->porsi }}</div>
            <div class="stat-chip-lbl">Porsi</div>
        </div>
        <div class="stat-chip">
            <div class="stat-chip-icon">⭐</div>
            <div class="stat-chip-val">{{ number_format($resep->averageRating(), 1) }}</div>
            <div class="stat-chip-lbl">Rating</div>
        </div>
        <div class="stat-chip">
            <div class="stat-chip-icon">❤️</div>
            <div class="stat-chip-val">{{ $resep->totalSuka() }}</div>
            <div class="stat-chip-lbl">Suka</div>
        </div>
    </div>

    {{-- Difficulty --}}
    <div style="margin-bottom:16px;">
        @php $d = $resep->tingkat_kesulitan; @endphp
        <span class="diff-badge diff-{{ $d }}">
            {{ $d === 'mudah' ? '✓ Mudah' : ($d === 'sedang' ? '~ Sedang' : '↑ Sulit') }}
        </span>
    </div>

    {{-- Description --}}
    <p class="detail-desc">{{ $resep->deskripsi }}</p>

    {{-- Action Buttons --}}
    @auth
    <div class="action-row">
        <form action="{{ route('suka.toggle', $resep->id) }}" method="POST">
            @csrf
            <button type="submit" class="action-btn {{ $resep->isSukaBy(auth()->id()) ? 'active-suka' : '' }}">
                {{ $resep->isSukaBy(auth()->id()) ? '❤️ Disukai' : '🤍 Suka' }}
            </button>
        </form>
        <form action="{{ route('favorit.toggle', $resep->id) }}" method="POST">
            @csrf
            <button type="submit" class="action-btn {{ $resep->isFavoritBy(auth()->id()) ? 'active-favorit' : '' }}">
                {{ $resep->isFavoritBy(auth()->id()) ? '⭐ Favorit' : '☆ Favorit' }}
            </button>
        </form>
    </div>
    @else
    <div class="login-notice">
        <a href="{{ route('login') }}">Login</a> untuk menyukai, menyimpan favorit, memberi rating & berkomentar
    </div>
    @endauth

    {{-- Video --}}
    @if($resep->video_url)
    <div class="section-block">
        <div class="section-block-title">🎬 Video Tutorial</div>
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
            <div class="video-wrap">
                <iframe src="https://www.youtube.com/embed/{{ $videoId }}"
                        allowfullscreen loading="lazy"></iframe>
            </div>
        @else
            <a href="{{ $resep->video_url }}" target="_blank" class="action-btn" style="display:inline-flex;">
                ▶ Tonton Video
            </a>
        @endif
    </div>
    @endif

    {{-- Bahan-bahan --}}
    <div class="section-block">
        <div class="section-block-title">🛒 Bahan-bahan</div>
        <div class="bahan-card">
            @php
                $bahanLines = array_filter(array_map('trim', explode("\n", $resep->bahan)));
            @endphp
            @if(count($bahanLines))
                <ul style="margin:0;padding-left:18px;list-style:disc;">
                    @foreach($bahanLines as $bahan)
                        @if(trim($bahan))
                            <li class="bahan-text" style="padding:2px 0;">{{ trim($bahan, '-• ') }}</li>
                        @endif
                    @endforeach
                </ul>
            @else
                <p class="bahan-text">{{ $resep->bahan }}</p>
            @endif
        </div>
    </div>

    {{-- Langkah-langkah --}}
    <div class="section-block">
        <div class="section-block-title">👨‍🍳 Langkah Memasak</div>
        <div class="langkah-list">
            @php
                $langkahLines = array_values(array_filter(
                    array_map('trim', explode("\n", $resep->langkah_langkah))
                ));
                $step = 1;
            @endphp
            @foreach($langkahLines as $langkah)
                @if(trim($langkah))
                    @php $clean = preg_replace('/^[\d]+[\.\)]\s*/', '', trim($langkah)); @endphp
                    <div class="langkah-item">
                        <div class="langkah-num">{{ $step }}</div>
                        <p class="langkah-text">{{ $clean }}</p>
                    </div>
                    @php $step++; @endphp
                @endif
            @endforeach
        </div>
    </div>

    {{-- Rating --}}
    <div class="section-block">
        <div class="section-block-title">⭐ Rating & Ulasan</div>
        <div class="rating-card">
            <div class="rating-summary">
                <div class="rating-big">{{ number_format($resep->averageRating(), 1) }}</div>
                <div>
                    <div class="rating-stars-display">
                        @for($i = 1; $i <= 5; $i++)
                            {{ $i <= round($resep->averageRating()) ? '★' : '☆' }}
                        @endfor
                    </div>
                    <div class="rating-count">{{ $resep->ratings->count() }} ulasan</div>
                </div>
            </div>

            @auth
                @php $userRating = $resep->ratings()->where('id_user', auth()->id())->first(); @endphp
                <p style="text-align:center;font-size:13px;font-weight:600;color:#7A3D1A;margin-bottom:10px;">
                    {{ $userRating ? 'Update rating kamu:' : 'Berikan rating kamu:' }}
                </p>
                <form action="{{ route('rating.store', $resep->id) }}" method="POST" id="ratingForm">
                    @csrf
                    <div class="star-input-row" id="starContainer">
                        @for($i = 1; $i <= 5; $i++)
                            <input type="radio" name="rating" id="s{{ $i }}" value="{{ $i }}"
                                {{ $userRating && $userRating->rating == $i ? 'checked' : '' }}>
                            <label class="star-label {{ ($userRating && $userRating->rating >= $i) ? 'filled' : '' }}"
                                   for="s{{ $i }}" data-val="{{ $i }}">★</label>
                        @endfor
                    </div>
                    <button type="submit" class="rating-submit">
                        {{ $userRating ? 'Update Rating' : 'Beri Rating' }}
                    </button>
                </form>
            @else
                <p style="text-align:center;font-size:13px;color:#9A8070;">
                    <a href="{{ route('login') }}" style="color:#E8621A;font-weight:700;">Login</a> untuk memberi rating
                </p>
            @endauth
        </div>
    </div>

    {{-- Komentar --}}
    <div class="section-block" style="padding-bottom:40px;">
        <div class="section-block-title">💬 Komentar ({{ $resep->totalKomentar() }})</div>

        @auth
        <form action="{{ route('komentar.store', $resep->id) }}" method="POST">
            @csrf
            <div class="komentar-input-wrap">
                <textarea name="isi_komentar" class="komentar-textarea"
                          placeholder="Bagikan pengalamanmu memasak resep ini..." required></textarea>
            </div>
            <button type="submit" class="komentar-submit">Kirim Komentar</button>
        </form>
        @else
        <div class="login-notice" style="margin-bottom:20px;">
            <a href="{{ route('login') }}">Login</a> untuk ikut berkomentar
        </div>
        @endauth

        {{-- List komentar --}}
        @forelse($resep->komentars()->with('user')->latest()->get() as $k)
        <div class="komentar-item">
            <div class="komentar-header">
                <div class="komentar-avatar">{{ strtoupper(substr($k->user->name, 0, 2)) }}</div>
                <span class="komentar-name">{{ $k->user->name }}</span>
                <span class="komentar-time">{{ $k->created_at->diffForHumans() }}</span>
            </div>
            <p class="komentar-isi">{{ $k->isi_komentar }}</p>
        </div>
        @empty
        <div class="empty-komentar">
            <div class="empty-komentar-icon">💬</div>
            <p>Belum ada komentar. Jadilah yang pertama!</p>
        </div>
        @endforelse
    </div>

</div>{{-- /detail-card --}}

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const labels = document.querySelectorAll('.star-label');
    const inputs = document.querySelectorAll('#ratingForm input[type=radio]');
    if (!labels.length) return;

    let selected = 0;

    // Init dari checked
    inputs.forEach(inp => { if (inp.checked) selected = parseInt(inp.value); });

    labels.forEach((lbl, idx) => {
        const val = parseInt(lbl.dataset.val);

        lbl.addEventListener('mouseenter', () => paint(val, false));
        lbl.addEventListener('mouseleave', () => paint(selected, false));
        lbl.addEventListener('click', () => {
            selected = (selected === val) ? 0 : val;
            inputs.forEach(inp => { inp.checked = parseInt(inp.value) === selected; });
            paint(selected, false);
        });
    });

    function paint(count, _) {
        labels.forEach(lbl => {
            lbl.classList.toggle('filled', parseInt(lbl.dataset.val) <= count);
        });
    }

    document.getElementById('ratingForm').addEventListener('submit', function (e) {
        if (selected === 0) { e.preventDefault(); alert('Pilih rating dulu ya!'); }
    });
});
</script>
@endpush

@endsection