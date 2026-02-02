<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Favorit;
use App\Models\Resep;
use Illuminate\Http\Request;

class FavoritController extends Controller
{
    public function index()
    {
        $favorits = auth()->user()
            ->favorits()
            ->with(['resep.user', 'resep.kategori'])
            ->latest()
            ->paginate(12);

        return view('user.favorit.index', compact('favorits'));
    }

    public function toggle(Resep $resep)
    {
        $favorit = Favorit::where('user_id', auth()->id())
            ->where('resep_id', $resep->id)
            ->first();

        if ($favorit) {
            // Remove from favorit
            $favorit->delete();
            $message   = 'Resep dihapus dari favorit!';
            $favorited = false;
        } else {
            // Add to favorit
            Favorit::create([
                'user_id'  => auth()->id(),
                'resep_id' => $resep->id,
            ]);
            $message   = 'Resep ditambahkan ke favorit!';
            $favorited = true;
        }

        if (request()->wantsJson()) {
            return response()->json([
                'success'       => true,
                'favorited'     => $favorited,
                'total_favorit' => $resep->totalFavorit(),
            ]);
        }

        return redirect()->back()->with('success', $message);
    }
}
