<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TabunganUser;
use App\Models\TransaksiMenabungUser;
use App\Models\PenarikanUser;
use App\Models\TransaksiTopup;

use Illuminate\Support\Facades\DB;


class ProfileController extends Controller
{
    // untuk menampilkan halaman profil
    public function profile()
    {
        // abaikan error load
        $user = Auth::user()->load('tabunganUser'); // Ambil data user yang sedang login

        // Ambil saldo user dari tabel tabungan_users
        $saldo = TabunganUser::where('user_id', Auth::id())->value('saldo');

        // Ambil total tabungan user dari tabel transaksi_menabung_users
        $totalTabungan = DB::table('transaksi_menabung_users')
            ->where('user_id', Auth::id())
            ->sum('jumlah'); // Menjumlahkan total tabungan berdasarkan user_id

        // Ambil riwayat transaksi seperti di RiwayatController
        $topups = TransaksiTopup::where('user_id', $user->id)
            ->select(
                'id',
                'user_id',
                'namalengkap as nama',
                'jumlah',
                'id_tabungan',
                'status',
                'created_at'
            )
            ->addSelect(DB::raw("'Top Up' as tipe"))
            ->get();

        $menabung = TransaksiMenabungUser::where('user_id', $user->id)
            ->select(
                'id',
                'user_id',
                'namalengkap as nama',
                'jumlah',
                'id_tabungan',
                'status',
                'created_at'
            )
            ->addSelect(DB::raw("'Menabung' as tipe"))
            ->get();

        $penarikan = PenarikanUser::where('user_id', $user->id)
            ->select(
                'id',
                'user_id',
                'namalengkap as nama',
                'jumlah',
                'id_tabungan',
                'status',
                'created_at'
            )
            ->addSelect(DB::raw("'Penarikan' as tipe"))
            ->get();

        // Gabungkan semua transaksi dan urutkan berdasarkan waktu
        $riwayatTransaksi = $topups->concat($menabung)->concat($penarikan)->sortByDesc('created_at');

        // Periksa apakah semua transaksi kosong
        $semuaTransaksiKosong = $riwayatTransaksi->isEmpty() &&
            TransaksiTopup::where('user_id', $user->id)->doesntExist() &&
            TransaksiMenabungUser::where('user_id', $user->id)->doesntExist() &&
            PenarikanUser::where('user_id', $user->id)->doesntExist();

        return view('pointakses/user/profil', compact('user', 'saldo', 'totalTabungan', 'riwayatTransaksi', 'semuaTransaksiKosong'));
    }
    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'namalengkap' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . Auth::id(),
            'kelas' => 'required|string|max:255',
            'email' => 'required|string|unique:users,email,' . Auth::id(),
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
        ]);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaFile = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('picture/accounts'), $namaFile);

            // Hapus foto lama jika ada
            if (Auth::user()->gambar && file_exists(public_path('picture/accounts/' . Auth::user()->gambar))) {
                unlink(public_path('picture/accounts/' . Auth::user()->gambar));
            }

            Auth::user()->update(['gambar' => $namaFile]); // Simpan nama file ke database
        }


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
