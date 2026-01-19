<!DOCTYPE html>
<html>
<head>
    <title>Data Favorit</title>
</head>
<body>

    <h2>Data Favorit</h2>

    <a href="{{ route('favorit.create') }}">+ Tambah Favorit</a>
    <br><br>

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Resep</th>
            <th>Aksi</th>
        </tr>

        @foreach($favorit as $f)
        <tr>
            <td>{{ $f->id_favorit }}</td>
            <td>{{ $f->user->name ?? '-' }}</td>
            <td>{{ $f->resep->judul ?? '-' }}</td>
            <td>
                <form action="{{ route('favorit.destroy', $f->id_favorit) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

</body>
</html>

