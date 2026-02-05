@extends('layouts.admin')

@section('title', 'Kelola Resep')
@section('page-title', 'Kelola Resep')

@section('content')
<!-- Filter Section -->
<div class="card" style="margin-bottom: 1.5rem;">
    <form action="{{ route('admin.resep.index') }}" method="GET" style="padding: 1.5rem;">
        <div style="display: grid; grid-template-columns: 1fr 1fr auto auto; gap: 1rem; align-items: end;">
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Cari Resep</label>
                <input type="text" name="search" class="form-control" placeholder="Cari resep..." value="{{ request('search') }}">
            </div>
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Kategori</label>
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
                <a href="{{ route('admin.resep.index') }}" class="btn btn-secondary">Reset</a>
            @endif
        </div>
    </form>
</div>

<div class="card">
    <div class="card-header">
        <h3><i class='bx bx-food-menu'></i> Daftar Resep</h3>
        <a href="{{ route('admin.resep.create') }}" class="btn btn-primary">+ Tambah Resep</a>
    </div>

    @if($reseps->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Penulis</th>
                    <th>Rating</th>
                    <th>Suka</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reseps as $resep)
                <tr>
                    <td>
                        @if($resep->gambar)
                            <img src="{{ asset('storage/' . $resep->gambar) }}" alt="{{ $resep->judul }}" style="width: 60px; height: 45px; object-fit: cover; border-radius: 5px;">
                        @else
                            <div style="width: 60px; height: 45px; background: #f0f0f0; border-radius: 5px; display: flex; align-items: center; justify-content: center;">🍲</div>
                        @endif
                    </td>
                    <td>
                        <strong>{{ $resep->judul }}</strong>
                        <div style="font-size: 0.75rem; color: #999;">{{ $resep->created_at->format('d M Y') }}</div>
                    </td>
                    <td>{{ $resep->kategori->nama_kategori }}</td>
                    <td>{{ $resep->user->name }}</td>
                    <td><i class='bx bxs-star' style='color:#ffd93d'></i> {{ number_format($resep->averageRating(), 1) }}</td>
                    <td><i class='bx bxs-heart' style='color:#ff1515'></i> {{ $resep->totalSuka() }}</td>
                    <td>
                        <div style="display: flex; gap: 0.5rem;">
                            <a href="{{ route('resep.show', $resep->id) }}" class="btn btn-sm btn-secondary"><i class='bx bx-show'></i></a>
                            <a href="{{ route('admin.resep.edit', $resep->id) }}" class="btn btn-sm btn-warning"><i class='bx bx-edit-alt'></i></a>
                            <form action="{{ route('admin.resep.destroy', $resep->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus resep ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class='bx bx-trash'></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div style="padding: 1.5rem; display: flex; justify-content: center;">
            {{ $reseps->links('pagination::custom') }}  
        </div>
    @else
        <p style="padding: 2rem; text-align: center; color: #999;">Tidak ada resep ditemukan</p>
    @endif
</div>
@endsection