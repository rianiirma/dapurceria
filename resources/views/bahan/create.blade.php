@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">Tambah Bahan</h3>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('bahan.store') }}" method="POST">
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
                    <label>Nama Bahan</label>
                    <input type="text" name="nama_bahan" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Takaran</label>
                    <input type="text" name="takaran" class="form-control" placeholder="Contoh: 2 sendok, 1 kg, dll">
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('bahan.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection

