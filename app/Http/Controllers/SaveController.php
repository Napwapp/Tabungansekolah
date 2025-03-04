<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\TabunganUser;
use App\Models\User;

class SaveController extends Controller
{
    // Pastikan hanya admin yang bisa mengakses controller ini
    public function __construct()
    {
        $this->middleware(['auth', 'admin']); // Gunakan middleware admin
    }

    // Menampilkan halaman tabungan untuk semua user
    public function tabungan(Request $request)
    {
        $userId = $request->input('user_id'); // Ambil user_id dari request (jika ada)
        
        if ($userId) {
            // Jika admin memilih user tertentu, tampilkan tabungan user tersebut
            $user = User::with('tabunganUser')->find($userId);
        } else {
            // Jika tidak, tampilkan semua user
            $user = null;
        }

        // Ambil saldo dan target tabungan user tertentu (jika dipilih)
        $saldo = optional($user?->tabunganUser)->saldo ?? 0;
        $targetTabungan = optional($user?->tabunganUser)->target_tabungan ?? 0;

        // Ambil total tabungan user tertentu (jika dipilih)
        $totalTabungan = DB::table('transaksi_menabung_users')
            ->when($userId, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->sum('jumlah');

        // Hitung persentase tabungan (hindari pembagian dengan nol)
        $persenTabungan = $targetTabungan > 0 ? ($totalTabungan / $targetTabungan) * 100 : 0;

        // Ambil semua user untuk dropdown pilihan di admin panel
        $users = User::all();

        return view('pointakses.admin.tabungan', compact('users', 'user', 'saldo', 'totalTabungan', 'targetTabungan', 'persenTabungan'));
    }

    // Mengambil data tabungan per bulan (semua user atau user tertentu)
    public function getTabunganPerBulan()
{
    // Ambil total tabungan per bulan dari tabel transaksi_menabung_users
    $data = DB::table('transaksi_menabung_users')
        ->selectRaw('MONTH(created_at) as bulan, SUM(nominal) as total_tabungan')
        ->where('status', 'Sukses') // Hanya transaksi sukses
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->get();

    // Format data bulan menjadi nama bulan
    $bulanMap = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];

    $formattedData = [];
    foreach ($data as $item) {
        $formattedData[] = [
            'bulan' => $bulanMap[$item->bulan], 
            'total_tabungan' => $item->total_tabungan
        ];
    }

    return response()->json($formattedData);
}
}
