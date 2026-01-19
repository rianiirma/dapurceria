@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">Tambah Langkah Memasak</h3>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('langkah.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Resep</label>
                    <select name="id_resep" class="form-control" required>
                        <option value="">-- Pilih Resep --</option>
                        @foreach($resep as $r)
                        <option value="{{ $r->id_resep }}">{{ $r->judul }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Urutan</label>
                    <input type="number" name="urutan" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Deskripsi Langkah</label>
                    <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('langkah.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection

