@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">Data Langkah Memasak</h3>

    <a href="{{ route('langkah.create') }}" class="btn btn-primary mb-3">Tambah Langkah</a>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Resep</th>
                        <th>Urutan</th>
                        <th>Langkah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($langkah as $key => $l)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $l->resep->nama_resep }}</td>
                        <td>{{ $l->urutan }}</td>
                        <td>{{ $l->deskripsi }}</td>
                        <td>
                            <a href="{{ route('langkah.edit', $l->id_langkah) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('langkah.destroy', $l->id_langkah) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

