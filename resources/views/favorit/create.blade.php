<!DOCTYPE html>
<html>
<head>
    <title>Tambah Favorit</title>
</head>
<body>

    <h2>Tambah Favorit</h2>

    <form action="{{ route('favorit.store') }}" method="POST">
        @csrf

        <label>User:</label><br>
        <select name="id_user" required>
            <option value="">-- Pilih User --</option>
            @foreach($user as $u)
            <option value="{{ $u->id }}">{{ $u->name }}</option>
            @endforeach
        </select>
        <br><br>

        <label>Resep:</label><br>
        <select name="id_resep" required>
            <option value="">-- Pilih Resep --</option>
            @foreach($resep as $r)
            <option value="{{ $r->id_resep }}">{{ $r->judul }}</option>
            @endforeach
        </select>
        <br><br>

        <button type="submit">Simpan</button>
    </form>

    <br>
    <a href="{{ route('favorit.index') }}">Kembali</a>

</body>
</html>

