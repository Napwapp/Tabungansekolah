<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TabunganUser;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SaveController extends Controller
{
    // untuk menampilkan halaman tabungan
    public function tabungan()
    {
        $user = Auth::user()->load('tabunganUser'); // Ambil data user yang sedang login

        // Ambil saldo user dari tabel tabungan_users
        $saldo = TabunganUser::where('user_id', Auth::id())->value('saldo');

        // Ambil total tabungan user dari tabel transaksi_menabung_users
        $totalTabungan = DB::table('transaksi_menabung_users')
            ->where('user_id', Auth::id())
            ->sum('jumlah'); // Menjumlahkan total tabungan berdasarkan user_id

        // Ambil target tabungan dari tabungan_users
        $targetTabungan = TabunganUser::where('user_id', Auth::id())->value('target_tabungan');

        // Hitung persen 
        $persenTabungan = $targetTabungan ? ($totalTabungan / $targetTabungan) * 100 : 0;

        return view('pointakses.user.tabungan', compact('user', 'saldo', 'totalTabungan', 'targetTabungan'));
    }

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
