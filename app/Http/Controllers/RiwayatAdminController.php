<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiTopup;
use App\Models\TransaksiMenabungUser;
use App\Models\PenarikanUser;
use Illuminate\Support\Facades\DB;

class RiwayatAdminController extends Controller
{
    public function riwayatadmin()
    {
        // Ambil data dari tabel transaksi topup
        $topup = TransaksiTopup::select('id', 'namalengkap', 'created_at', 'jumlah', 'id_tabungan', 'status')
            ->addSelect(DB::raw("'TopUp' as tipe"))
            ->get();

        // Ambil data dari tabel transaksi menabung
        $menabung = TransaksiMenabungUser::select('id', 'namalengkap', 'created_at', 'jumlah', 'id_tabungan', 'status')
            ->addSelect(DB::raw("'Menabung' as tipe"))
            ->get();

        // Ambil data dari tabel transaksi penarikan
        $penarikan = PenarikanUser::select('id', 'namalengkap', 'created_at', 'jumlah', 'id_tabungan', 'status')
            ->addSelect(DB::raw("'Penarikan' as tipe"))
            ->get();

        // Hitung total per jenis transaksi
        $totalTopup = $topup->sum('jumlah');
        $totalMenabung = $menabung->sum('jumlah');
        $totalPenarikan = $penarikan->sum('jumlah');

        // Gabungkan semua transaksi dalam satu collection & urutkan berdasarkan tanggal terbaru
        $riwayatadmin = $topup->concat($menabung)->concat($penarikan)->sortByDesc('tanggal');

        // Kirim semua data ke view
        return view('pointakses.admin.riwayatadmin', compact('riwayatadmin', 'totalTopup', 'totalMenabung', 'totalPenarikan'));
    }
}
