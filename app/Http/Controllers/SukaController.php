<?php
namespace App\Http\Controllers;

use App\Models\Resep;
use App\Models\Suka;

class SukaController extends Controller
{
    // Toggle suka
    public function toggle($resepId)
    {
        Resep::findOrFail($resepId); // Pastikan resep ada

        $suka = Suka::where('id_user', auth()->id())
            ->where('id_resep', $resepId)
            ->first();

        if ($suka) {
            // Sudah suka, hapus (unlike)
            $suka->delete();
            $message = 'Suka dihapus!';
        } else {
            // Belum suka, tambah
            Suka::create([
                'id_user'  => auth()->id(),
                'id_resep' => $resepId,
            ]);
            $message = 'Resep disukai!';
        }

        return back()->with('success', $message);
    }
}
