<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TabunganUser; 
use App\Models\TransaksiTopup;
use App\Models\TransaksiMenabungUser;
use App\Models\PenarikanUser;
use App\Models\NotifikasiUser;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index()
    {
        // Ambil data user yang sedang login
        $user = Auth::user()->load('tabunganUser');

        // Ambil saldo user dari tabel tabungan_users
        $saldo = TabunganUser::where('user_id', Auth::id())->value('saldo');

        // Ambil total tabungan user dari tabel tabungan_users
        $totalTabungan = DB::table('tabungan_users')
            ->where('user_id', Auth::id())
            ->sum('total_tabungan'); 

        // Ambil target tabungan user
        $targetTabungan = TabunganUser::where('user_id', Auth::id())->value('target_tabungan');

        // Hitung persentase tabungan terhadap target
        $persenTabungan = $targetTabungan ? ($totalTabungan / $targetTabungan) * 100 : 0;
        $persenTabungan = min($persenTabungan, 100);

        // Periksa apakah user sudah mencapai target tabungan
        if ($totalTabungan !== null && $targetTabungan !== null && $totalTabungan >= $targetTabungan) {
            // Cek apakah notifikasi sudah ada agar tidak dikirim berulang
            $existingNotification = DB::table('notifikasi_users')
                ->where('user_id', $user->id)
                ->where('tipe', 'Target Tercapai')
                ->exists();

            if (!$existingNotification) {
                // Kirim notifikasi Target Tercapai
                DB::table('notifikasi_users')->insert([
                    'user_id' => $user->id, 
                    'nama_pengirim' => 'Tabungan Sekolah',
                    'foto_pengirim' => null,
                    'judul' => 'Target Tabunganmu Telah Tercapai!🎉',
                    'isi_pesan' => "🎉 Selamat {$user->nama_lengkap}, kamu telah mencapai target tabungan sebesar <strong>Rp " . number_format($targetTabungan, 0, ',', '.') . "</strong>! 🎉<br><br> 
                                    Saatnya menikmati hasil tabunganmu! <br><br> 
                                    👉 <a href='" . route('menarik') . "' style='color: #28a745;'>Lakukan Penarikan</a>",
                    'status' => 'Belum Dibaca',
                    'tipe' => 'Target Tercapai',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Penarikan yang disetujui bulan ini
        $penarikanDisetujuiBulanIni = DB::table('penarikan_users')
            ->where('user_id', Auth::id())
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->where('status', 'Sukses')
            ->sum('jumlah');

        // Mengambil id_tabungan
        $idTabungan = $user->tabunganUser->id_tabungan ?? 'ID tabungan tidak tersedia';

        // Ambil riwayat transaksi
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

        return view('pointakses.user.index', compact(
            'user',
            'idTabungan',
            'saldo',
            'totalTabungan',
            'riwayatTransaksi',
            'semuaTransaksiKosong',
            'targetTabungan',
            'penarikanDisetujuiBulanIni'
        ));
    }
}
