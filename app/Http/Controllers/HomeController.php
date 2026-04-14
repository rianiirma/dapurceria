<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resep;
use App\Models\Kategori;
use App\Models\User;
use App\Models\Komentar;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Resep::with(['user', 'kategori'])
                      ->withCount('sukas')
                      ->where('status', 'approved');

        // Filter search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', '%'.$search.'%')
                  ->orWhere('deskripsi', 'like', '%'.$search.'%');
            });
        }

        // Filter kategori
        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        // Urutkan terbaru
        $query->latest();

        // ★ 10 resep per halaman — ke-11 masuk halaman 2
        $reseps    = $query->paginate(10)->withQueryString();
        $kategoris = Kategori::orderBy('nama_kategori')->get();

        return view('home', compact('reseps', 'kategoris'));
    }
}