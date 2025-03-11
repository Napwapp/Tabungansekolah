<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\DataKelas;
use Illuminate\Http\Request;

class KelasAdminController extends Controller
{
    // Menampilkan data keuangan berdasarkan kelas
    public function kelasmin(Request $request)
    {
        $kelas = $request->input('kelas', '10'); // Default kelas 10 jika tidak dipilih
        $jurusan = $request->input('jurusan', ''); // Default semua jurusan

        // Query data berdasarkan kelas dan jurusan (jika dipilih)
        $query = DB::table('datakelas');

        if ($jurusan) {
            $query->where('jurusan', $jurusan);
        }
        
        if ($kelas) {
            $query->where('kelas', $kelas);
        }

        $datakelas = $query->get();

        return view('pointakses.admin.kelasmin', compact('datakelas', 'kelas'));
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'kelas' => 'required|in:10,11,12',
            'jurusan' => 'required|string',
            'pemasukan' => 'required|numeric',
            'pengeluaran' => 'required|numeric',
            'dana' => 'required|numeric',
        ]);

        $akhir = ($request->dana + $request->pemasukan) - $request->pengeluaran;

        DataKelas::create([
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
            'pemasukan' => $request->pemasukan,
            'pengeluaran' => $request->pengeluaran,
            'dana' => $request->dana,
            'akhir' => $akhir,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }

    // Menghapus data
    public function hapus($id)
    {
        try {
            DataKelas::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'Data berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data!');
        }
    }
}
