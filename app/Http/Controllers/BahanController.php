<?php
namespace App\Http\Controllers;

use App\Models\Bahan;
use App\Models\Resep;
use Illuminate\Http\Request;

class BahanController extends Controller
{
    public function index()
    {
        $bahan = Bahan::with('resep')->get();
        return view('bahan.index', compact('bahan'));
    }

    public function create()
    {
        $resep = Resep::all();
        return view('bahan.create', compact('resep'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_resep'   => 'required',
            'nama_bahan' => 'required|string|max:150',
            'takaran'    => 'nullable|string|max:100',
        ]);

        Bahan::create([
            'id_resep'   => $request->id_resep,
            'nama_bahan' => $request->nama_bahan,
            'takaran'    => $request->takaran,
        ]);

        return redirect()->route('bahan.index')
            ->with('success', 'Bahan berhasil ditambahkan!');
    }

    public function edit($id_bahan)
    {
        $bahan = Bahan::where('id_bahan', $id_bahan)->firstOrFail();
        $resep = Resep::all();
        return view('bahan.edit', compact('bahan', 'resep'));
    }

    public function update(Request $request, $id_bahan)
    {
        $request->validate([
            'id_resep'   => 'required',
            'nama_bahan' => 'required|string|max:150',
            'takaran'     => 'nullable|string|max:100',
        ]);

        $bahan = Bahan::where('id_bahan', $id_bahan)->firstOrFail();

        $bahan->id_resep   = $request->id_resep;
        $bahan->nama_bahan = $request->nama_bahan;
        $bahan->takaran     = $request->takaran;
        $bahan->save();

        return redirect()->route('bahan.index')
            ->with('success', 'Bahan berhasil diperbarui!');
    }

    public function destroy($id_bahan)
    {
        $bahan = Bahan::where('id_bahan', $id_bahan)->firstOrFail();
        $bahan->delete();

        return redirect()->route('bahan.index')
            ->with('success', 'Bahan berhasil dihapus!');
    }
}
