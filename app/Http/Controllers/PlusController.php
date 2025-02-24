<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\TabunganUser;
use App\Models\User;
use App\Models\TransaksiTopup;
use App\Models\NotifikasiUser;

class PlusController extends Controller
{
    // untuk menampilkan halaman awal tambah saldo 
    public function plus()
    {
        return view('pointakses/user/topup/tambahsaldo');
    }


    public function isiSaldo(Request $request)
    {
        try {
            // Buat validator awal tanpa aturan min dan kelipatan, karena akan kita tambahkan secara custom
            $validator = Validator::make($request->all(), [
                'jumlah' => [
                    'required',
                    'integer',
                ],
            ], [
                'jumlah.required' => 'Jumlah harus diisi.',
                'jumlah.integer'  => 'Jumlah harus berupa angka.',
            ]);

            // Tambahkan validasi custom
            $validator->after(function ($validator) use ($request) {
                $value = (int) $request->jumlah;
                if ($value < 10000) {
                    $validator->errors()->add('jumlah', 'Minimal pengisian saldo Rp10.000');
                } elseif ($value % 500 !== 0) {
                    $validator->errors()->add('jumlah', 'Masukkan kelipatan angka yang valid! (Kelipatan 500 atau 1.000)');
                }
            });

            // Jika validasi gagal, kembalikan response JSON dengan error
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => implode('<br>', $validator->errors()->all())
                ], 422);
            }

            $user = Auth::user();

            // Cari atau buat tabungan untuk user ini
            $tabungan = TabunganUser::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'id_tabungan' => TabunganUser::generateIdTabungan(),
                    'saldo' => 0
                ]
            );

            // Tambahkan saldo
            $tabungan->saldo += $request->jumlah;
            $tabungan->save();

            // Pastikan id_tabungan tidak null
            if (!$tabungan->id_tabungan) {
                throw new \Exception('ID Tabungan tidak ditemukan!');
            }

            // Buat transaksi topup
            $topup = TransaksiTopup::create([
                'user_id'     => $user->id,
                'id_tabungan' => $tabungan->id_tabungan,
                'namalengkap' => $user->namalengkap,
                'kelas'       => $user->kelas,
                'jumlah'      => $request->jumlah,
                'status'      => 'Sukses',
            ]);

            NotifikasiUser::create([
                'user_id' => $user->id,
                'nama_pengirim' => 'Tabungan Sekolah',
                'foto_pengirim' => null,
                'judul' => 'Top-Up Saldo Berhasil',
                'isi_pesan' => 'Berhasil mengisi saldo sebesar Rp' . number_format($request->jumlah, 0, ',', '.') . ' telah berhasil ditambahkan.',
                'status' => 'Belum Dibaca',
                'tipe' => 'Transaksi',
                'id_transaksi' => $topup->id, // Simpan ID transaksi    topup 
                'status_transaksi' => $topup ->status, // Langsung ambil dari kolom status transaksi

            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Saldo berhasil ditambahkan!',
                'saldo'   => $tabungan->saldo
            ]);            
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
