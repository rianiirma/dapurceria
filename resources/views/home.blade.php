@extends('layouts.app')
@section('title', 'DapurCeria - Masak Lebih Ceria, Setiap Hari')

@push('styles')
<style>
    body { background: #FDF6EC; }

    /* ══ HERO ══ */
    .hero {
        background: #FFFBF5;
        padding: 56px 0 48px;
        border-bottom: 1px solid #EDE3D8;
        overflow: hidden;
        position: relative;
    }
    .hero::before {
        content: '';
        position: absolute;
        width: 400px; height: 400px;
        border-radius: 50%;
        background: rgba(232,98,26,.06);
        top: -100px; right: -80px;
        pointer-events: none;
    }
    .hero-inner {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 24px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 48px;
        align-items: center;
    }
    .hero-tag {
        display: inline-flex;
        align-items: center; gap: 6px;
        background: #FDE8D0; color: #B8440E;
        font-size: 12px; font-weight: 700;
        padding: 5px 14px; border-radius: 20px;
        margin-bottom: 18px; letter-spacing: .3px;
    }
    .hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: 42px; line-height: 1.2;
        color: #3D2010; margin-bottom: 16px;
    }
    .hero h1 span { color: #E8621A; }
    .hero-desc { font-size: 15px; color: #9A8070; line-height: 1.7; margin-bottom: 28px; max-width: 420px; }
    .hero-btns { display: flex; gap: 12px; flex-wrap: wrap; }
    .btn-hero-primary {
        padding: 13px 28px; background: #E8621A; color: #fff;
        border: none; border-radius: 28px; font-size: 14px; font-weight: 700;
        font-family: inherit; cursor: pointer; text-decoration: none;
        display: inline-block; transition: background .2s, transform .15s;
    }
    .btn-hero-primary:hover { background: #C84E0E; transform: translateY(-2px); }
    .btn-hero-secondary {
        padding: 13px 28px; background: none; color: #3D2010;
        border: 2px solid #3D2010; border-radius: 28px;
        font-size: 14px; font-weight: 700; font-family: inherit;
        cursor: pointer; text-decoration: none; display: inline-block; transition: all .2s;
    }
    .btn-hero-secondary:hover { background: #3D2010; color: #fff; }

    .hero-visual { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
    .hv-card {
        border-radius: 18px; position: relative;
        overflow: hidden; display: flex; align-items: flex-end; padding: 14px;
    }
    .hv-card img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }
    .hv-card::after {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,.55) 0%, transparent 60%);
    }
    .hv-card-label { position: relative; z-index: 1; font-size: 11px; font-weight: 700; color: rgba(255,255,255,.9); line-height: 1.3; }
    .hv-tall { height: 190px; }
    .hv-short { height: 130px; }
    .hv-g1 { background: linear-gradient(135deg,#F5C099,#E07030); }
    .hv-g2 { background: linear-gradient(135deg,#8AAB7A,#5A8050); }
    .hv-g3 { background: linear-gradient(135deg,#F0C840,#D09010); }
    .hv-g4 { background: linear-gradient(135deg,#E87060,#B04030); }

    .hero-stats { display: flex; gap: 28px; margin-top: 32px; padding-top: 24px; border-top: 1px solid #EDE3D8; }
    .hero-stat-val { font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 700; color: #3D2010; }
    .hero-stat-lbl { font-size: 11px; color: #9A8070; margin-top: 2px; }

    /* ══ SEARCH ══ */
    .search-wrap { max-width: 1200px; margin: -24px auto 0; padding: 0 24px; position: relative; z-index: 10; }
    .search-card {
        background: #fff; border-radius: 20px;
        border: 1px solid #E8DDD0;
        box-shadow: 0 8px 32px rgba(61,32,16,.1);
        padding: 20px 24px;
        display: flex; gap: 12px; align-items: flex-end;
    }
    .search-field { flex: 2; }
    .search-field label, .filter-field label {
        display: block; font-size: 11px; font-weight: 700;
        color: #7A3D1A; margin-bottom: 6px;
        text-transform: uppercase; letter-spacing: .5px;
    }
    .search-input-wrap { position: relative; }
    .search-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); font-size: 16px; color: #9A8070; pointer-events: none; }
    .search-input {
        width: 100%; padding: 11px 14px 11px 42px;
        background: #FDF6EC; border: 1.5px solid #E0D0C0;
        border-radius: 12px; font-size: 13px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #3D2010; outline: none; transition: border-color .2s;
    }
    .search-input:focus { border-color: #E8621A; background: #fff; }
    .search-input::placeholder { color: #C0A090; }
    .filter-field { flex: 1; }
    .select-input {
        width: 100%; padding: 11px 36px 11px 14px;
        background: #FDF6EC; border: 1.5px solid #E0D0C0;
        border-radius: 12px; font-size: 13px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #3D2010; outline: none; cursor: pointer; appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%239A8070' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat; background-position: right 14px center;
    }
    .select-input:focus { border-color: #E8621A; background-color: #fff; }
    .search-submit {
        padding: 11px 24px; background: #E8621A; color: #fff;
        border: none; border-radius: 12px; font-size: 13px; font-weight: 700;
        font-family: inherit; cursor: pointer; white-space: nowrap;
        transition: background .2s; align-self: flex-end;
    }
    .search-submit:hover { background: #C84E0E; }

    /* ══ SECTION ══ */
    .section { max-width: 1200px; margin: 0 auto; padding: 0 24px; }
    .section-head { display: flex; align-items: flex-end; justify-content: space-between; margin-bottom: 20px; }
    .section-head h2 { font-family: 'Playfair Display', serif; font-size: 26px; color: #3D2010; margin-bottom: 4px; }
    .section-head p { font-size: 13px; color: #9A8070; }
    .see-all { font-size: 13px; font-weight: 600; color: #E8621A; text-decoration: none; white-space: nowrap; }
    .see-all:hover { text-decoration: underline; }

    /* ══ CATEGORY PILLS ══ */
    .cat-scroll { display: flex; gap: 10px; overflow-x: auto; padding-bottom: 4px; scrollbar-width: none; margin-bottom: 40px; }
    .cat-scroll::-webkit-scrollbar { display: none; }
    .cat-pill {
        display: flex; flex-direction: column; align-items: center; gap: 6px;
        padding: 14px 20px; background: #FFFBF5;
        border: 1.5px solid #E8DDD0; border-radius: 16px;
        cursor: pointer; text-decoration: none; transition: all .2s; flex-shrink: 0; min-width: 80px;
    }
    .cat-pill:hover, .cat-pill.active { background: #E8621A; border-color: #E8621A; }
    .cat-pill:hover .cat-pill-name, .cat-pill.active .cat-pill-name { color: #fff; }
    .cat-pill-icon { font-size: 22px; }
    .cat-pill-name { font-size: 11px; font-weight: 600; color: #7A3D1A; white-space: nowrap; transition: color .2s; }

    /* ══ CAROUSEL ══ */
    .carousel-wrap {
        position: relative; border-radius: 20px;
        overflow: hidden; height: 320px;
        margin-bottom: 48px;
        box-shadow: 0 8px 32px rgba(61,32,16,.12);
    }
    .carousel-track {
        display: flex; height: 100%;
        transition: transform .5s cubic-bezier(.4,0,.2,1);
        will-change: transform;
    }
    .carousel-slide {
        min-width: 100%; height: 100%;
        position: relative; flex-shrink: 0;
    }
    .carousel-slide-bg {
        position: absolute; inset: 0;
        background-size: cover; background-position: center;
    }
    .carousel-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(135deg, rgba(61,32,16,.85) 0%, rgba(61,32,16,.4) 100%);
        display: flex; flex-direction: column;
        align-items: flex-start; justify-content: flex-end;
        padding: 36px 40px; color: #fff; z-index: 1;
    }
    .carousel-overlay h2 { font-family: 'Playfair Display', serif; font-size: 28px; margin-bottom: 8px; line-height: 1.3; max-width: 500px; }
    .carousel-overlay p { font-size: 14px; color: rgba(255,255,255,.75); margin-bottom: 20px; max-width: 480px; line-height: 1.6; }
    .btn-carousel {
        padding: 10px 24px; background: #E8621A; color: #fff;
        border: none; border-radius: 22px; font-size: 13px; font-weight: 700;
        font-family: inherit; cursor: pointer; text-decoration: none;
        display: inline-block; transition: background .2s;
    }
    .btn-carousel:hover { background: #C84E0E; }
    .carousel-btn {
        position: absolute; top: 50%; transform: translateY(-50%);
        background: rgba(255,255,255,.2); backdrop-filter: blur(8px);
        color: #fff; border: none;
        width: 44px; height: 44px; border-radius: 50%;
        font-size: 20px; cursor: pointer; z-index: 5;
        transition: background .2s;
        display: flex; align-items: center; justify-content: center;
    }
    .carousel-btn:hover { background: rgba(255,255,255,.35); }
    .carousel-btn-prev { left: 20px; }
    .carousel-btn-next { right: 20px; }
    .carousel-dots { position: absolute; bottom: 18px; right: 24px; display: flex; gap: 6px; z-index: 5; }
    .carousel-dot {
        width: 8px; height: 8px; border-radius: 50%;
        background: rgba(255,255,255,.45);
        cursor: pointer; transition: all .3s; border: none; padding: 0;
    }
    .carousel-dot.active { background: #fff; width: 22px; border-radius: 4px; }

    /* ══ RECIPE GRID — 5 kolom di desktop, 10 card per halaman ══ */
    .resep-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 16px;
        margin-bottom: 40px;
    }
    .resep-card {
        background: #FFFBF5; border-radius: 14px;
        overflow: hidden; border: 1px solid #EDE3D8;
        text-decoration: none; color: inherit;
        transition: transform .25s, box-shadow .25s;
        display: flex; flex-direction: column;
    }
    .resep-card:hover { transform: translateY(-5px); box-shadow: 0 12px 32px rgba(61,32,16,.12); }
    .resep-img-wrap { position: relative; height: 140px; overflow: hidden; background: #F0E8DC; }
    .resep-img { width: 100%; height: 100%; object-fit: cover; transition: transform .4s; }
    .resep-card:hover .resep-img { transform: scale(1.06); }
    .resep-img-fallback { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 38px; }
    .resep-category-badge {
        position: absolute; top: 8px; left: 8px;
        background: #E8621A; color: #fff;
        font-size: 9px; font-weight: 700;
        padding: 3px 8px; border-radius: 10px;
    }
    .resep-rating-badge {
        position: absolute; top: 8px; right: 8px;
        background: rgba(61,32,16,.75); color: #fff;
        font-size: 10px; font-weight: 700;
        padding: 3px 8px; border-radius: 10px;
        display: flex; align-items: center; gap: 3px;
    }
    .resep-body { padding: 12px 13px 14px; flex: 1; display: flex; flex-direction: column; }
    .resep-title {
        font-family: 'Playfair Display', serif;
        font-size: 13px; font-weight: 700; color: #3D2010;
        margin-bottom: 6px; line-height: 1.35;
        display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
    }
    .resep-desc {
        font-size: 11px; color: #9A8070; line-height: 1.5; margin-bottom: 10px;
        display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; flex: 1;
    }
    .resep-footer { display: flex; align-items: center; justify-content: space-between; padding-top: 9px; border-top: 1px solid #EDE3D8; }
    .resep-meta-chips { display: flex; gap: 6px; }
    .resep-chip { display: flex; align-items: center; gap: 3px; font-size: 10px; color: #9A8070; }
    .resep-author-wrap { display: flex; align-items: center; gap: 5px; }
    .resep-author-avatar {
        width: 20px; height: 20px; border-radius: 50%;
        background: #E8621A; color: #fff;
        font-size: 8px; font-weight: 700;
        display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .resep-author-name { font-size: 10px; color: #9A8070; max-width: 60px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .resep-lock-hint { display: flex; align-items: center; gap: 4px; font-size: 9px; color: #C0A090; margin-top: 6px; }

    /* ══ EMPTY STATE ══ */
    .empty-state { text-align: center; padding: 60px 24px; color: #9A8070; }
    .empty-state-icon { font-size: 52px; margin-bottom: 16px; }
    .empty-state h3 { font-family: 'Playfair Display', serif; font-size: 22px; color: #3D2010; margin-bottom: 8px; }
    .empty-state p { font-size: 14px; }

    /* ══ PAGINATION ══ */
    .pagination { display: flex; justify-content: center; gap: 6px; margin-bottom: 56px; }
    .pagination a, .pagination span {
        padding: 8px 16px; border: 1.5px solid #E0D0C0; border-radius: 10px;
        text-decoration: none; color: #7A3D1A; font-size: 13px; font-weight: 600; transition: all .2s;
    }
    .pagination a:hover { border-color: #E8621A; background: #FDE8D0; color: #E8621A; }
    .pagination span.active { background: #E8621A; color: #fff; border-color: #E8621A; }
    .pagination span:not(.active) { color: #C0A090; cursor: default; }

    /* ══ CTA ══ */
    .cta-banner {
        background: #3D2010; border-radius: 24px;
        padding: 52px 48px; text-align: center;
        margin-bottom: 64px; position: relative; overflow: hidden;
    }
    .cta-banner::before { content: ''; position: absolute; width: 300px; height: 300px; border-radius: 50%; background: rgba(232,98,26,.2); top: -100px; left: -60px; pointer-events: none; }
    .cta-banner::after  { content: ''; position: absolute; width: 200px; height: 200px; border-radius: 50%; background: rgba(232,98,26,.15); bottom: -60px; right: -40px; pointer-events: none; }
    .cta-banner-emoji { font-size: 48px; display: block; margin-bottom: 16px; position: relative; z-index: 1; }
    .cta-banner h2 { font-family: 'Playfair Display', serif; font-size: 30px; color: #fff; margin-bottom: 10px; position: relative; z-index: 1; }
    .cta-banner p { font-size: 15px; color: rgba(255,255,255,.6); margin-bottom: 28px; max-width: 480px; margin-left: auto; margin-right: auto; line-height: 1.7; position: relative; z-index: 1; }
    .btn-cta { padding: 14px 36px; background: #E8621A; color: #fff; border: none; border-radius: 32px; font-size: 15px; font-weight: 700; font-family: inherit; cursor: pointer; text-decoration: none; display: inline-block; transition: background .2s, transform .15s; position: relative; z-index: 1; }
    .btn-cta:hover { background: #C84E0E; transform: translateY(-2px); }

    .mt-12 { margin-top: 48px; }
    .mt-8  { margin-top: 32px; }
    .mb-10 { margin-bottom: 40px; }

    /* ══ RESPONSIVE ══ */
    @media (max-width: 1100px) { .resep-grid { grid-template-columns: repeat(4, 1fr); } }
    @media (max-width: 860px)  { .resep-grid { grid-template-columns: repeat(3, 1fr); } }

    @media (max-width: 768px) {
        .hero { padding: 28px 0 24px; }
        .hero-inner { grid-template-columns: 1fr; gap: 0; padding: 0 16px; }
        .hero-visual { display: none; }
        .hero h1 { font-size: 24px; margin-bottom: 10px; }
        .hero-desc { font-size: 13px; margin-bottom: 18px; }
        .btn-hero-primary, .btn-hero-secondary { padding: 10px 20px; font-size: 13px; }
        .hero-stats { gap: 16px; margin-top: 18px; padding-top: 16px; }
        .hero-stat-val { font-size: 18px; }
        .search-wrap { padding: 0 16px; margin: -18px auto 0; }
        .search-card { flex-direction: column; gap: 10px; padding: 14px 16px; border-radius: 14px; }
        .search-field, .filter-field { width: 100%; flex: none; }
        .search-submit { width: 100%; padding: 12px; }
        .section { padding: 0 16px; }
        .section-head h2 { font-size: 18px; }
        .mt-12 { margin-top: 28px; }
        .mt-8  { margin-top: 20px; }
        .cat-scroll { margin-bottom: 20px; gap: 8px; }
        .cat-pill { padding: 8px 12px; min-width: 58px; border-radius: 12px; }
        .cat-pill-icon { font-size: 16px; }
        .cat-pill-name { font-size: 10px; }
        .carousel-wrap { height: 180px; border-radius: 14px; margin-bottom: 24px; }
        .carousel-overlay { padding: 14px 16px; }
        .carousel-overlay h2 { font-size: 15px; margin-bottom: 4px; }
        .carousel-overlay p { display: none; }
        .btn-carousel { padding: 7px 14px; font-size: 11px; }
        .carousel-btn { width: 32px; height: 32px; font-size: 16px; }

        /* Mobile: 2 kolom */
        .resep-grid { grid-template-columns: repeat(2, 1fr); gap: 10px; margin-bottom: 20px; }
        .resep-img-wrap { height: 120px; }
        .resep-img-fallback { font-size: 32px; }
        .resep-body { padding: 9px 10px 11px; }
        .resep-title { font-size: 12px; }
        .resep-desc { display: none; }
        .resep-author-name { display: none; }
        .resep-author-avatar { width: 18px; height: 18px; }
        .resep-chip { font-size: 9px; }
        .pagination { gap: 4px; margin-bottom: 24px; }
        .pagination a, .pagination span { padding: 6px 11px; font-size: 12px; border-radius: 8px; }
        .cta-banner { padding: 28px 20px; border-radius: 16px; margin-bottom: 28px; }
        .cta-banner h2 { font-size: 18px; }
        .cta-banner p { font-size: 13px; margin-bottom: 20px; }
        .btn-cta { padding: 11px 24px; font-size: 13px; }
    }

    @media (max-width: 400px) {
        .resep-grid { gap: 8px; }
        .resep-img-wrap { height: 100px; }
        .resep-title { font-size: 11px; }
    }
</style>
@endpush

@section('content')

{{-- HERO --}}
<div class="hero">
    <div class="hero-inner">
        <div>
            <div class="hero-tag">🇮🇩 Komunitas Masak #1 Indonesia</div>
            <h1>Masak Lebih <span>Ceria</span>,<br>Setiap Hari</h1>
            <p class="hero-desc">Temukan ribuan resep lezat dari dapur nusantara. Login untuk menyukai, menyimpan favorit, dan berbagi resep andalanmu!</p>
            <div class="hero-btns">
                <a href="#resep-section" class="btn-hero-primary">Jelajahi Resep 🍳</a>
                @guest
                    <a href="{{ route('register') }}" class="btn-hero-secondary">Daftar Gratis</a>
                @else
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="btn-hero-secondary">Panel Admin</a>
                    @else
                        <a href="{{ route('user.resep.create') }}" class="btn-hero-secondary">Upload Resep</a>
                    @endif
                @endguest
            </div>
            <div class="hero-stats">
                <div>
                    <div class="hero-stat-val">{{ \App\Models\Resep::where('status','approved')->count() }}+</div>
                    <div class="hero-stat-lbl">Resep Tersedia</div>
                </div>
                <div>
                    <div class="hero-stat-val">{{ \App\Models\User::where('role','user')->count() }}+</div>
                    <div class="hero-stat-lbl">Chef Rumahan</div>
                </div>
                <div>
                    <div class="hero-stat-val">{{ \App\Models\Komentar::count() }}+</div>
                    <div class="hero-stat-lbl">Komentar</div>
                </div>
            </div>
        </div>

        <div class="hero-visual">
            @php
                $heroReseps   = \App\Models\Resep::where('status','approved')->withCount('sukas')->orderBy('sukas_count','desc')->take(4)->get();
                $heroFallback = ['🍛','🥗','🍜','🍮'];
                $heroGrad     = ['hv-g1','hv-g2','hv-g3','hv-g4'];
            @endphp
            @foreach([0,1] as $col)
                @php $r1=$heroReseps->get($col*2); $r2=$heroReseps->get($col*2+1); @endphp
                <div style="display:flex;flex-direction:column;gap:12px;">
                    <div class="hv-card hv-tall {{ $r1?'':$heroGrad[$col*2] }}">
                        @if($r1&&$r1->gambar)<img src="{{ asset('storage/'.$r1->gambar) }}" alt="{{ $r1->judul }}" loading="lazy">
                        @else<span style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);font-size:40px;">{{ $heroFallback[$col*2] }}</span>@endif
                        <div class="hv-card-label">{{ $r1?$r1->judul:'Resep Lezat' }}</div>
                    </div>
                    <div class="hv-card hv-short {{ $r2?'':$heroGrad[$col*2+1] }}">
                        @if($r2&&$r2->gambar)<img src="{{ asset('storage/'.$r2->gambar) }}" alt="{{ $r2->judul }}" loading="lazy">
                        @else<span style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);font-size:32px;">{{ $heroFallback[$col*2+1] }}</span>@endif
                        <div class="hv-card-label">{{ $r2?$r2->judul:'Resep Pilihan' }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

{{-- SEARCH --}}
<div class="search-wrap">
    <form action="{{ route('home') }}" method="GET" class="search-card">
        <div class="search-field">
            <label>Cari Resep</label>
            <div class="search-input-wrap">
                <span class="search-icon">⌕</span>
                <input type="text" name="search" class="search-input" placeholder="Cari resep, bahan, atau masakan..." value="{{ request('search') }}">
            </div>
        </div>
        <div class="filter-field">
            <label>Kategori</label>
            <select name="kategori" class="select-input">
                <option value="">Semua Kategori</option>
                @foreach($kategoris as $k)
                    <option value="{{ $k->id }}" {{ request('kategori')==$k->id?'selected':'' }}>{{ $k->nama_kategori }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="search-submit">Cari</button>
    </form>
</div>

{{-- KATEGORI --}}
<div class="section mt-12">
    <div class="section-head">
        <div><h2>Kategori</h2><p>Pilih kategori dan temukan resep yang kamu mau</p></div>
    </div>
    <div class="cat-scroll">
        <a href="{{ route('home') }}" class="cat-pill {{ !request('kategori')&&!request('search')?'active':'' }}">
            <span class="cat-pill-icon">🍴</span><span class="cat-pill-name">Semua</span>
        </a>
        @foreach($kategoris as $k)
            @php
                $icons=['Makanan Utama'=>'🍛','Masakan Utama'=>'🍛','Dessert'=>'🍰','Makanan Penutup'=>'🍰',
                        'Minuman'=>'🥤','Makanan Ringan'=>'🍪','Snack'=>'🍪','Sarapan'=>'🍳',
                        'Masakan Indonesia'=>'🇮🇩','Masakan Barat'=>'🍝','Masakan Cepat Saji'=>'🍔'];
                $icon=$icons[$k->nama_kategori]??'🍽️';
            @endphp
            <a href="?kategori={{ $k->id }}" class="cat-pill {{ request('kategori')==$k->id?'active':'' }}">
                <span class="cat-pill-icon">{{ $icon }}</span>
                <span class="cat-pill-name">{{ $k->nama_kategori }}</span>
            </a>
        @endforeach
    </div>
</div>

{{-- CAROUSEL --}}
@php
    $popularReseps = \App\Models\Resep::where('status','approved')
        ->withCount('sukas')->orderBy('sukas_count','desc')->take(5)->get();
@endphp

@if($popularReseps->count())
<div class="section mb-10">
    <div class="section-head">
        <div><h2>Resep Terpopuler</h2><p>Resep paling banyak disukai komunitas</p></div>
    </div>
    <div class="carousel-wrap" id="carouselWrap">
        <div class="carousel-track" id="carouselTrack">
            @foreach($popularReseps as $i => $resep)
            <div class="carousel-slide">
                @if($resep->gambar)
                    <div class="carousel-slide-bg"
                         style="background-image:url('{{ asset('storage/'.$resep->gambar) }}');background-size:cover;background-position:center;">
                    </div>
                @else
                    <div class="carousel-slide-bg hv-g{{ ($i%4)+1 }}"></div>
                @endif
                <div class="carousel-overlay">
                    <h2>{{ $resep->judul }}</h2>
                    <p>{{ Str::limit($resep->deskripsi, 120) }}</p>
                    <a href="{{ route('resep.show', $resep->id) }}" class="btn-carousel">Lihat Resep →</a>
                </div>
            </div>
            @endforeach
        </div>
        @if($popularReseps->count() > 1)
            <button class="carousel-btn carousel-btn-prev" id="cPrev">‹</button>
            <button class="carousel-btn carousel-btn-next" id="cNext">›</button>
            <div class="carousel-dots" id="cDots"></div>
        @endif
    </div>
</div>
@endif

{{-- ★ RESEP GRID — 10 card, ke-11 ke halaman 2 ★ --}}
<div class="section" id="resep-section">
    <div class="section-head">
        <div>
            <h2>{{ request('search')||request('kategori') ? 'Hasil Pencarian' : 'Resep Terbaru' }}</h2>
            <p>
                @if(request('search'))Menampilkan hasil untuk "<strong>{{ request('search') }}</strong>"
                @elseif(request('kategori'))Menampilkan resep kategori terpilih
                @else Halaman {{ $reseps->currentPage() }} dari {{ $reseps->lastPage() }} — total {{ $reseps->total() }} resep
                @endif
            </p>
        </div>
    </div>

    @if($reseps->count())
        <div class="resep-grid">
            @foreach($reseps as $resep)
            <a href="{{ route('resep.show', $resep->id) }}" class="resep-card">
                <div class="resep-img-wrap">
                    @if($resep->gambar)
                        <img class="resep-img" src="{{ asset('storage/'.$resep->gambar) }}" alt="{{ $resep->judul }}" loading="lazy">
                    @else
                        <div class="resep-img-fallback">
                            @php $emo=['🍛','🥗','🍜','🍮','🍳','🥘','🍲','🥗','🍱','🧆']; echo $emo[$loop->index % count($emo)]; @endphp
                        </div>
                    @endif
                    <span class="resep-category-badge">{{ $resep->kategori->nama_kategori }}</span>
                    <span class="resep-rating-badge">⭐ {{ number_format($resep->averageRating(), 1) }}</span>
                </div>
                <div class="resep-body">
                    <div class="resep-title">{{ $resep->judul }}</div>
                    <div class="resep-desc">{{ $resep->deskripsi }}</div>
                    @guest<div class="resep-lock-hint">🔒 Login untuk suka & simpan</div>@endguest
                    <div class="resep-footer">
                        <div class="resep-meta-chips">
                            <div class="resep-chip">⏱ {{ $resep->waktu_memasak }}mnt</div>
                            <div class="resep-chip">🍽 {{ $resep->porsi }}p</div>
                        </div>
                        <div class="resep-author-wrap">
                            <div class="resep-author-avatar">{{ strtoupper(substr($resep->user->name,0,2)) }}</div>
                            <span class="resep-author-name">{{ $resep->user->name }}</span>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        {{-- PAGINATION --}}
        <div class="pagination">
            {{-- Prev --}}
            @if($reseps->onFirstPage())
                <span>«</span>
            @else
                <a href="{{ $reseps->previousPageUrl() }}">«</a>
            @endif

            {{-- Page numbers --}}
            @for($i = 1; $i <= $reseps->lastPage(); $i++)
                @if($i == $reseps->currentPage())
                    <span class="active">{{ $i }}</span>
                @else
                    <a href="{{ $reseps->url($i) }}">{{ $i }}</a>
                @endif
            @endfor

            {{-- Next --}}
            @if($reseps->hasMorePages())
                <a href="{{ $reseps->nextPageUrl() }}">»</a>
            @else
                <span>»</span>
            @endif
        </div>

    @else
        <div class="empty-state">
            <div class="empty-state-icon">🔍</div>
            <h3>Tidak ada resep ditemukan</h3>
            <p>Coba kata kunci atau kategori lain</p>
        </div>
    @endif
</div>

{{-- CTA --}}
<div class="section mt-8">
    <div class="cta-banner">
        @guest
            <span class="cta-banner-emoji">🎉</span>
            <h2>Ayo Bergabung dengan DapurCeria!</h2>
            <p>Daftar gratis dan mulai bagikan resep andalanmu ke ribuan chef rumahan Indonesia.</p>
            <a href="{{ route('register') }}" class="btn-cta">Daftar Sekarang</a>
        @else
            @if(auth()->user()->role !== 'admin')
                <span class="cta-banner-emoji">📤</span>
                <h2>Punya Resep Andalan?</h2>
                <p>Bagikan resep favoritmu dan inspirasi ribuan pengguna lainnya!</p>
                <a href="{{ route('user.resep.create') }}" class="btn-cta">Upload Resep Sekarang</a>
            @else
                <span class="cta-banner-emoji">🛡️</span>
                <h2>Selamat Datang, Admin!</h2>
                <p>Kelola resep, setujui unggahan user, dan jaga kualitas konten DapurCeria.</p>
                <a href="{{ route('admin.dashboard') }}" class="btn-cta">Buka Panel Admin</a>
            @endif
        @endguest
    </div>
</div>

@endsection

@push('scripts')
<script>
/* ══ CAROUSEL — jalan setelah seluruh DOM selesai dirender ══ */
document.addEventListener('DOMContentLoaded', function () {
    var track  = document.getElementById('carouselTrack');
    var dots   = document.getElementById('cDots');
    var prev   = document.getElementById('cPrev');
    var next   = document.getElementById('cNext');
    var wrap   = document.getElementById('carouselWrap');

    if (!track) return;

    var slides = track.querySelectorAll('.carousel-slide');
    var total  = slides.length;
    if (total <= 1) return;

    var cur   = 0;
    var timer = null;

    /* Buat dots */
    for (var i = 0; i < total; i++) {
        (function(idx) {
            var d = document.createElement('button');
            d.className = 'carousel-dot' + (idx === 0 ? ' active' : '');
            d.setAttribute('aria-label', 'Slide ' + (idx + 1));
            d.addEventListener('click', function () { goTo(idx); resetTimer(); });
            dots.appendChild(d);
        })(i);
    }

    function goTo(index) {
        cur = (index + total) % total;
        track.style.transform = 'translateX(-' + (cur * 100) + '%)';
        var allDots = dots.querySelectorAll('.carousel-dot');
        for (var j = 0; j < allDots.length; j++) {
            allDots[j].classList.toggle('active', j === cur);
        }
    }

    function resetTimer() {
        clearInterval(timer);
        timer = setInterval(function () { goTo(cur + 1); }, 5000);
    }

    if (prev) prev.addEventListener('click', function () { goTo(cur - 1); resetTimer(); });
    if (next) next.addEventListener('click', function () { goTo(cur + 1); resetTimer(); });

    if (wrap) {
        wrap.addEventListener('mouseenter', function () { clearInterval(timer); });
        wrap.addEventListener('mouseleave', function () { resetTimer(); });
    }

    /* Touch swipe support */
    var touchStartX = 0;
    track.addEventListener('touchstart', function (e) { touchStartX = e.changedTouches[0].clientX; }, { passive: true });
    track.addEventListener('touchend', function (e) {
        var diff = touchStartX - e.changedTouches[0].clientX;
        if (Math.abs(diff) > 40) { goTo(diff > 0 ? cur + 1 : cur - 1); resetTimer(); }
    }, { passive: true });

    resetTimer();
});
</script>
@endpush