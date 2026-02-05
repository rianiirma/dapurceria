@extends('layouts.admin')

@section('title', 'Tambah Kategori')
@section('page-title', 'Tambah Kategori')

@section('content')
<div class="card">
    <div class="card-header">
        <h3><i class='bx-category-alt'></i> Tambah Kategori</h3>
    </div>

    <form action="{{ route('admin.kategori.store') }}" method="POST" style="padding: 1.5rem;">
        @csrf

        <div class="form-group">
            <label for="nama_kategori">Nama Kategori *</label>
            <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" value="{{ old('nama_kategori') }}" required autofocus>
            @error('nama_kategori')
                <span style="color: #ff6b6b; font-size: 0.875rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control">{{ old('deskripsi') }}</textarea>
            <span style="font-size: 0.875rem; color: #666;">Opsional: Jelaskan tentang kategori ini</span>
            @error('deskripsi')
                <span style="color: #ff6b6b; font-size: 0.875rem;">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection