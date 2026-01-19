<?php
namespace App\Http\Controllers;

use App\Models\Komentar;
use App\Models\Resep;
use App\Models\User;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    public function index()
    {
        $komentar = Komentar::with('user', 'resep')->get();
        return view('komentar.index', compact('komentar'));
    }

    public function create()
    {
        $user  = User::all();
        $resep = Resep::all();
        return view('komentar.create', compact('user', 'resep'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user'      => 'required',
            'id_resep'     => 'required',
            'isi_komentar' => 'required|string',
        ]);

        Komentar::create([
            'id_user'      => $request->id_user,
            'id_resep'     => $request->id_resep,
            'isi_komentar' => $request->isi_komentar,
        ]);

        return redirect()->route('komentar.index')
            ->with('success', 'Komentar berhasil ditambahkan!');
    }

    public function edit($id_komentar)
    {
        $komentar = Komentar::where('id_komentar', $id_komentar)->firstOrFail();
        $user     = User::all();
        $resep    = Resep::all();
        return view('komentar.edit', compact('komentar', 'user', 'resep'));
    }

    public function update(Request $request, $id_komentar)
    {
        $request->validate([
            'id_user'      => 'required',
            'id_resep'     => 'required',
            'isi_komentar' => 'required|string',
        ]);

        $komentar = Komentar::where('id_komentar', $id_komentar)->firstOrFail();

        $komentar->id_user      = $request->id_user;
        $komentar->id_resep     = $request->id_resep;
        $komentar->isi_komentar = $request->isi_komentar;
        $komentar->save();

        return redirect()->route('komentar.index')
            ->with('success', 'Komentar berhasil diperbarui!');
    }

    public function destroy($id_komentar)
    {
        $komentar = Komentar::where('id_komentar', $id_komentar)->firstOrFail();
        $komentar->delete();

        return redirect()->route('komentar.index')
            ->with('success', 'Komentar berhasil dihapus!');
    }
}
