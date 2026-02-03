<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Resep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResepController extends Controller
{
    // List resep
    public function index(Request $request)
    {
        $query = Resep::with(['user', 'kategori', 'ratings']);

        // Filter by kategori
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('id_kategori', $request->kategori);
        }

        // Search
        if ($request->has('search') && $request->search != '') {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $reseps    = $query->latest()->paginate(10);
        $kategoris = Kategori::all();

        return view('admin.resep.index', compact('reseps', 'kategoris'));
    }

    // Create form
    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.resep.create', compact('kategoris'));
    }

    // Store
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

        // Upload gambar
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('resep', 'public');
        }

        Resep::create($validated);

        return redirect()->route('admin.resep.index')->with('success', 'Resep berhasil ditambahkan!');
    }

    // Edit form
    public function edit($id)
    {
        $resep     = Resep::findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.resep.edit', compact('resep', 'kategoris'));
    }

    // Update
    public function update(Request $request, $id)
    {
        $resep = Resep::findOrFail($id);

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

        // Upload gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($resep->gambar) {
                Storage::disk('public')->delete($resep->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('resep', 'public');
        }

        $resep->update($validated);

        return redirect()->route('admin.resep.index')->with('success', 'Resep berhasil diupdate!');
    }

    // Delete
    public function destroy($id)
    {
        $resep = Resep::findOrFail($id);

        // Hapus gambar
        if ($resep->gambar) {
            Storage::disk('public')->delete($resep->gambar);
        }

        $resep->delete();

        return redirect()->route('admin.resep.index')->with('success', 'Resep berhasil dihapus!');
    }
}
