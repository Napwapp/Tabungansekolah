<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ProfileAdminController extends Controller
{
    function profiladmin()
    {
        $admin = auth()->user(); //Mengambil data admin yang sedang login
        return view('pointakses.admin.profiladmin', compact('admin'));
    }

    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'namalengkap' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . Auth::id(),
            'email' => 'required|string|unique:users,email,' . Auth::id(),
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
        ]);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaFile = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('picture/accounts'), $namaFile);

            // Hapus foto lama jika ada
            if (Auth::user()->gambar && file_exists(public_path('picture/accounts/' . Auth::user()->gambar))) {
                unlink(public_path('picture/accounts/' . Auth::user()->gambar));
            }

            Auth::user()->update(['gambar' => $namaFile]); // Simpan nama file ke database
        }


        // Ambil user yang sedang login
        $user = Auth::user();
        $user->namalengkap = $request->namalengkap;
        $user->username = $request->username;    
        $user->save();

        // Return response JSON
        return response()->json(['success' => true, 'message' => 'Profil berhasil diperbarui']);
    }
}
