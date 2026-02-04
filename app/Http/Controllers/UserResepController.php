<?php
namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Resep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserResepController extends Controller
{
    public function create()
    {
        $kategoris = Kategori::all();
        return view('user.resep.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_kategori'       => 'required|exists:kategoris,id',
            'judul'             => 'required|string|max:255',
            'deskripsi'         => 'required|string',
            'bahan'             => 'required|string',
            'langkah_langkah'   => 'required|string',
            'gambar'            => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'video_url'         => 'nullable|url',
            'waktu_memasak'     => 'required|integer|min:1',
            'porsi'             => 'required|integer|min:1',
            'tingkat_kesulitan' => 'required|in:mudah,sedang,sulit',
        ]);

        $validated['id_user'] = auth()->id();

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('resep', 'public');
        }

        Resep::create($validated);

        return redirect()->route('user.resep.my')->with('success', 'Resep berhasil diupload!');
    }

    public function myResep()
    {
        $reseps = Resep::where('id_user', auth()->id())
            ->with(['kategori', 'ratings'])
            ->latest()
            ->get();

        return view('user.resep.my-resep', compact('reseps'));
    }

    public function edit($id)
    {
        $resep     = Resep::where('id_user', auth()->id())->findOrFail($id);
        $kategoris = Kategori::all();

        return view('user.resep.edit', compact('resep', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $resep = Resep::where('id_user', auth()->id())->findOrFail($id);

        $validated = $request->validate([
            'id_kategori'       => 'required|exists:kategoris,id',
            'judul'             => 'required|string|max:255',
            'deskripsi'         => 'required|string',
            'bahan'             => 'required|string',
            'langkah_langkah'   => 'required|string',
            'gambar'            => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'video_url'         => 'nullable|url',
            'waktu_memasak'     => 'required|integer|min:1',
            'porsi'             => 'required|integer|min:1',
            'tingkat_kesulitan' => 'required|in:mudah,sedang,sulit',
        ]);

        if ($request->hasFile('gambar')) {
            if ($resep->gambar) {
                Storage::disk('public')->delete($resep->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('resep', 'public');
        }

        $resep->update($validated);

        return redirect()->route('user.resep.my')->with('success', 'Resep berhasil diupdate!');
    }

    public function destroy($id)
    {
        $resep = Resep::where('id_user', auth()->id())->findOrFail($id);

        if ($resep->gambar) {
            Storage::disk('public')->delete($resep->gambar);
        }

        $resep->delete();

        return redirect()->route('user.resep.my')->with('success', 'Resep berhasil dihapus!');
    }
}
