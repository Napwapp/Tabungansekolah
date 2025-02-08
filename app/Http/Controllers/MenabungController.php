<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\TabunganUser;
use App\Models\TransaksiMenabungUser;
use App\Models\User;

class MenabungController extends Controller
{
    // Menampilkan halaman menabung
    public function menabung() {
        $user = auth()->user();
        
        // Ambil saldo terbaru langsung dari database
        $tabungan = TabunganUser::where('user_id', $user->id)->first();
        $saldo = $tabungan ? $tabungan->saldo : 0;
        
        // Hitung saldo yang dapat ditabung dengan menyisakan Rp10.000
        $saldoTersedia = max(0, $saldo - 10000);
        
        return view('pointakses.user.topup.menabung', [
            'saldo' => $saldo,
            'saldoTersedia' => $saldoTersedia,
        ]);   
    }

    public function tabungUang(Request $request){
        $request->validate([
            'jumlah' => 'required|numeric|min:10000',
        ]);
    
        $user = auth()->user();
    
        DB::beginTransaction(); // Mulai transaksi database
        
        try {
            // Ambil saldo terbaru langsung dari database untuk memastikan validitasnya
            $tabungan = TabunganUser::where('user_id', $user->id)->lockForUpdate()->first();
    
            if (!$tabungan) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tabungan tidak ditemukan.'
                ], 400);
            }
    
            if ($tabungan->saldo < $request->jumlah) {
                return response()->json([
                    'success' => false,
                    'message' => 'Saldo tidak mencukupi untuk menabung.'
                ], 400);
            }
    
            // Kurangi saldo user
            $tabungan->saldo -= $request->jumlah;
            $tabungan->save();
    
            // Catat transaksi
            TransaksiMenabungUser::create([
                'user_id' => $user->id,
                'tabungan_id' => $tabungan->id,
                'jumlah' => $request->jumlah,
                'status' => 'berhasil'
            ]);
    
            DB::commit(); // Simpan perubahan jika semuanya berhasil
    
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menabung Rp ' . number_format($request->jumlah, 0, ',', '.')
            ]);
        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan transaksi jika ada kesalahan
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses. Silakan coba lagi.'
            ], 500);
        }
    }
}
