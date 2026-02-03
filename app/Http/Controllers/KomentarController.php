<?php
namespace App\Http\Controllers;

use App\Models\Komentar;
use App\Models\Resep;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    // Store komentar
    public function store(Request $request, $resepId)
    {
        $request->validate([
            'isi_komentar' => 'required|string|max:1000',
        ]);

        Resep::findOrFail($resepId); // Pastikan resep ada

        Komentar::create([
            'id_user'      => auth()->id(),
            'id_resep'     => $resepId,
            'isi_komentar' => $request->isi_komentar,
            'is_read'      => false,
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }
}
