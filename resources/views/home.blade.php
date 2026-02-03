@extends('layouts.app')

@section('title', 'Beranda - Dapur Ceria')

@section('styles')
<style>
    .hero {
        background: linear-gradient(135deg, #ff6b6b, #ffa07a);
        color: white;
        padding: 3rem 0;
        text-align: center;
        margin-bottom: 2rem;
        border-radius: 8px;
    }
    .hero h1 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }
    .filter-section {
        background: white;
        padding: 1.5rem;
        border-radius: 8px;
        margin-bottom: 2rem;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    .filter-form {
        display: flex;
        gap: 1rem;
        align-items: end;
    }
    .form-group {
        flex: 1;
    }
    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
    }
    .form-control {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
    .resep-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
    }
    .resep-card {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        transition: transform 0.3s;
        text-decoration: none;
        color: inherit;
        display: block;
    }
    .resep-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
    }
    .resep-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        background: #f0f0f0;
    }
    .resep-content {
        padding: 1.5rem;
    }
    .resep-title {
        font-size: 1.25rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
        color: #333;
    }
    .resep-meta {
        display: flex;
        gap: 1rem;
        font-size: 0.875rem;
        color: #666;
        margin-top: 1rem;
    }
    .kategori-badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        background: #ff6b6b;
        color: white;
        border-radius: 12px;
        font-size: 0.75rem;
        margin-bottom: 0.5rem;
    }
    .empty-state {
        text-align: center;
        padding: 3rem;
        color: #999;
    }
    .pagination {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 2rem;
    }
    .pagination a,
    .pagination span {
        padding: 0.5rem 1rem;
        border: 1px solid #ddd;
        border-radius: 5px;
        text-decoration: none;
        color: #333;
    }
    .pagination .active {
        background: #ff6b6b;
        color: white;
        border-color: #ff6b6b;
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<div class="hero">
    <h1>🍳 Selamat Datang di Dapur Ceria!</h1>
    <p>Temukan berbagai resep masakan lezat dan mudah</p>
</div>

<!-- Filter Section -->
<div class="filter-section">
    <form action="{{ route('home') }}" method="GET" class="filter-form">
        <div class="form-group">
            <label>Cari Resep</label>
            <input type="text" name="search" class="form-control" placeholder="Cari resep..." value="{{ request('search') }}">
        </div>
        <div class="form-group">
            <label>Kategori</label>
            <select name="kategori" class="form-control">
                <option value="">Semua Kategori</option>
                @foreach($kategoris as $kat)
                    <option value="{{ $kat->id }}" {{ request('kategori') == $kat->id ? 'selected' : '' }}>
                        {{ $kat->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
        @if(request('search') || request('kategori'))
            <a href="{{ route('home') }}" class="btn btn-secondary">Reset</a>
        @endif
    </form>
</div>

<!-- Resep Grid -->
@if($reseps->count() > 0)
    <div class="resep-grid">
        @foreach($reseps as $resep)
            <a href="{{ route('resep.show', $resep->id) }}" class="resep-card">
                @if($resep->gambar)
                    <img src="{{ asset('storage/' . $resep->gambar) }}" alt="{{ $resep->judul }}" class="resep-image">
                @else
                    <div class="resep-image" style="display: flex; align-items: center; justify-content: center; font-size: 3rem;">🍲</div>
                @endif
                
                <div class="resep-content">
                    <span class="kategori-badge">{{ $resep->kategori->nama_kategori }}</span>
                    <h3 class="resep-title">{{ $resep->judul }}</h3>
                    <p style="color: #666; font-size: 0.875rem;">{{ Str::limit($resep->deskripsi, 100) }}</p>
                    
                    <div class="resep-meta">
                        <span>⏱️ {{ $resep->waktu_memasak }} menit</span>
                        <span>🍽️ {{ $resep->porsi }} porsi</span>
                        <span>⭐ {{ number_format($resep->averageRating(), 1) }}</span>
                    </div>
                    <div style="margin-top: 0.5rem; font-size: 0.875rem; color: #999;">
                        Oleh: {{ $resep->user->name }}
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="pagination">
        {{ $reseps->links() }}
    </div>
@else
    <div class="empty-state">
        <h3>Tidak ada resep ditemukan</h3>
        <p>Coba ubah filter atau kata kunci pencarian Anda</p>
    </div>
@endif
@endsection