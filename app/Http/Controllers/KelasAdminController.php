<?php

namespace App\Http\Controllers;

use App\Models\DataKelas;
use Illuminate\Http\Request;

class KelasAdminController extends Controller
{
    // Menampilkan data keuangan
    public function kelasmin() {
        $datakelas = DataKelas::all();
        return view('pointakses.admin.kelasmin', compact('datakelas'));
    }

    // Menyimpan data baru
    public function edit(Request $request) {
        $request->validate([
            'pemasukan' => 'required|numeric',
            'pengeluaran' => 'required|numeric',
            'dana' => 'required|numeric',
        ]);

        $akhir = ($request->dana + $request->pemasukan) - $request->pengeluaran;

        DataKelas::create([
            'pemasukan' => $request->pemasukan,
            'pengeluaran' => $request->pengeluaran,
            'dana' => $request->dana,
            'akhir' => $akhir,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }

    // Menghapus data
    public function hapus($id) {
        DataKelas::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}

