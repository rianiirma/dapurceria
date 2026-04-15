<?php
namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Resep;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Menampilkan daftar resep di halaman depan
     */
    public function index(Request $request)
    {
        $query = Resep::with(['user', 'kategori'])
            ->withCount('sukas')
            ->where('status', 'approved');

        // Filter search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        }

        // Filter kategori
        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        // Urutkan terbaru
        $query->latest();

        // 10 resep per halaman
        $reseps    = $query->paginate(10)->withQueryString();
        $kategoris = Kategori::orderBy('nama_kategori')->get();

        return view('home', compact('reseps', 'kategoris'));
    }

    /**
     * Menampilkan detail resep (Fungsi yang tadi hilang)
     */
    public function show($id)
    {
        // Mencari resep berdasarkan ID, jika tidak ada akan muncul 404
        // Mengikutkan relasi agar data user, kategori, dan komentar tampil
        $resep = Resep::with(['user', 'kategori', 'komentars.user'])
            ->withCount('sukas')
            ->findOrFail($id);

        // Mengarahkan ke view resources/views/resep/show.blade.php
        return view('resep.show', compact('resep'));
    }
}
