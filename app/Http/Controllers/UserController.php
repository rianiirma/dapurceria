<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('user.index', compact('user'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required',
        ]);

        User::create([
            'nama'     => $request->nama,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('user.index')
            ->with('success', 'User berhasil ditambahkan!');
    }

    public function edit($id_user)
    {
        $user = User::where('id_user', $id_user)->firstOrFail();
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id_user)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $id_user . ',id_user',
            'password' => 'nullable|min:6',
            'role'     => 'required',
        ]);

        $user = User::where('id_user', $id_user)->firstOrFail();

        $user->nama  = $request->nama;
        $user->email = $request->email;
        $user->role  = $request->role;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user.index')
            ->with('success', 'User berhasil diperbarui!');
    }

    public function destroy($id_user)
    {
        $user = User::where('id_user', $id_user)->firstOrFail();
        $user->delete();

        return redirect()->route('user.index')
            ->with('success', 'User berhasil dihapus!');
    }
}
