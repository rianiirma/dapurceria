<?php
namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Resep;
use Illuminate\Http\Request;

class HomeController extends Controller
{
   
    public function index(Request $request)
    {
        $query = Resep::with(['user', 'kategori', 'ratings']);

        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('id_kategori', $request->kategori);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $reseps    = $query->latest()->paginate(12);
        $kategoris = Kategori::all();

        return view('home', compact('reseps', 'kategoris'));
    }

    public function show($id)
    {
        $resep = Resep::with(['user', 'kategori', 'komentars.user', 'ratings'])->findOrFail($id);

        return view('resep.show', compact('resep'));
    }
}
