<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Komentar;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'resep_id'     => 'required|exists:reseps,id',
            'isi_komentar' => 'required|string|max:1000',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['is_read'] = false; // Notifikasi untuk admin

        Komentar::create($validated);

        return redirect()->back()
            ->with('success', 'Komentar berhasil ditambahkan!');
    }

    public function destroy(Komentar $komentar)
    {
        // Pastikan user hanya bisa hapus komentar sendiri
        if ($komentar->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $komentar->delete();

        return redirect()->back()
            ->with('success', 'Komentar berhasil dihapus!');
    }
}
