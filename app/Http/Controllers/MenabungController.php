<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\TabunganUser;
use App\Models\TransaksiMenabungUser;
use App\Models\NotifikasiUser;
use App\Models\User;

class MenabungController extends Controller
{
    // Menampilkan halaman menabung
    public function menabung()
    {
        $user = auth()->user();

        // Ambil saldo terbaru langsung dari database
        $tabungan = TabunganUser::where('user_id', $user->id)->first();
        $saldo = $tabungan ? $tabungan->saldo : 0;
        $totalTabungan = $tabungan ? $tabungan->total_tabungan : 0; // Ambil total tabungan dari database

        // Hitung saldo yang dapat ditabung dengan menyisakan Rp10.000
        $saldoTersedia = max(0, $saldo - 10000);

        return view('pointakses.user.topup.menabung', [
            'saldo' => $saldo,
            'saldoTersedia' => $saldoTersedia,
            'totalTabungan' => $totalTabungan, // Kirim ke Blade
        ]);
    }



   public function tabungUang(Request $request)
{
    $request->validate([
        'jumlah' => 'required|numeric|min:10000',
    ]);

    // Pastikan jumlah yang dimasukkan adalah kelipatan 500
    if ($request->jumlah % 500 !== 0) {
        return response()->json([
            'success' => false,
            'message' => 'Masukan kelipatan angka yang valid! Kelipatan 500'
        ], 400);
    }

    $user = auth()->user();

    // Cek apakah user memiliki transaksi yang masih Menunggu Persetujuan
    $existingMenabung = TransaksiMenabungUser::where('user_id', $user->id)
        ->where('status', 'Menunggu Persetujuan')
        ->exists();

    if ($existingMenabung) {
        return response()->json([
            'success' => false,
            'message' => 'Anda sudah memiliki transaksi menabung yang masih Menunggu Persetujuan. Harap menunggu persetujuan admin terlebih dahulu!'
        ], 400);
    }

    DB::beginTransaction(); // Mulai transaksi database

    try {
        // Ambil saldo terbaru langsung dari database dengan lock untuk update yang aman
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

        Log::info('Sebelum transaksi: ' . $tabungan->total_tabungan);

        // CATAT TRANSAKSI MENABUNG (Status: Menunggu Persetujuan)
        $menabung = TransaksiMenabungUser::create([
            'user_id'      => $user->id,
            'id_tabungan'  => $tabungan->id_tabungan,
            'jumlah'       => $request->jumlah,
            'status'       => 'Menunggu Persetujuan', 
            'namalengkap'  => $user->namalengkap,
            'kelas'        => $user->kelas,
        ]);


        // KIRIM NOTIFIKASI
        NotifikasiUser::create([
            'user_id' => $user->id,
            'nama_pengirim' => 'Tabungan Sekolah',
            'foto_pengirim' => null,
            'judul' => 'Menabung dalam Proses',
            'isi_pesan' => 'Transaksi menabung sebesar Rp' . number_format($request->jumlah, 0, ',', '.') . ' sedang menunggu persetujuan admin.',
            'status' => 'Belum Dibaca',
            'tipe' => 'Transaksi',
            'id_transaksi' => $menabung->id, 
            'status_transaksi' => $menabung->status,
        ]);            

        Log::info('Setelah transaksi: ' . $tabungan->total_tabungan);

        DB::commit(); // Simpan perubahan jika semuanya berhasil            

        return response()->json([
            'success' => true,
            'message' => 'Transaksi menabung sedang diproses. Menunggu persetujuan dari admin.'
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
