<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TabunganUser;
use App\Models\User;

class PlusController extends Controller
{
    // untuk menampilkan halaman awal tambah saldo 
    public function plus() {
        return view('pointakses/user/topup/tambahsaldo');
    }
    public function isiSaldo(Request $request)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:10000', // Minimal Rp10.000
        ]);
    
        $user = Auth::user();
        
        // Pastikan user memiliki tabungan
        $tabungan = $user->tabunganUser ?? TabunganUser::create([
            'user_id'    => $user->id,
            'id_tabungan'=> User::generateIdTabungan(),
            'saldo'      => 0,
        ]);
    
        // Tambahkan saldo
        $tabungan->saldo += $request->jumlah;
        $tabungan->save();
    
        return response()->json(['message' => 'Saldo berhasil ditambahkan!', 'saldo' => $tabungan->saldo]);
    }    
    
}
