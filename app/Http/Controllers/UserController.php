<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\TabunganUser;
use App\Models\TransaksiTopup;
use App\Models\TransaksiMenabungUser;
use App\Models\PenarikanUser;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index()
    {
        // Periksa apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('auth')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil data user yang sedang login
        $user = User::with('tabunganUser')->find(Auth::id());

        // Cek apakah user memiliki data tabungan atau tidak
        if (!$user->tabunganUser) {
            return redirect()->back()->with('error', 'Data tabungan tidak ditemukan.');
        }

        // Ambil saldo user dari tabel tabungan_users
        $saldo = TabunganUser::where('user_id', Auth::id())->value('saldo');

        // Ambil total tabungan user dari tabel transaksi_menabung_users
        $totalTabungan = DB::table('transaksi_menabung_users')
            ->where('user_id', Auth::id())
            ->sum('jumlah');

        // Ambil target tabungan yang telah diatur oleh user
        $targetTabungan = TabunganUser::where('user_id', Auth::id())->value('target_tabungan');

        // Hitung persentase dari total tabungan terhadap target tabungan
        $persenTabungan = $targetTabungan ? ($totalTabungan / $targetTabungan) * 100 : 0;
        $persenTabungan = min($persenTabungan, 100); // Batas maksimal 100%

        // Mengambil id_tabungan dari relasi  
        $idTabungan = $user->tabunganUser->id_tabungan ?? 'ID tabungan tidak tersedia';

        // Ambil riwayat transaksi seperti di RiwayatController
        $topups = TransaksiTopup::where('user_id', $user->id)
            ->select('id', 'user_id', 'namalengkap as nama', 'jumlah', 'id_tabungan', 'status', 'created_at')
            ->addSelect(DB::raw("'Top Up' as tipe"))
            ->get();

        $menabung = TransaksiMenabungUser::where('user_id', $user->id)
            ->select('id', 'user_id', 'namalengkap as nama', 'jumlah', 'id_tabungan', 'status', 'created_at')
            ->addSelect(DB::raw("'Menabung' as tipe"))
            ->get();

        $penarikan = PenarikanUser::where('user_id', $user->id)
            ->select('id', 'user_id', 'namalengkap as nama', 'jumlah', 'id_tabungan', 'status', 'created_at')
            ->addSelect(DB::raw("'Penarikan' as tipe"))
            ->get();

        // Gabungkan semua transaksi dan urutkan berdasarkan waktu
        $riwayatTransaksi = $topups->concat($menabung)->concat($penarikan)->sortByDesc('created_at');

        // Periksa apakah semua transaksi kosong
        $semuaTransaksiKosong = $riwayatTransaksi->isEmpty() &&
            TransaksiTopup::where('user_id', $user->id)->doesntExist() &&
            TransaksiMenabungUser::where('user_id', $user->id)->doesntExist() &&
            PenarikanUser::where('user_id', $user->id)->doesntExist();

        return view('pointakses.user.index', compact('user', 'idTabungan', 'saldo', 'totalTabungan', 'riwayatTransaksi', 'semuaTransaksiKosong', 'targetTabungan'));
    }



    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return redirect()->back()->with('success', 'Role berhasil diperbarui');
    }
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $user->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
