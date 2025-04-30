<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\PenarikanUser;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\TabunganUser;
use Illuminate\Http\Request;

class KelasAdminController extends Controller
{
    // Menampilkan data keuangan berdasarkan kelas
    public function kelasmin(Request $request)
    {
        // Ambil semua user beserta relasi tabungan dan penarikan
        $users = User::with(['tabungan.penarikan'])
             ->where('role', 'user')
             ->get();

        // Buat koleksi data keuangan tiap user
        $dataKeuangan = $users->map(function ($user) {
            $saldo = $user->saldo;
            $tabungan = $user->tabungan;
            $penarikan = $tabungan?->penarikan->where('status', 'Sukses')->sum('jumlah') ?? 0;

            return (object) [
                'id_tabungan'   => $tabungan->id_tabungan ?? '-',
                'namalengkap'   => $user->namalengkap,
                'kelas'         => $user->kelas,
                'total_tabungan'=> $tabungan->total_tabungan,
                'saldo'         => $tabungan->saldo ?? 0,
                'penarikan'     => $penarikan,
            ];
        });

        return view('pointakses.admin.kelasmin', compact('dataKeuangan'));
    }
}
