<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TabunganUser;
use App\Models\PenarikanUser;
use Illuminate\Support\Facades\Auth;

class TarikController extends Controller
{
    public function menarik()
    {
        $user = Auth::user();

        // Ambil data tabungan user
        $tabungan = TabunganUser::where('user_id', $user->id)->first();
        $totalTabungan = $tabungan ? $tabungan->total_tabungan : 0;

        return view('pointakses.user.topup.menarik', compact('totalTabungan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah' => [
                'required', 
                'numeric', 
                'min:20000', 
                function ($attribute, $value, $fail) {
                    if ($value % 500 !== 0) {
                        $fail('Jumlah penarikan harus kelipatan 500.');
                    }
                }
            ],
        ]);
    
        $user = Auth::user();
        $tabungan = TabunganUser::where('user_id', $user->id)->first();
        $totalTabungan = $tabungan ? $tabungan->total_tabungan : 0; // Pastikan ada default 0
    
        // Cek apakah tabungan ditemukan
        if (!$tabungan) {
            return back()->withErrors(['tabungan' => 'Tabungan tidak ditemukan.']);
        }
    
        // Cek apakah saldo mencukupi
        if ($request->jumlah > $totalTabungan) {
            return back()->withErrors(['jumlah' => 'Saldo tabungan tidak mencukupi untuk penarikan.']);
        }
    
        // Ambil id_tabungan dengan pengecekan tambahan
        $tabungan_id = $tabungan->id_tabungan ?? null;
    
        if (!$tabungan_id) {
            return back()->withErrors(['tabungan_id' => 'ID Tabungan tidak valid.']);
        }
    
        dd([
            'user_id' => $user->id,
            'tabungan_id' => $tabungan_id,
            'jumlah' => $request->jumlah,
            'status' => 'menunggu'
        ]);
    
        // Simpan permintaan penarikan dengan status 'menunggu'
        PenarikanUser::create([
            'user_id' => $user->id,
            'tabungan_id' => $tabungan_id,
            'jumlah' => $request->jumlah,
            'status' => 'menunggu'
        ]);
    
        return back()->with('success', 'Permintaan penarikan berhasil dikirim. Menunggu persetujuan admin.');
    }
    

}
