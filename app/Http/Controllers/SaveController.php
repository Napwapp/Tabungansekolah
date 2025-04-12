<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\TabunganUser;
use App\Models\User;

class SaveController extends Controller
{
    // Pastikan hanya admin yang bisa mengakses controller ini
    public function __construct()
    {
        $this->middleware(['auth']); // Gunakan middleware admin
    }

    // Menampilkan halaman tabungan untuk semua user
    public function tabungan(Request $request)
    {
        $user = Auth::user()->load('tabunganUser'); // Ambil data user yang sedang login

        // Ambil saldo user dari tabel tabungan_users
        $saldo = TabunganUser::where('user_id', Auth::id())->value('saldo');

        // Ambil total tabungan user dari tabel tabungan_users
        $totalTabungan = DB::table('tabungan_users')
            ->where('user_id', Auth::id())
            ->sum('total_tabungan');

        // Ambil target tabungan user
        $targetTabungan = TabunganUser::where('user_id', Auth::id())->value('target_tabungan');

        // Hitung persentase tabungan terhadap target
        $persenTabungan = $targetTabungan ? ($totalTabungan / $targetTabungan) * 100 : 0;
        $persenTabungan = min($persenTabungan, 100);

        // Penarikan yang disetujui bulan ini
        $penarikanDisetujuiBulanIni = DB::table('penarikan_users')
            ->where('user_id', Auth::id())
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->where('status', 'Sukses')
            ->sum('jumlah');

        return view('pointakses.user.tabungan', compact('user', 'saldo', 'totalTabungan', 'targetTabungan', 'penarikanDisetujuiBulanIni'));
    }

    // Mengambil data tabungan per bulan (semua user atau user tertentu)
    public function getTabunganPerBulan()
    {
        // Ambil user yang sedang login
        $userId = Auth::id();

        // Ambil total tabungan per bulan hanya untuk user yang sedang login
        $tabungan = DB::table('transaksi_menabung_users')
            ->selectRaw('COALESCE(SUM(jumlah), 0) as total, MONTH(created_at) as bulan')
            ->where('user_id', $userId) // Filter berdasarkan user_id
            ->where('status', 'Sukses') // Hanya hitung transaksi yang sudah disetujui
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('bulan')
            ->get();

        // Buat array lengkap 1-12 (Januari-Desember) dengan nilai default 0
        $tabunganLengkap = [];
        for ($i = 1; $i <= 12; $i++) {
            $tabunganLengkap[] = [
                'bulan' => $i,
                'total_tabungan' => $tabungan->firstWhere('bulan', $i)->total ?? 0
            ];
        }

        return response()->json($tabunganLengkap);
    }
}
