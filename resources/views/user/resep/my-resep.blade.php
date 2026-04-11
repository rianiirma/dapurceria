@extends('layouts.app')
@section('title', 'Resep Saya - DapurCeria')

@push('styles')
<style>
    body { background: #FDF6EC; }

    .my-page {
        max-width: 800px;
        margin: 0 auto;
        padding: 32px 20px 60px;
    }

    /* ── HEADER ── */
    .my-header {
        background: #3D2010;
        border-radius: 20px;
        padding: 24px 24px 20px;
        margin-bottom: 20px;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
    }

    .my-header::before {
        content: '';
        position: absolute;
        width: 160px; height: 160px;
        border-radius: 50%;
        background: rgba(232,98,26,.2);
        top: -50px; right: -30px;
    }

    .my-header h1 {
        font-family: 'Playfair Display', serif;
        font-size: 20px;
        color: #fff;
        margin-bottom: 4px;
        position: relative;
        z-index: 1;
    }

    .my-header p {
        font-size: 12px;
        color: rgba(255,255,255,.5);
        position: relative;
        z-index: 1;
    }

    .btn-upload-new {
        padding: 10px 20px;
        background: #E8621A;
        color: #fff;
        border: none;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        font-family: inherit;
        cursor: pointer;
        text-decoration: none;
        white-space: nowrap;
        position: relative;
        z-index: 1;
        transition: background .2s;
        flex-shrink: 0;
    }

    .btn-upload-new:hover { background: #C84E0E; }

    /* ── ALERT BOXES ── */
    .alert-box {
        border-radius: 14px;
        padding: 14px 16px;
        margin-bottom: 14px;
        display: flex;
        gap: 12px;
        align-items: flex-start;
        font-size: 13px;
        line-height: 1.6;
    }

    .alert-box-icon { font-size: 18px; flex-shrink: 0; margin-top: 1px; }

    .alert-rejected {
        background: #FDDEDE;
        border: 1px solid #F5B7B1;
        border-left: 4px solid #C62828;
        color: #8B1A1A;
    }

    .alert-pending {
        background: #FEF3C0;
        border: 1px solid #FCD34D;
        border-left: 4px solid #B08010;
        color: #856404;
    }

    .alert-rejected-list { margin-top: 8px; }

    .alert-rejected-item {
        display: flex;
        gap: 8px;
        padding: 6px 0;
        border-bottom: 1px solid rgba(198,40,40,.15);
        font-size: 12px;
    }

    .alert-rejected-item:last-child { border-bottom: none; }

    .arl-name { font-weight: 700; min-width: 120px; color: #8B1A1A; }
    .arl-reason { color: #C62828; }

    /* flash success */
    .flash-success {
        background: #D4F0E0;
        border: 1px solid #A9DFBF;
        border-radius: 14px;
        padding: 12px 16px;
        font-size: 13px;
        font-weight: 600;
        color: #1A6B3A;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* ── RESEP CARDS ── */
    .resep-list { display: flex; flex-direction: column; gap: 14px; }

    .resep-item {
        background: #FFFBF5;
        border: 1px solid #EDE3D8;
        border-radius: 18px;
        overflow: hidden;
        display: flex;
        gap: 0;
        transition: box-shadow .2s;
    }

    .resep-item:hover { box-shadow: 0 4px 20px rgba(61,32,16,.08); }

    .resep-item.status-pending { border-left: 4px solid #B08010; }
    .resep-item.status-rejected { border-left: 4px solid #C62828; }
    .resep-item.status-approved { border-left: 4px solid #2E7D32; }

    /* thumbnail */
    .ri-thumb {
        width: 110px;
        flex-shrink: 0;
        position: relative;
        overflow: hidden;
        background: #F0E8DC;
    }

    .ri-thumb img {
        width: 100%; height: 100%;
        object-fit: cover;
    }

    .ri-thumb-fallback {
        width: 100%; height: 100%;
        display: flex; align-items: center; justify-content: center;
        font-size: 32px;
        min-height: 90px;
    }

    /* body */
    .ri-body {
        flex: 1;
        padding: 14px 16px;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .ri-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 10px;
    }

    .ri-title {
        font-family: 'Playfair Display', serif;
        font-size: 15px;
        color: #3D2010;
        line-height: 1.35;
    }

    .status-pill {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 3px 10px;
        border-radius: 10px;
        font-size: 10px;
        font-weight: 700;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .sp-approved { background: #D4F0E0; color: #1A6B3A; }
    .sp-pending  { background: #FEF3C0; color: #856404; }
    .sp-rejected { background: #FDDEDE; color: #8B1A1A; }

    .ri-meta {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 11px;
        color: #9A8070;
        flex-wrap: wrap;
    }

    .ri-meta-chip { display: flex; align-items: center; gap: 4px; }

    .diff-mini {
        font-size: 10px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 8px;
    }

    .dm-mudah  { background: #D4F0E0; color: #1A6B3A; }
    .dm-sedang { background: #FEF3C0; color: #856404; }
    .dm-sulit  { background: #FDDEDE; color: #8B1A1A; }

    /* alasan tolak inline */
    .ri-reject-reason {
        background: #FEF2F2;
        border-left: 3px solid #C62828;
        border-radius: 0 8px 8px 0;
        padding: 6px 10px;
        font-size: 11px;
        color: #8B1A1A;
        line-height: 1.5;
    }

    /* actions */
    .ri-actions {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-top: 4px;
    }

    .ri-btn {
        padding: 6px 14px;
        border-radius: 10px;
        font-size: 11px;
        font-weight: 700;
        font-family: inherit;
        cursor: pointer;
        border: none;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: all .2s;
    }

    .ri-btn-view   { background: #F5EDE3; color: #7A3D1A; }
    .ri-btn-view:hover { background: #E8D5C0; }

    .ri-btn-edit   { background: #FEF3C0; color: #856404; }
    .ri-btn-edit:hover { background: #FDE68A; }

    .ri-btn-delete { background: #FDDEDE; color: #8B1A1A; }
    .ri-btn-delete:hover { background: #FCA5A5; }

    /* ── EMPTY STATE ── */
    .empty-state {
        text-align: center;
        padding: 60px 24px;
        background: #FFFBF5;
        border-radius: 20px;
        border: 1px solid #EDE3D8;
    }

    .empty-icon { font-size: 52px; margin-bottom: 16px; }

    .empty-title {
        font-family: 'Playfair Display', serif;
        font-size: 20px;
        color: #3D2010;
        margin-bottom: 8px;
    }

    .empty-sub { font-size: 13px; color: #9A8070; margin-bottom: 20px; }

    .btn-empty {
        padding: 12px 28px;
        background: #E8621A;
        color: #fff;
        border: none;
        border-radius: 24px;
        font-size: 14px;
        font-weight: 700;
        font-family: inherit;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: background .2s;
    }

    .btn-empty:hover { background: #C84E0E; }

    @media (max-width: 480px) {
        .ri-thumb { width: 80px; }
        .ri-title { font-size: 13px; }
        .my-header { flex-direction: column; align-items: flex-start; }
    }
</style>
@endpush

@section('content')
<div class="my-page">

    {{-- HEADER --}}
    <div class="my-header">
        <div>
            <h1>📋 Resep Saya</h1>
            <p>{{ $reseps->count() }} resep · kelola semua resepmu di sini</p>
        </div>
        <a href="{{ route('user.resep.create') }}" class="btn-upload-new">+ Upload Baru</a>
    </div>

    {{-- FLASH SUCCESS --}}
    @if(session('success'))
        <div class="flash-success">✓ {{ session('success') }}</div>
    @endif

    {{-- ALERT REJECTED --}}
    @php $ditolak = $reseps->where('status', 'rejected'); @endphp
    @if($ditolak->count())
        <div class="alert-box alert-rejected">
            <span class="alert-box-icon">✗</span>
            <div>
                <strong>{{ $ditolak->count() }} resep ditolak</strong> — silakan perbaiki dan upload ulang
                <div class="alert-rejected-list">
                    @foreach($ditolak as $r)
                        <div class="alert-rejected-item">
                            <span class="arl-name">{{ Str::limit($r->judul, 25) }}:</span>
                            <span class="arl-reason">{{ $r->alasan_tolak ?? 'Tidak ada alasan.' }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    {{-- ALERT PENDING --}}
    @php $pending = $reseps->where('status', 'pending'); @endphp
    @if($pending->count())
        <div class="alert-box alert-pending">
            <span class="alert-box-icon">⏳</span>
            <div>
                <strong>{{ $pending->count() }} resep</strong> sedang menunggu persetujuan admin.
                Akan tampil di beranda setelah disetujui.
            </div>
        </div>
    @endif

    {{-- RESEP LIST --}}
    @if($reseps->count())
        <div class="resep-list">
            @foreach($reseps as $resep)
            <div class="resep-item status-{{ $resep->status }}">

                {{-- Thumbnail --}}
                <div class="ri-thumb">
                    @if($resep->gambar)
                        <img src="{{ asset('storage/' . $resep->gambar) }}" alt="{{ $resep->judul }}" loading="lazy">
                    @else
                        @php
                            $icons = ['🍛','🥗','🍜','🍮','🍳','🥘'];
                            echo '<div class="ri-thumb-fallback">' . $icons[$loop->index % count($icons)] . '</div>';
                        @endphp
                    @endif
                </div>

                {{-- Body --}}
                <div class="ri-body">
                    <div class="ri-top">
                        <div class="ri-title">{{ $resep->judul }}</div>
                        <span class="status-pill sp-{{ $resep->status }}">
                            @if($resep->status === 'approved') ✓ Disetujui
                            @elseif($resep->status === 'pending') ⏳ Menunggu
                            @else ✗ Ditolak
                            @endif
                        </span>
                    </div>

                    {{-- Meta --}}
                    <div class="ri-meta">
                        <span class="ri-meta-chip">📁 {{ $resep->kategori->nama_kategori }}</span>
                        <span class="ri-meta-chip">⏱ {{ $resep->waktu_memasak }}mnt</span>
                        <span class="ri-meta-chip">⭐ {{ number_format($resep->averageRating(), 1) }}</span>
                        <span class="ri-meta-chip">❤️ {{ $resep->totalSuka() }}</span>
                        <span class="diff-mini dm-{{ $resep->tingkat_kesulitan }}">
                            {{ ucfirst($resep->tingkat_kesulitan) }}
                        </span>
                    </div>

                    {{-- Alasan tolak --}}
                    @if($resep->status === 'rejected' && $resep->alasan_tolak)
                        <div class="ri-reject-reason">
                            ✗ {{ $resep->alasan_tolak }}
                        </div>
                    @endif

                    {{-- Actions --}}
                    <div class="ri-actions">
                        @if($resep->status === 'approved')
                            <a href="{{ route('resep.show', $resep->id) }}" class="ri-btn ri-btn-view">👁 Lihat</a>
                        @endif
                        <a href="{{ route('user.resep.edit', $resep->id) }}" class="ri-btn ri-btn-edit">✏️ Edit</a>
                        <form action="{{ route('user.resep.destroy', $resep->id) }}" method="POST"
                              onsubmit="return confirm('Yakin hapus resep \'{{ addslashes($resep->judul) }}\'?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="ri-btn ri-btn-delete">🗑 Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    @else
        <div class="empty-state">
            <div class="empty-icon">🍳</div>
            <div class="empty-title">Belum ada resep</div>
            <p class="empty-sub">Mulai bagikan resep andalanmu ke komunitas DapurCeria!</p>
            <a href="{{ route('user.resep.create') }}" class="btn-empty">+ Upload Resep Pertamamu</a>
        </div>
    @endif

</div>
@endsection