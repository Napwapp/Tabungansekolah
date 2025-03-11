<?php

namespace App\Http\Controllers;

use App\Models\Tabungan;
use Illuminate\Http\Request;

class TabunganController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
            'saldo' => 'required|numberic'
        ]);

        Tabungan::create($request->all());

        return redirect()->back()->with('succes', 'Tabungan berhasil ditambahkan');
    }

    public function index($kelas_id)
    {
        $tabungans = Tabungan::where('kelas_id', $kelas_id)->get();
        return view('pointakses.admin.tabungan-kelas-admin', compact('tabungans'));
    }
    public function getTabunganData()
    {
        $data = Tabungan::selectRaw("MONTH(created_at) as bulan, SUM(jumlah) as total")
            ->whereYear('created_at', date('Y')) // Data hanya tahun ini
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Format data agar bisa digunakan di frontend
        $tabunganData = array_fill(0, 12, 0);
        foreach ($data as $d) {
            $tabunganData[$d->bulan - 1] = $d->total;
        }

        return response()->json($tabunganData);
    }
}
