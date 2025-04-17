<?php

namespace App\Http\Controllers;

use App\Models\Tabungan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        $tahun = now()->year;
        $bulanSekarang = now()->month;
        $bulanAktif = range(1, $bulanSekarang);

        $labels = [];
        $dataTopup = [];
        $dataMenabung = [];
        $dataPenarikan = [];

        foreach ($bulanAktif as $bulan) {
            $labels[] = Carbon::create()->month($bulan)->format('M'); // Jan, Feb, dst.

            $totalTopup = DB::table('transaksi_topup')
                ->withTrashed()
                ->whereYear('created_at', $tahun)
                ->whereMonth('created_at', $bulan)
                ->where('status', 'Sukses')
                ->sum('jumlah');

            $totalMenabung = DB::table('transaksi_menabung_users')
                ->withTrashed()
                ->whereYear('created_at', $tahun)
                ->whereMonth('created_at', $bulan)
                ->where('status', 'Sukses')
                ->sum('jumlah');

            $totalPenarikan = DB::table('penarikan_users')
                ->withTrashed()
                ->whereYear('created_at', $tahun)
                ->whereMonth('created_at', $bulan)
                ->where('status', 'Sukses')
                ->sum('jumlah');

            $dataTopup[] = $totalTopup;
            $dataMenabung[] = $totalMenabung;
            $dataPenarikan[] = $totalPenarikan;
        }

        return response()->json([
            'labels' => $labels,
            'topup' => $dataTopup,
            'menabung' => $dataMenabung,
            'penarikan' => $dataPenarikan
        ]);
    }
}
