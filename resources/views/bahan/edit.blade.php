@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">Edit Bahan</h3>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('bahan.update', $bahan->id_bahan) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Resep</label>
                    <select name="id_resep" class="form-control" required>
                        @foreach($resep as $r)
                        <option value="{{ $r->id_resep }}" {{ $bahan->id_resep == $r->id_resep ? 'selected' : '' }}>
                            {{ $r->judul }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Nama Bahan</label>
                    <input type="text" name="nama_bahan" class="form-control" value="{{ old('nama_bahan', $bahan->nama_bahan) }}" required>
                </div>

                <div class="mb-3">
                    <label>Takaran</label>
                    <input type="text" name="takaran" class="form-control" value="{{ old('takaran', $bahan->takaran) }}">
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('bahan.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection

