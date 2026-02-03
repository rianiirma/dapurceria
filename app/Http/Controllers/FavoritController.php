<?php
namespace App\Http\Controllers;

use App\Models\Favorit;
use App\Models\Resep;

class FavoritController extends Controller
{
    // Toggle favorit
    public function toggle($resepId)
    {
        Resep::findOrFail($resepId); // Pastikan resep ada

        $favorit = Favorit::where('id_user', auth()->id())
            ->where('id_resep', $resepId)
            ->first();

        if ($favorit) {
            // Sudah favorit, hapus
            $favorit->delete();
            $message = 'Dihapus dari favorit!';
        } else {
            // Belum favorit, tambah
            Favorit::create([
                'id_user'  => auth()->id(),
                'id_resep' => $resepId,
            ]);
            $message = 'Ditambahkan ke favorit!';
        }

        return back()->with('success', $message);
    }

    // Lihat daftar favorit
    public function index()
    {
        $favorits = Favorit::where('id_user', auth()->id())
            ->with('resep.kategori')
            ->latest()
            ->get();

        return view('user.favorit', compact('favorits'));
    }
}
