<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TabunganUser; // Sesuaikan dengan model yang kamu gunakan
use App\Models\TransaksiMenabungUser; // Pastikan model transaksi sudah diimport
use Illuminate\Support\Facades\DB;



class UserController extends Controller
{
    function index(){
        
        // @phpstan-ignore-next-line (abaikan errornya)

        // Ambil data user yang sedang login
        $user = Auth::user()->load('tabunganUser'); 

        // Ambil saldo user dari tabel tabungan_users
        $saldo = TabunganUser::where('user_id', Auth::id())->value('saldo');

        // Ambil total tabungan user dari tabel transaksi_menabung_users
        $totalTabungan = DB::table('transaksi_menabung_users')
            ->where('user_id', Auth::id())
            ->sum('jumlah'); // Menjumlahkan total tabungan berdasarkan user_id

        // Mengambil id_tabungan dari relasi  
        $idTabungan = $user->tabunganUser->id_tabungan ?? 'ID tabungan tidak tersedia'; 
        
        
            
        
        return view ('pointakses/user/index', compact('user', 'idTabungan', 'saldo', 'totalTabungan'));
    }

}
