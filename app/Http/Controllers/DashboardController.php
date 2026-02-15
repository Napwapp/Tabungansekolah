<?php

namespace App\Http\Controllers;

use App\Models\PenarikanUser;
use App\Models\TransaksiMenabungUser;
use App\Models\TransaksiTopup;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        // Total saldo masuk hari ini
        $totalSaldoHariIni = TransaksiTopup::whereDate('created_at', Carbon::today())
            ->where('status', 'Sukses')
            ->sum('jumlah');

        // Total tabungan bulanan
        $totalTabunganBulanan = TransaksiMenabungUser::whereMonth('created_at', Carbon::now()->month)
            ->where('status', 'Sukses')
            ->sum('jumlah');

        // Total penarikan
        $totalPenarikan = PenarikanUser::where('status', 'Sukses')->sum('jumlah');

        // Semua total saldo masuk
        $totalSaldoMasuk = TransaksiTopup::where('status', 'Sukses')->sum('jumlah');

        // Semua total tabungan masuk
        $totalTabunganMasuk = TransaksiMenabungUser::where('status', 'Sukses')->sum('jumlah');

        return view('pointakses/admin/index.blade.php', compact(
            'totalSaldoHariIni',
            'totalTabunganBulanan',
            'totalPenarikan',
            'totalSaldoMasuk',
            'totalTabunganMasuk'
        ));
    }
}
