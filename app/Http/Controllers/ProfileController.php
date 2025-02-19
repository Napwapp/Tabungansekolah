<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TabunganUser;
use App\Models\TransaksiMenabungUser;
use App\Models\PenarikanUser;
use App\Models\TransaksiTopup;

use Illuminate\Support\Facades\DB;


class ProfileController extends Controller
{
    // untuk menampilkan halaman profil
    public function profile() {
        // abaikan error load
        $user = Auth::user()->load('tabunganUser'); // Ambil data user yang sedang login

        // Ambil saldo user dari tabel tabungan_users
        $saldo = TabunganUser::where('user_id', Auth::id())->value('saldo');

        // Ambil total tabungan user dari tabel transaksi_menabung_users
        $totalTabungan = DB::table('transaksi_menabung_users')
            ->where('user_id', Auth::id())
            ->sum('jumlah'); // Menjumlahkan total tabungan berdasarkan user_id

        // Ambil riwayat transaksi seperti di RiwayatController
        $topups = TransaksiTopup::where('user_id', $user->id)
            ->select('id', 'user_id', 
                'namalengkap as nama', 
                'jumlah', 
                'id_tabungan', 
                'status', 
                'created_at'
            )
            ->addSelect(DB::raw("'Top Up' as tipe"))
            ->get();

        $menabung = TransaksiMenabungUser::where('user_id', $user->id)
            ->select('id', 'user_id', 
                'namalengkap as nama', 
                'jumlah', 
                'id_tabungan', 
                'status', 
                'created_at'
            )
            ->addSelect(DB::raw("'Menabung' as tipe"))
            ->get();

        $penarikan = PenarikanUser::where('user_id', $user->id)
            ->select('id', 'user_id', 
                'namalengkap as nama', 
                'jumlah', 
                'id_tabungan', 
                'status', 
                'created_at'
            )
            ->addSelect(DB::raw("'Penarikan' as tipe"))
            ->get();

        // Gabungkan semua transaksi dan urutkan berdasarkan waktu
        $riwayatTransaksi = $topups->concat($menabung)->concat($penarikan)->sortByDesc('created_at');

        // Periksa apakah semua transaksi kosong
        $semuaTransaksiKosong = $riwayatTransaksi->isEmpty() &&
            TransaksiTopup::where('user_id', $user->id)->doesntExist() &&
            TransaksiMenabungUser::where('user_id', $user->id)->doesntExist() &&
            PenarikanUser::where('user_id', $user->id)->doesntExist();

        return view('pointakses/user/profil', compact('user', 'saldo', 'totalTabungan', 'riwayatTransaksi', 'semuaTransaksiKosong'));
    }
}