<?php
namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Resep;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $kategoris = Kategori::all();

        $query = Resep::with(['user', 'kategori'])
            ->where('status', 'approved');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%")
                    ->orWhere('bahan', 'like', "%{$search}%");
            });
        }

        if ($request->filled('kategori')) {
            $query->where('id_kategori', $request->kategori);
        }

        $reseps = $query->latest()->paginate(12);

        return view('home', compact('reseps', 'kategoris'));
    }

    public function show($id)
    {
        $resep = Resep::with(['user', 'kategori', 'komentars.user', 'ratings'])
            ->findOrFail($id);

        if ($resep->status !== 'approved') {
            $isOwner = auth()->check() && auth()->id() === $resep->id_user;
            $isAdmin = auth()->check() && auth()->user()->role === 'admin';

            if (! $isOwner && ! $isAdmin) {
                abort(404);
            }
        }

        return view('resep.show', compact('resep'));
    }
}
