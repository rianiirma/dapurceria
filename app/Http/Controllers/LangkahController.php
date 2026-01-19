<?php
namespace App\Http\Controllers;

use App\Models\Langkah;
use App\Models\Resep;
use Illuminate\Http\Request;

class LangkahController extends Controller
{
    public function index()
    {
        $langkah = Langkah::with('resep')->get();
        return view('langkah.index', compact('langkah'));
    }

    public function create()
    {
        $resep = Resep::all();
        return view('langkah.create', compact('resep'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_resep'          => 'required',
            'urutan'            => 'required|integer',
            'deskripsi_langkah' => 'required|string',
        ]);

        Langkah::create([
            'id_resep'          => $request->id_resep,
            'urutan'            => $request->urutan,
            'deskripsi_langkah' => $request->deskripsi_langkah,
        ]);

        return redirect()->route('langkah.index')
            ->with('success', 'Langkah berhasil ditambahkan!');
    }

    public function edit($id_langkah)
    {
        $langkah = Langkah::where('id_langkah', $id_langkah)->firstOrFail();
        $resep   = Resep::all();
        return view('langkah.edit', compact('langkah', 'resep'));
    }

    public function update(Request $request, $id_langkah)
    {
        $request->validate([
            'id_resep'          => 'required',
            'urutan'            => 'required|integer',
            'deskripsi_langkah' => 'required|string',
        ]);

        $langkah = Langkah::where('id_langkah', $id_langkah)->firstOrFail();

        $langkah->id_resep          = $request->id_resep;
        $langkah->urutan            = $request->urutan;
        $langkah->deskripsi_langkah = $request->deskripsi_langkah;
        $langkah->save();

        return redirect()->route('langkah.index')
            ->with('success', 'Langkah berhasil diperbarui!');
    }

    public function destroy($id_langkah)
    {
        $langkah = Langkah::where('id_langkah', $id_langkah)->firstOrFail();
        $langkah->delete();

        return redirect()->route('langkah.index')
            ->with('success', 'Langkah berhasil dihapus!');
    }
}
