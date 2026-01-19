<?php
namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Resep;
use Illuminate\Http\Request;

class ResepController extends Controller
{
    // Menampilkan daftar resep
    public function index()
    {
        $resep = Resep::with('kategori')->get();
        return view('resep.index', compact('resep'));
    }

    // Form tambah resep
    public function create()
    {
        $kategori = Kategori::all();
        return view('resep.create', compact('kategori'));
    }

    // Simpan resep baru
    public function store(Request $request)
    {
        $request->validate([
            'judul'             => 'required|string|max:150',
            'id_kategori'       => 'required|exists:kategori,id_kategori',
            'deskripsi'         => 'nullable|string',
            'waktu_masak'       => 'nullable|string|max:50',
            'tingkat_kesulitan' => 'nullable|in:mudah,sedang,sulit',
            'video_url'         => 'nullable|url',
            'gambar'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('resep', 'public');
        }

        Resep::create($data);

        return redirect()->route('resep.index')->with('success', 'Resep berhasil ditambahkan!');
    }

    // Form edit resep
    public function edit($id_resep)
    {
        $resep    = Resep::findOrFail($id_resep);
        $kategori = Kategori::all();
        return view('resep.edit', compact('resep', 'kategori'));
    }

    // Update resep
    public function update(Request $request, $id_resep)
    {
        $request->validate([
            'judul'             => 'required|string|max:150',
            'id_kategori'       => 'required|exists:kategori,id_kategori',
            'deskripsi'         => 'nullable|string',
            'waktu_masak'       => 'nullable|string|max:50',
            'tingkat_kesulitan' => 'nullable|in:mudah,sedang,sulit',
            'video_url'         => 'nullable|url',
            'gambar'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $resep = Resep::findOrFail($id_resep);
        $data  = $request->all();

        // Upload gambar baru jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($resep->gambar && file_exists(storage_path('app/public/' . $resep->gambar))) {
                unlink(storage_path('app/public/' . $resep->gambar));
            }

            $data['gambar'] = $request->file('gambar')->store('resep', 'public');
        } else {
            unset($data['gambar']); // jangan overwrite gambar lama
        }

        $resep->update($data);

        return redirect()->route('resep.index')->with('success', 'Resep berhasil diperbarui!');
    }

    // Hapus resep
    public function destroy($id_resep)
    {
        $resep = Resep::findOrFail($id_resep);

        // Hapus gambar lama
        if ($resep->gambar && file_exists(storage_path('app/public/' . $resep->gambar))) {
            unlink(storage_path('app/public/' . $resep->gambar));
        }

        $resep->delete();

        return redirect()->route('resep.index')->with('success', 'Resep berhasil dihapus!');
    }
}
