@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('content')
<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <h4>Total Pengguna</h4>
        <div class="stat-value">{{ $totalUsers }}</div>
        <p style="color: #718096; font-size: 0.875rem; margin-top: 0.5rem;">Pengguna terdaftar</p>
    </div>

    <div class="stat-card" style="border-left-color: #51cf66;">
        <h4>Total Resep</h4>
        <div class="stat-value">{{ $totalReseps }}</div>
        <p style="color: #718096; font-size: 0.875rem; margin-top: 0.5rem;">Resep tersedia</p>
    </div>

    <div class="stat-card" style="border-left-color: #ffd43b;">
        <h4>Total Komentar</h4>
        <div class="stat-value">{{ $totalKomentars }}</div>
        <p style="color: #718096; font-size: 0.875rem; margin-top: 0.5rem;">Komentar masuk</p>
    </div>

    <div class="stat-card" style="border-left-color: #339af0;">
        <h4>Rata-rata Rating</h4>
        <div class="stat-value">{{ number_format($avgRating, 1) }}</div>
        <p style="color: #718096; font-size: 0.875rem; margin-top: 0.5rem;">Dari semua resep</p>
    </div>
</div>

<!-- Notifikasi Komentar Baru -->
<div class="card">
    <div class="card-header">
        <h3>💬 Komentar Belum Dibaca ({{ $totalUnreadKomentars }})</h3>
        @if($totalUnreadKomentars > 0)
            <form action="{{ route('admin.komentar.readAll') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm btn-success">Tandai Semua Sudah Dibaca</button>
            </form>
        @endif
    </div>

    @if($unreadKomentars->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Resep</th>
                    <th>Komentar</th>
                    <th>Waktu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($unreadKomentars as $komentar)
                <tr style="background: #fff3cd;">
                    <td><strong>{{ $komentar->user->name }}</strong></td>
                    <td>{{ Str::limit($komentar->resep->judul, 40) }}</td>
                    <td>{{ Str::limit($komentar->isi_komentar, 60) }}</td>
                    <td>{{ $komentar->created_at->diffForHumans() }}</td>
                    <td>
                        <div style="display: flex; gap: 0.5rem;">
                            <a href="{{ route('resep.show', $komentar->resep->id) }}" class="btn btn-sm btn-secondary">Lihat</a>
                            <form action="{{ route('admin.komentar.read', $komentar->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">Tandai Dibaca</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if($totalUnreadKomentars > 5)
            <div style="padding: 1rem; text-align: center; border-top: 1px solid #e2e8f0;">
                <a href="{{ route('admin.komentar.index') }}" class="btn btn-primary">Lihat Semua Komentar</a>
            </div>
        @endif
    @else
        <p style="padding: 2rem; text-align: center; color: #999;">Semua komentar sudah dibaca! </p>
    @endif
</div>

<!-- Resep Terbaru -->
<div class="card">
    <div class="card-header">
        <h3>🍲 Resep Terbaru</h3>
        <a href="{{ route('admin.resep.index') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
    </div>

    @if($latestReseps->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Penulis</th>
                    <th>Rating</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($latestReseps as $resep)
                <tr>
                    <td><strong>{{ $resep->judul }}</strong></td>
                    <td>{{ $resep->kategori->nama_kategori }}</td>
                    <td>{{ $resep->user->name }}</td>
                    <td>⭐ {{ number_format($resep->averageRating(), 1) }}</td>
                    <td>{{ $resep->created_at->format('d M Y') }}</td>
                    <td>
                        <div style="display: flex; gap: 0.5rem;">
                            <a href="{{ route('resep.show', $resep->id) }}" class="btn btn-sm btn-secondary">
                                <i class='bx bx-show'></i></a>
                            <a href="{{ route('admin.resep.edit', $resep->id) }}" class="btn btn-sm btn-warning">
                                <i class='bx bx-edit'></i></a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="padding: 2rem; text-align: center; color: #999;">Belum ada resep</p>
    @endif
</div>
@endsection 