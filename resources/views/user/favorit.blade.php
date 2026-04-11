@extends('layouts.app')

@section('title', 'Favorit Saya - Dapur Ceria')

@push('styles')
<style>
    /* ===== PAGE WRAPPER ===== */
    .fav-wrap {
        max-width: 1100px;
        margin: 0 auto;
        padding: 36px 20px 60px;
    }

    /* ===== PAGE HEADER ===== */
    .fav-page-header {
        margin-bottom: 28px;
    }
    .fav-page-header h1 {
        font-size: 26px;
        font-weight: 700;
        color: #3D2010;
        margin-bottom: 4px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .fav-page-header h1 span {
        color: #D4622A;
    }
    .fav-page-header p {
        font-size: 14px;
        color: #9C7A60;
    }
    .fav-count-badge {
        background: #FEF0E6;
        color: #D4622A;
        border: 1px solid #F5C9A8;
        border-radius: 20px;
        padding: 3px 12px;
        font-size: 12px;
        font-weight: 600;
        margin-left: 4px;
    }

    /* ===== GRID ===== */
    .fav-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
    }

    /* ===== CARD ===== */
    .fav-card {
        background: #fff;
        border: 1px solid #E8D5C0;
        border-radius: 16px;
        overflow: hidden;
        transition: transform 0.2s, box-shadow 0.2s;
        position: relative;
        display: flex;
        flex-direction: column;
    }
    .fav-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(44, 26, 14, 0.12);
    }

    /* Remove button */
    .fav-remove-form {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 10;
    }
    .fav-remove-btn {
        width: 32px;
        height: 32px;
        background: rgba(255,255,255,0.92);
        border: 1px solid #E8D5C0;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        transition: background 0.15s, transform 0.15s;
        padding: 0;
        line-height: 1;
    }
    .fav-remove-btn:hover {
        background: #FDEDEC;
        border-color: #F5B7B1;
        transform: scale(1.1);
    }

    /* Image area */
    .fav-img-wrap {
        width: 100%;
        height: 180px;
        background: linear-gradient(135deg, #E8824A, #C45A20);
        overflow: hidden;
        position: relative;
        flex-shrink: 0;
    }
    .fav-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .fav-img-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 52px;
    }
    .fav-img-wrap.cat-minuman  { background: linear-gradient(135deg, #4A7AB0, #2D5A8A); }
    .fav-img-wrap.cat-dessert  { background: linear-gradient(135deg, #8A5AB0, #5A2D8A); }
    .fav-img-wrap.cat-sarapan  { background: linear-gradient(135deg, #E8A040, #C07820); }
    .fav-img-wrap.cat-camilan  { background: linear-gradient(135deg, #4A9A5A, #2D6B3A); }
    .fav-img-wrap.cat-malam    { background: linear-gradient(135deg, #C45A20, #8A3A10); }

    /* Category badge over image */
    .fav-cat-badge {
        position: absolute;
        bottom: 10px;
        left: 10px;
        background: rgba(0,0,0,0.55);
        color: #fff;
        font-size: 10px;
        font-weight: 600;
        padding: 3px 10px;
        border-radius: 12px;
        backdrop-filter: blur(4px);
        letter-spacing: 0.3px;
    }

    /* Body */
    .fav-body {
        padding: 16px;
        flex: 1;
        display: flex;
        flex-direction: column;
        text-decoration: none;
        color: inherit;
    }
    .fav-title {
        font-size: 15px;
        font-weight: 700;
        color: #3D2010;
        line-height: 1.4;
        margin-bottom: 6px;
    }
    .fav-desc {
        font-size: 12px;
        color: #9C7A60;
        line-height: 1.6;
        margin-bottom: 12px;
        flex: 1;
    }
    .fav-meta {
        display: flex;
        gap: 12px;
        font-size: 11px;
        color: #9C7A60;
        padding-top: 10px;
        border-top: 1px solid #F0E0D0;
        align-items: center;
        flex-wrap: wrap;
    }
    .fav-meta-item {
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .fav-rating {
        display: flex;
        align-items: center;
        gap: 4px;
        color: #D4622A;
        font-weight: 600;
    }
    .fav-author {
        margin-top: 8px;
        font-size: 11px;
        color: #B8956A;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .fav-author-av {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #D4622A;
        color: white;
        font-size: 9px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    /* ===== EMPTY STATE ===== */
    .fav-empty {
        text-align: center;
        padding: 72px 20px;
        background: #fff;
        border: 1px solid #E8D5C0;
        border-radius: 20px;
    }
    .fav-empty-icon {
        font-size: 56px;
        margin-bottom: 16px;
        opacity: 0.5;
    }
    .fav-empty h3 {
        font-size: 20px;
        font-weight: 700;
        color: #3D2010;
        margin-bottom: 8px;
    }
    .fav-empty p {
        font-size: 14px;
        color: #9C7A60;
        margin-bottom: 22px;
    }
    .btn-orange {
        display: inline-block;
        background: #D4622A;
        color: #fff;
        padding: 11px 24px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
        transition: background 0.15s;
    }
    .btn-orange:hover {
        background: #BF5522;
        color: #fff;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 600px) {
        .fav-grid {
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }
        .fav-img-wrap { height: 120px; }
        .fav-img-placeholder { font-size: 36px; }
        .fav-title { font-size: 12px; }
        .fav-desc { display: none; }
    }
    @media (max-width: 380px) {
        .fav-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
<div class="fav-wrap">

    {{-- PAGE HEADER --}}
    <div class="fav-page-header">
        <h1>
            ❤️ Resep <span>Favorit</span> Saya
            @if($favorits->count() > 0)
                <span class="fav-count-badge">{{ $favorits->count() }} resep</span>
            @endif
        </h1>
        <p>Resep-resep pilihan yang kamu simpan</p>
    </div>

    @if($favorits->count() > 0)
        <div class="fav-grid">
            @foreach($favorits as $favorit)
                @php
                    $resep = $favorit->resep;
                    $namaKat = strtolower($resep->kategori->nama_kategori ?? '');
                    $catClass = '';
                    if (str_contains($namaKat, 'minum'))  $catClass = 'cat-minuman';
                    elseif (str_contains($namaKat, 'des')) $catClass = 'cat-dessert';
                    elseif (str_contains($namaKat, 'sara')) $catClass = 'cat-sarapan';
                    elseif (str_contains($namaKat, 'camil')) $catClass = 'cat-camilan';
                    elseif (str_contains($namaKat, 'malam')) $catClass = 'cat-malam';
                    $emojis = ['🍛','🥗','🍜','🍲','🥘','🍳','🧆','🍱'];
                    $emoji  = $emojis[$resep->id % count($emojis)];
                @endphp

                <div class="fav-card">
                    {{-- REMOVE BUTTON --}}
                    <form action="{{ route('favorit.toggle', $resep->id) }}" method="POST" class="fav-remove-form">
                        @csrf
                        <button type="submit" class="fav-remove-btn" title="Hapus dari favorit">✕</button>
                    </form>

                    {{-- IMAGE --}}
                    <a href="{{ route('resep.show', $resep->id) }}" style="text-decoration:none;">
                        <div class="fav-img-wrap {{ $catClass }}">
                            @if($resep->gambar)
                                <img src="{{ asset('storage/' . $resep->gambar) }}"
                                     alt="{{ $resep->judul }}"
                                     onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                                <div class="fav-img-placeholder" style="display:none;">{{ $emoji }}</div>
                            @else
                                <div class="fav-img-placeholder">{{ $emoji }}</div>
                            @endif
                            <span class="fav-cat-badge">{{ $resep->kategori->nama_kategori ?? 'Resep' }}</span>
                        </div>
                    </a>

                    {{-- BODY --}}
                    <a href="{{ route('resep.show', $resep->id) }}" class="fav-body">
                        <div class="fav-title">{{ $resep->judul }}</div>
                        <div class="fav-desc">{{ Str::limit($resep->deskripsi, 80) }}</div>

                        <div class="fav-meta">
                            <span class="fav-meta-item">⏱ {{ $resep->waktu_memasak }} mnt</span>
                            <span class="fav-meta-item">🍽 {{ $resep->porsi }} porsi</span>
                            <span class="fav-rating">★ {{ number_format($resep->averageRating(), 1) }}</span>
                        </div>

                        <div class="fav-author">
                            <div class="fav-author-av">
                                {{ strtoupper(substr($resep->user->name ?? '?', 0, 2)) }}
                            </div>
                            {{ $resep->user->name ?? 'Anonim' }}
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    @else
        <div class="fav-empty">
            <div class="fav-empty-icon">💔</div>
            <h3>Belum ada resep favorit</h3>
            <p>Jelajahi resep dan tekan ❤️ untuk menyimpan<br>resep yang kamu suka ke sini.</p>
            <a href="{{ route('home') }}" class="btn-orange">Jelajahi Resep</a>
        </div>
    @endif

</div>
@endsection