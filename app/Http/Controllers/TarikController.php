<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TabunganUser;
use App\Models\PenarikanUser;
use App\Models\User;
use App\Models\NotifikasiUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak terautentikasi.'
            ], 401);
        }

        $validator = Validator::make($request->all(), [
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

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $user = Auth::user();

        try {
            DB::beginTransaction();

            // Ambil tabungan user berdasarkan user_id
            $tabungan = TabunganUser::where('user_id', $user->id)->firstOrFail();

            if ($request->jumlah > $tabungan->total_tabungan) {
                return response()->json([
                    'success' => false,
                    'message' => 'Saldo tabungan tidak mencukupi untuk penarikan.'
                ], 400);
            }

            // Cek apakah user sudah memiliki permintaan penarikan yang masih "Menunggu Persetujuan"
            $existingRequest = PenarikanUser::where('user_id', $user->id)
                ->where('status', 'Menunggu Persetujuan')
                ->first();

            if ($existingRequest) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda sudah memiliki permintaan penarikan yang sedang diproses. Harap tunggu persetujuan admin.'
                ], 400);
            }

            // Simpan permintaan penarikan dengan kolom id_tabungan yang benar
            $penarikan = PenarikanUser::create([
                'id_tabungan' => $tabungan->id_tabungan,
                'user_id' => $user->id,
                'namalengkap' => $user->namalengkap,
                'kelas' => $user->kelas,
                'jumlah' => $request->jumlah,
                'status' => 'Menunggu Persetujuan',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Buat notifikasi dengan id_transaksi & status_transaksi
            NotifikasiUser::create([
                'user_id' => $user->id,
                'nama_pengirim' => 'Tabungan Sekolah',
                'foto_pengirim' => null,
                'judul' => 'Pengajuan Penarikan Tabungan',
                'isi_pesan' => 'Mengajukan penarikan sebesar Rp' . number_format($request->jumlah, 0, ',', '.') . ' telah diajukan. Menunggu persetujuan admin.',
                'status' => 'Belum Dibaca',
                'tipe' => 'Transaksi',
                'id_transaksi' => $penarikan->id, // Simpan ID transaksi penarikan
                'status_transaksi' => $penarikan->status, // Langsung ambil dari kolom status transaksi
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Permintaan penarikan berhasil dikirim. Menunggu persetujuan admin.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses permintaan. Silakan coba lagi nanti.'
            ], 500);
        }
    }
}
