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
    .page-header h2 {
        color: #333;
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
        background: #f8f9fa;
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
    }
    .empty-state {
        text-align: center;
        padding: 3rem;
        color: #999;
    }
    .badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 12px;
        font-size: 0.75rem;
    }
    .badge-success {
        background: #d4edda;
        color: #155724;
    }
    .badge-warning {
        background: #fff3cd;
        color: #856404;
    }
    .badge-danger {
        background: #f8d7da;
        color: #721c24;
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <h2><i class='bx bx-book-bookmark'></i> Resep Saya</h2>
    <a href="{{ route('user.resep.create') }}" class="btn btn-primary">+ Upload Resep Baru</a>
</div>

@if($reseps->count() > 0)
    <div class="resep-table">
        <table class="table">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Rating</th>
                    <th>Suka</th>
                    <th>Komentar</th>
                    <th>Tingkat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reseps as $resep)
                <tr>
                    <td>
                        @if($resep->gambar)
                            <img src="{{ asset('storage/' . $resep->gambar) }}" alt="{{ $resep->judul }}" class="resep-thumb">
                        @else
                            <div class="resep-thumb" style="background: #f0f0f0; display: flex; align-items: center; justify-content: center;">🍲</div>
                        @endif
                    </td>
                    <td>
                        <strong>{{ $resep->judul }}</strong>
                        <div style="font-size: 0.875rem; color: #999;">
                            {{ $resep->created_at->format('d M Y') }}
                        </div>
                    </td>
                    <td>{{ $resep->kategori->nama_kategori }}</td>
                    <td><i class='bx bxs-star' style='color:#ffd93d'></i> {{ number_format($resep->averageRating(), 1) }}</td>
                    <td><i class='bx bxs-heart' style="color: red"></i> {{ $resep->totalSuka() }}</td>
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
                            <a href="{{ route('resep.show', $resep->id) }}" class="btn btn-sm btn-secondary"><i class='bx bx-show-alt'></i></a>
                            <a href="{{ route('user.resep.edit', $resep->id) }}" class="btn btn-sm btn-warning"><i class='bx bx-edit'></i></a>
                            <form action="{{ route('user.resep.destroy', $resep->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus resep ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class='bx bx-trash-alt'></i></button>
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
        <h3>Anda belum memiliki resep</h3>
        <p>Mulai bagikan resep favorit Anda sekarang!</p>
        <a href="{{ route('user.resep.create') }}" class="btn btn-primary">Upload Resep</a>
    </div>
@endif
@endsection