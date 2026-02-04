<?php
namespace App\Http\Controllers;

use App\Models\Resep;
use App\Models\Suka;

class SukaController extends Controller
{
    public function toggle($resepId)
    {
        Resep::findOrFail($resepId); 

        $suka = Suka::where('id_user', auth()->id())
            ->where('id_resep', $resepId)
            ->first();

        if ($suka) {
            
            $suka->delete();
            $message = 'Suka dihapus!';
        } else {
            Suka::create([
                'id_user'  => auth()->id(),
                'id_resep' => $resepId,
            ]);
            $message = 'Resep disukai!';
        }
        return back()->with('success', $message);
    }
}
