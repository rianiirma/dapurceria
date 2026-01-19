@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">Data Bahan</h3>

    <a href="{{ route('bahan.create') }}" class="btn btn-primary mb-3">Tambah Bahan</a>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Resep</th>
                        <th>Nama Bahan</th>
                        <th>Takaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bahan as $key => $b)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $b->resep->judul }}</td>
                        <td>{{ $b->nama_bahan }}</td>
                        <td>{{ $b->takaran }}</td>
                        <td>
                            <a href="{{ route('bahan.edit', $b->id_bahan) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('bahan.destroy', $b->id_bahan) }}" method="POST" style="display:inline;">
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

