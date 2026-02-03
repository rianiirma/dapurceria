@extends('layouts.app')

@section('title', 'Favorit Saya - Dapur Ceria')

@section('styles')
<style>
    .page-header {
        margin-bottom: 2rem;
    }
    .page-header h2 {
        color: #333;
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
        position: relative;
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
    .remove-favorit {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: white;
        border: none;
        padding: 0.5rem;
        border-radius: 50%;
        cursor: pointer;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        font-size: 1.25rem;
    }
    .empty-state {
        text-align: center;
        padding: 3rem;
        color: #999;
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <h2>⭐ Resep Favorit Saya</h2>
    <p style="color: #666;">Resep-resep yang Anda favoritkan</p>
</div>

@if($favorits->count() > 0)
    <div class="resep-grid">
        @foreach($favorits as $favorit)
            @php $resep = $favorit->resep; @endphp
            <div class="resep-card">
                <form action="{{ route('favorit.toggle', $resep->id) }}" method="POST" class="remove-favorit">
                    @csrf
                    <button type="submit" style="background: none; border: none; cursor: pointer;" title="Hapus dari favorit">❌</button>
                </form>

                <a href="{{ route('resep.show', $resep->id) }}" style="text-decoration: none; color: inherit;">
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
            </div>
        @endforeach
    </div>
@else
    <div class="empty-state">
        <h3>Anda belum memiliki resep favorit</h3>
        <p>Jelajahi resep dan tambahkan ke favorit Anda!</p>
        <a href="{{ route('home') }}" class="btn btn-primary">Jelajahi Resep</a>
    </div>
@endif
@endsection