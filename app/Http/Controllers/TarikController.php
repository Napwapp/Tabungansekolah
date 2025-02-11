<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TabunganUser;
use App\Models\PenarikanUser;
use App\Models\User;
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
    // Pastikan user terautentikasi
    if (!Auth::check()) {
        return response()->json([
            'success' => false,
            'message' => 'User tidak terautentikasi.'
        ], 401);
    }

    // Validasi request
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

    // Jika validasi gagal, kirim response JSON
    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => $validator->errors()->first()
        ], 422);
    }

    $user = Auth::user();

    try {
        DB::beginTransaction(); // Mulai transaksi database

        // Ambil tabungan user berdasarkan user_id
        $tabungan = TabunganUser::where('user_id', $user->id)->firstOrFail();

        // Cek apakah saldo cukup
        if ($request->jumlah > $tabungan->total_tabungan) {
            return response()->json([
                'success' => false,
                'message' => 'Saldo tabungan tidak mencukupi untuk penarikan.'
            ], 400);
        }

        // Cek apakah user sudah memiliki permintaan penarikan yang masih "menunggu"
        $existingRequest = PenarikanUser::where('user_id', $user->id)
            ->where('status', 'menunggu')
            ->first();

        if ($existingRequest) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah memiliki permintaan penarikan yang sedang diproses. Harap tunggu persetujuan admin.'
            ], 400);
        }

        // Simpan permintaan penarikan
        PenarikanUser::create([
            'id_tabungan' => $tabungan->id_tabungan,
            'user_id' => $user->id,
            'jumlah' => $request->jumlah,
            'status' => 'menunggu',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::commit(); // Simpan perubahan jika semuanya berhasil

        return response()->json([
            'success' => true,
            'message' => 'Permintaan penarikan berhasil dikirim. Menunggu persetujuan admin.'
        ]);
    } catch (\Exception $e) {
        DB::rollBack(); // Batalkan transaksi jika ada kesalahan

        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan saat memproses permintaan. Silakan coba lagi nanti.'
        ], 500);
    }
}
    
}
