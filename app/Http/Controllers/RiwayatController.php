<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\TransaksiTopup;
use App\Models\TransaksiMenabungUser;
use App\Models\PenarikanUser;
use Illuminate\Database\Eloquent\Model;

class RiwayatController extends Controller
{
    public function riwayat()
    {
        $user = Auth::user();

        // Ambil data dari transaksi topup
        $topups = TransaksiTopup::where('user_id', $user->id)
            ->select('id', 
                'user_id', 
                'namalengkap as nama', 
                'kelas', 
                'jumlah', 
                'id_tabungan', 
                'status', 
                'created_at'
            )
            ->addSelect(DB::raw("'Top Up' as tipe"))
            ->get();

        // Ambil data dari transaksi menabung
        $menabung = TransaksiMenabungUser::where('user_id', $user->id)
            ->select('id', 
                'user_id', 
                'namalengkap as nama', 
                'kelas', 
                'jumlah', 
                'id_tabungan', 
                'status', 
                'created_at'
            )
            ->addSelect(DB::raw("'Menabung' as tipe"))
            ->get();

        // Ambil data dari penarikan
        $penarikan = PenarikanUser::where('user_id', $user->id)
            ->select('id', 
                'user_id', 
                'namalengkap as nama', 
                'kelas', 
                'jumlah', 
                'id_tabungan', 
                'status', 
                'created_at'
            )
            ->addSelect(DB::raw("'Penarikan' as tipe"))
            ->get();

        // Gabungkan semua transaksi dan urutkan berdasarkan created_at (terbaru ke lama)
        $riwayatTransaksi = $topups->concat($menabung)->concat($penarikan)->sortByDesc('created_at');

        // Periksa apakah user tidak memiliki transaksi sama sekali
        $semuaTransaksiKosong = $riwayatTransaksi->isEmpty() &&
            TransaksiTopup::where('user_id', $user->id)->doesntExist() &&
            TransaksiMenabungUser::where('user_id', $user->id)->doesntExist() &&
            PenarikanUser::where('user_id', $user->id)->doesntExist();

        return view('pointakses.user.riwayat', compact('riwayatTransaksi', 'semuaTransaksiKosong'));
    }


    public function hapusRiwayat($tipe, $id)
    {
        try {
            // Bentuk nama model secara dinamis
            $model = "App\\Models\\" . $tipe;

            // Periksa apakah kelas ada dan merupakan subclass dari Eloquent Model
            if (!class_exists($model) || !is_subclass_of($model, Model::class)) {
                return response()->json(['success' => false, 'message' => 'Tipe transaksi tidak valid.'], 400);
            }

            // Cari transaksi berdasarkan ID
            $transaksi = $model::find($id);
            if (!$transaksi) {
                return response()->json(['success' => false, 'message' => 'Transaksi tidak ditemukan.'], 404);
            }

            $transaksi->delete(); // Soft delete

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus transaksi.'], 500);
        }
    }
}
