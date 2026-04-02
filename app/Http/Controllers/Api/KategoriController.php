<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::withCount('reseps')->get();

        return response()->json([
            'success' => true,
            'data'    => $kategoris,
        ]);
    }
}
