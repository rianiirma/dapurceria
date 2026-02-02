<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Resep;
use App\Models\Suka;
use Illuminate\Http\Request;

class SukaController extends Controller
{
    public function toggle(Resep $resep)
    {
        $suka = Suka::where('user_id', auth()->id())
            ->where('resep_id', $resep->id)
            ->first();

        if ($suka) {
            // Unlike
            $suka->delete();
            $message = 'Resep dihapus dari suka!';
            $liked   = false;
        } else {
            // Like
            Suka::create([
                'user_id'  => auth()->id(),
                'resep_id' => $resep->id,
            ]);
            $message = 'Resep ditambahkan ke suka!';
            $liked   = true;
        }

        if (request()->wantsJson()) {
            return response()->json([
                'success'    => true,
                'liked'      => $liked,
                'total_suka' => $resep->totalSuka(),
            ]);
        }

        return redirect()->back()->with('success', $message);
    }
}
