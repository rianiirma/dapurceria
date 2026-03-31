@extends('layouts.app')

@section('title', 'Resep Saya - Dapur Ceria')

@section('styles')
<style>
    .page-header {
        margin-bottom: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .resep-table {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .table {
        width: 100%;
        border-collapse: collapse;
    }
    .table th,
    .table td {
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid #f0f0f0;
    }
    .table th {
        background: #f8f9fa;
        font-weight: 600;
        color: #333;
    }
    .table tr:hover {
        background: #fafafa;
    }
    .resep-thumb {
        width: 80px;
        height: 60px;
        object-fit: cover;
        border-radius: 5px;
    }
    .actions {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }
    .empty-state {
        text-align: center;
        padding: 3rem;
        color: #999;
    }

    /* STATUS BADGES */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 10px;
        border-radius: 99px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }
    .status-approved {
        background: #D1FAE5;
        color: #065F46;
        border: 1px solid #6EE7B7;
    }
    .status-pending {
        background: #FEF3C7;
        color: #92400E;
        border: 1px solid #FCD34D;
    }
    .status-rejected {
        background: #FEE2E2;
        color: #991B1B;
        border: 1px solid #FCA5A5;
    }

    /* DIFFICULTY BADGES */
    .badge {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .badge-success { background: #d4edda; color: #155724; }
    .badge-warning { background: #fff3cd; color: #856404; }
    .badge-danger  { background: #f8d7da; color: #721c24; }

    /* ALERT TOLAK */
    .alert-tolak {
        background: #FEF2F2;
        border: 1px solid #FECACA;
        border-left: 4px solid #EF4444;
        border-radius: 10px;
        padding: 14px 18px;
        margin-bottom: 1.5rem;
    }
    .alert-tolak-title {
        font-size: 14px;
        font-weight: 700;
        color: #991B1B;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .alert-tolak-item {
        font-size: 13px;
        color: #7F1D1D;
        padding: 4px 0;
        border-bottom: 1px solid #FEE2E2;
        display: flex;
        align-items: flex-start;
        gap: 8px;
    }
    .alert-tolak-item:last-child {
        border-bottom: none;
    }
    .alert-tolak-resep-name {
        font-weight: 600;
        min-width: 140px;
    }
    .alert-tolak-alasan {
        color: #991B1B;
    }

    /* ALASAN TOLAK di dalam tabel */
    .alasan-cell {
        font-size: 12px;
        color: #991B1B;
        background: #FEF2F2;
        border-radius: 6px;
        padding: 5px 8px;
        margin-top: 4px;
        border-left: 3px solid #EF4444;
        max-width: 200px;
    }
</style>
@endsection

@section('content')

{{-- NOTIFIKASI RESEP DITOLAK --}}
@php
    $resepDitolak = $reseps->where('status', 'rejected');
@endphp

@if($resepDitolak->count() > 0)
    <div class="alert-tolak">
        <div class="alert-tolak-title">
            <i class='bx bx-x-circle' style="font-size:16px;"></i>
            {{ $resepDitolak->count() }} resep kamu ditolak — silakan perbaiki dan upload ulang
        </div>
        @foreach($resepDitolak as $r)
            <div class="alert-tolak-item">
                <span class="alert-tolak-resep-name">{{ $r->judul }}:</span>
                <span class="alert-tolak-alasan">
                    {{ $r->alasan_tolak ?? 'Tidak ada alasan yang diberikan.' }}
                </span>
            </div>
        @endforeach
    </div>
@endif

{{-- NOTIFIKASI RESEP PENDING --}}
@php
    $resepPending = $reseps->where('status', 'pending');
@endphp
@if($resepPending->count() > 0)
    <div style="background:#FFFBEB; border:1px solid #FDE68A; border-left:4px solid #F59E0B; border-radius:10px; padding:12px 18px; margin-bottom:1.5rem; font-size:13px; color:#92400E; display:flex; align-items:center; gap:10px;">
        <i class='bx bx-time-five' style="font-size:18px; color:#F59E0B; flex-shrink:0;"></i>
        <span>
            <strong>{{ $resepPending->count() }} resep</strong> sedang menunggu persetujuan admin.
            Kamu akan bisa melihatnya di beranda setelah disetujui.
        </span>
    </div>
@endif

<div class="page-header">
    <h2><i class='bx bx-book-bookmark'></i> Resep Saya</h2>
    <a href="{{ route('user.resep.create') }}" class="btn btn-primary">+ Upload Resep Baru</a>
</div>

@if(session('success'))
    <div style="background:#D1FAE5; border:1px solid #6EE7B7; color:#065F46; padding:12px 16px; border-radius:10px; font-size:14px; font-weight:600; margin-bottom:1.25rem; display:flex; align-items:center; gap:8px;">
        <i class='bx bx-check-circle' style="font-size:18px;"></i>
        {{ session('success') }}
    </div>
@endif

@if($reseps->count() > 0)
    <div class="resep-table">
        <table class="table">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Rating</th>
                    <th>Suka</th>
                    <th>Komentar</th>
                    <th>Tingkat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reseps as $resep)
                <tr style="{{ $resep->status === 'rejected' ? 'background:#FFF5F5;' : ($resep->status === 'pending' ? 'background:#FFFBEB;' : '') }}">
                    <td>
                        @if($resep->gambar)
                            <img src="{{ asset('storage/' . $resep->gambar) }}" alt="{{ $resep->judul }}" class="resep-thumb">
                        @else
                            <div class="resep-thumb" style="background:#f0f0f0; display:flex; align-items:center; justify-content:center; font-size:1.5rem;">🍲</div>
                        @endif
                    </td>
                    <td>
                        <strong>{{ $resep->judul }}</strong>
                        <div style="font-size:0.8rem; color:#999;">{{ $resep->created_at->format('d M Y') }}</div>
                        {{-- Tampilkan alasan tolak langsung di bawah judul --}}
                        @if($resep->status === 'rejected' && $resep->alasan_tolak)
                            <div class="alasan-cell">
                                <i class='bx bx-error-circle'></i>
                                {{ Str::limit($resep->alasan_tolak, 80) }}
                            </div>
                        @endif
                    </td>
                    <td>{{ $resep->kategori->nama_kategori }}</td>
                    <td>
                        @if($resep->status === 'approved')
                            <span class="status-badge status-approved">
                                <i class='bx bx-check'></i> Disetujui
                            </span>
                        @elseif($resep->status === 'pending')
                            <span class="status-badge status-pending">
                                <i class='bx bx-time-five'></i> Menunggu
                            </span>
                        @else
                            <span class="status-badge status-rejected">
                                <i class='bx bx-x'></i> Ditolak
                            </span>
                        @endif
                    </td>
                    <td><i class='bx bxs-star' style='color:#ffd93d'></i> {{ number_format($resep->averageRating(), 1) }}</td>
                    <td><i class='bx bxs-heart' style="color:red"></i> {{ $resep->totalSuka() }}</td>
                    <td><i class='bx bx-message-dots'></i> {{ $resep->totalKomentar() }}</td>
                    <td>
                        @if($resep->tingkat_kesulitan == 'mudah')
                            <span class="badge badge-success">Mudah</span>
                        @elseif($resep->tingkat_kesulitan == 'sedang')
                            <span class="badge badge-warning">Sedang</span>
                        @else
                            <span class="badge badge-danger">Sulit</span>
                        @endif
                    </td>
                    <td>
                        <div class="actions">
                            {{-- Tombol lihat hanya untuk approved, atau milik sendiri --}}
                            @if($resep->status === 'approved')
                                <a href="{{ route('resep.show', $resep->id) }}" class="btn btn-sm btn-secondary" title="Lihat">
                                    <i class='bx bx-show-alt'></i>
                                </a>
                            @endif
                            <a href="{{ route('user.resep.edit', $resep->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                <i class='bx bx-edit'></i>
                            </a>
                            <form action="{{ route('user.resep.destroy', $resep->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus resep ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                    <i class='bx bx-trash-alt'></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="empty-state">
        <h3>Kamu belum punya resep</h3>
        <p>Mulai bagikan resep favorit kamu sekarang!</p>
        <a href="{{ route('user.resep.create') }}" class="btn btn-primary">Upload Resep</a>
    </div>
@endif

@endsection