<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorit;
use App\Models\User;
use App\Models\Resep;

class FavoritController extends Controller
{
    public function index()
    {
        $favorit = Favorit::with('user', 'resep')->get();
        return view('favorit.index', compact('favorit'));
    }

    public function create()
    {
        $user = User::all();
        $resep = Resep::all();
        return view('favorit.create', compact('user', 'resep'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required',
            'id_resep' => 'required'
        ]);

        Favorit::create([
            'id_user' => $request->id_user,
            'id_resep' => $request->id_resep
        ]);

        return redirect()->route('favorit.index')
            ->with('success', 'Favorit berhasil ditambahkan!');
    }

    public function edit($id_favorit)
    {
        $favorit = Favorit::where('id_favorit', $id_favorit)->firstOrFail();
        $user = User::all();
        $resep = Resep::all();
        return view('favorit.edit', compact('favorit', 'user', 'resep'));
    }

    public function update(Request $request, $id_favorit)
    {
        $request->validate([
            'id_user' => 'required',
            'id_resep' => 'required'
        ]);

        $favorit = Favorit::where('id_favorit', $id_favorit)->firstOrFail();

        $favorit->id_user = $request->id_user;
        $favorit->id_resep = $request->id_resep;
        $favorit->save();

        return redirect()->route('favorit.index')
            ->with('success', 'Favorit berhasil diperbarui!');
    }

    public function destroy($id_favorit)
    {
        $favorit = Favorit::where('id_favorit', $id_favorit)->firstOrFail();
        $favorit->delete();

        return redirect()->route('favorit.index')
            ->with('success', 'Favorit berhasil dihapus!');
    }
}

