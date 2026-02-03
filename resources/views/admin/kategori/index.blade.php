@extends('layouts.admin')

@section('title', 'Kelola Kategori')
@section('page-title', 'Kelola Kategori')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>📁 Daftar Kategori</h3>
        <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">+ Tambah Kategori</a>
    </div>

    @if($kategoris->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th>Jumlah Resep</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kategoris as $index => $kategori)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $kategori->nama_kategori }}</strong></td>
                    <td>{{ Str::limit($kategori->deskripsi ?? '-', 60) }}</td>
                    <td>{{ $kategori->reseps_count }} resep</td>
                    <td>
                        <div style="display: flex; gap: 0.5rem;">
                            <a href="{{ route('admin.kategori.edit', $kategori->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.kategori.destroy', $kategori->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="padding: 2rem; text-align: center; color: #999;">Belum ada kategori. Tambahkan kategori pertama Anda!</p>
    @endif
</div>
@endsection