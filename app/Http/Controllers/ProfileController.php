<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TabunganUser;
use App\Models\TransaksiMenabungUser;
use App\Models\PenarikanUser;
use App\Models\TransaksiTopup;
use App\Models\NotifikasiUser;
use App\Models\LaporanUser;
use App\Models\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class ProfileController extends Controller
{
    // untuk menampilkan halaman profil
    public function profile()
    {
        // abaikan error load
        $user = Auth::user()->load('tabungan'); // Ambil data user yang sedang login

        // Ambil saldo user dari tabel tabungan_users
        $saldo = TabunganUser::where('user_id', Auth::id())->value('saldo');

        // Ambil total tabungan user dari tabel tabungan_users
        $totalTabungan = DB::table('tabungan_users')
            ->where('user_id', Auth::id())
            ->sum('total_tabungan');

        // Penarikan yang disetujui bulan ini
        $penarikanDisetujuiBulanIni = DB::table('penarikan_users')
            ->where('user_id', Auth::id())
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->where('status', 'Sukses')
            ->sum('jumlah');

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

        return view('pointakses/user/profil', compact('user', 'saldo', 'totalTabungan', 'riwayatTransaksi', 'semuaTransaksiKosong', 'penarikanDisetujuiBulanIni'));
    }



    public function editProfil(Request $request)
    {
        $user = Auth::user();

        // Validasi
        $request->validate([
            'namalengkap' => 'required|min:5|max:50',
            'username' => [
                'required',
                'min:5',
                'max:18',
                Rule::unique('users')->ignore($user->id),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'kelas' => [
                'required',
                'regex:/^(X|XI|XII)\s(TBSM 1|TBSM 2|RPL|AKL|OTKP|ATPH|TEI)$/'
            ]
        ], [
            // Pesan error custom (opsional)
            'namalengkap.required' => 'Nama lengkap wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'email.unique' => 'Email sudah digunakan.',
            'kelas.regex' => 'Format kelas tidak valid.',
        ]);

        // Update hanya jika berbeda
        $user->namalengkap = $request->namalengkap;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->kelas = $request->kelas;
        $user->save();

        // Update nama_pengirim di notifikasi_users
        NotifikasiUser::where('user_id', $user->id)
            ->whereIn('tipe', ['Laporan', 'Saran']) // hanya tipe yang pakai nama_pengirim
            ->update(['nama_pengirim' => $user->namalengkap]);

        // Update nama_pengirim dan email_pengirim di laporan_users
        LaporanUser::where('user_id', $user->id)->update([
            'nama_pengirim' => $user->namalengkap,
            'email' => $user->email,
        ]);
        
        // Update namalengkap dan kelas di transaksi_topup
        TransaksiTopup::where('user_id', $user->id)->update([
            'namalengkap' => $user->namalengkap,
            'kelas' => $user->kelas,
        ]);

        // Update namalengkap dan kelas di transaksi_menabung_users
        TransaksiMenabungUser::where('user_id', $user->id)->update([
            'namalengkap' => $user->namalengkap,
            'kelas' => $user->kelas,
        ]);

        // Update namalengkap dan kelas di penarikan_users
        PenarikanUser::where('user_id', $user->id)->update([
            'namalengkap' => $user->namalengkap,
            'kelas' => $user->kelas,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diperbarui.'
        ]);
    }

    // cek email saat mengedit profil
    public function cekEmail(Request $request)
    {
        $email = $request->input('email'); // Ambil email dari request body

        // Cek apakah email sudah ada di tabel users
        $exists = User::where('email', $email)->exists();

        return response()->json(['exists' => $exists]);
    }

    // Update foto profil
    public function updateFotoProfil(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $user = auth()->user();

        try {
            $gambar_file = $request->file('gambar');
            $path = public_path('picture/accounts');
            if (!file_exists($path)) mkdir($path, 0755, true);

            // Hapus gambar lama kalau bukan default (optional)
            if ($user->gambar && file_exists($path . '/' . $user->gambar)) {
                unlink($path . '/' . $user->gambar);
            }

            // Simpan gambar baru
            $nama_gambar = date('ymdhis') . '.' . $gambar_file->extension();
            $gambar_file->move($path, $nama_gambar);

            // Update di database
            $user->update([
                'gambar' => $nama_gambar
            ]);

            // Dapatkan full path untuk disimpan sebagai foto_pengirim
            $fotoPath = asset('picture/accounts/' . $nama_gambar);

            // Update foto_pengirim di laporan_users
            LaporanUser::where('user_id', $user->id)->update([
                'foto_pengirim' => $fotoPath,
            ]);

            // Update foto_pengirim di notifikasi_users (khusus tipe Laporan & Saran)
            NotifikasiUser::where('user_id', $user->id)
                ->whereIn('tipe', ['Laporan', 'Saran'])
                ->update([
                    'foto_pengirim' => $fotoPath,
                ]);

            return response()->json([
                'success' => true,
                'message' => 'Foto profil berhasil diperbarui.',
                'newImageUrl' => asset('picture/accounts/' . $nama_gambar)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui foto profil. Silakan coba lagi.'
            ]);
        }
    }
}
