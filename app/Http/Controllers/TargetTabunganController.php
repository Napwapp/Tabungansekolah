<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TabunganUser;

class TargetTabunganController extends Controller
{
    public function simpan(Request $request)
    {
        // Cek jika user belum login
        if (!Auth::check()) {
            // Redirect ke halaman login jika belum login
            return redirect()->route('auth');
        }

        // Validasi input (harus angka, minimal 10.000, dan kelipatan 500)
        $request->validate([
            'target_amount' => ['required', 'regex:/^\d+$/', 'numeric', 'min:20000'],
        ], [
            'target_amount.required' => 'Target tabungan harus diisi.',
            'target_amount.regex' => 'Target tabungan hanya boleh berisi angka.',
            'target_amount.numeric' => 'Target tabungan harus berupa angka.',
            'target_amount.min' => 'Target tabungan minimal Rp 20.000.',
        ]);

        // Hilangkan titik dari angka
        $targetAmount = (int) str_replace('.', '', $request->input('target_amount'));

        // Cek apakah target merupakan kelipatan 500
        if ($targetAmount % 500 !== 0) {
            return response()->json([
                'success' => false,
                'message' => 'Masukan kelipatan angka yang valid! Kelipatan 500',
            ], 422);
        }

        // Ambil user yang sedang login
        $user = Auth::user();

        // Ambil atau buat data tabungan user jika belum ada
        $tabunganUser = TabunganUser::firstOrNew(['user_id' => $user->id]);
        $tabunganUser->target_tabungan = $targetAmount;
        $tabunganUser->save();

        // Kirimkan response JSON ke frontend
        return response()->json([
            'success' => true,
            'message' => 'Target tabungan berhasil disimpan!',
            'target_tabungan' => number_format($tabunganUser->target_tabungan, 0, ',', '.'),
        ]);
    }
}
