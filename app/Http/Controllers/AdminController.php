<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TransaksiMenabungUser;
use App\Models\PenarikanUser;
use App\Models\TransaksiTopup;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
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
    
            return view('pointakses/admin/index', compact(
                'totalSaldoHariIni',
                'totalTabunganBulanan',
                'totalPenarikan',
                'totalSaldoMasuk',
                'totalTabunganMasuk'
            ));
        }
    
    public function adminprofil()
    {
        $admin = auth()->user(); //Mengambil data admin yang sedang login
        return view('pointakses.admin.profiladmin', compact('admin'));
    }

    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'namalengkap' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . Auth::id(),
            'kelas' => 'required|string|max:255',
        ]);

        // Ambil user yang sedang login
        $user = Auth::user();
        $user->namalengkap = $request->namalengkap;
        $user->username = $request->username;
        $user->kelas = $request->kelas;
        $user->save();

        // Return response JSON
        return response()->json(['success' => true, 'message' => 'Profil berhasil diperbarui']);
    }
    
}
