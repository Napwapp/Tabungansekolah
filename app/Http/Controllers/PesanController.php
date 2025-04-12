<?php

namespace App\Http\Controllers;

use App\Models\LaporanUser;
use App\Models\NotifikasiUser;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class PesanController extends Controller
{
    public function pesan()
    {
        // Ambil semua laporan yang masuk, urutkan dari yang terbaru
        $laporan = LaporanUser::orderBy('created_at', 'desc')->get();

        $terkirimCount = LaporanUser::where('status_laporan', 'Terkirim')->count();

        return view('pointakses.admin.pesan', compact('laporan', 'terkirimCount'));
    }

    public function show($id)
    {
        $laporan = LaporanUser::findOrFail($id);

        return response()->json([
            'nama_pengirim' => $laporan->nama_pengirim ?? 'Pengirim Tidak Diketahui',
            'foto_pengirim' => $laporan->foto_pengirim ?? asset('dashboard/dist/assets/images/default-avatar.png'),
            'judul'         => $laporan->judul ?? 'Tanpa Judul',
            'isi_pesan'     => $laporan->isi_pesan ?? 'Tidak ada isi pesan',
            'status_laporan' => $laporan->status_laporan_icon ?? 'Tidak Diketahui',
            'balasan'       => $laporan->balasan ?? 'Belum ada balasan',
            'tanggal'       => $laporan->created_at ? $laporan->created_at->translatedFormat('d F Y, H:i') : 'Tanggal Tidak Diketahui',
        ]);
    }

    public function updateStatus($id)
    {
        // Ambil data laporan berdasarkan ID
        $laporan = LaporanUser::findOrFail($id);

        // Perbarui status laporan
        $laporan->status_laporan = 'Dibaca_Admin';
        $laporan->save();

        // Perbarui status laporan di tabel notifikasi_users berdasarkan id_laporan
        NotifikasiUser::where('id_laporan', $laporan->id) // Gunakan id_laporan yang sudah ada
            ->where('user_id', $laporan->user_id) // Pastikan hanya untuk user yang relevan
            ->update([
                'status_laporan' => 'Dibaca_Admin' // Update status laporan di notifikasi
            ]);

        // Kirim respons dengan status yang sudah diperbarui
        return response()->json([
            'message' => 'Status laporan diperbarui',
            'status_icon' => $laporan->status_laporan_icon, // Ambil status icon dari accessor
            'status_laporan' => $laporan->status_laporan // Kirim status laporan yang terbaru
        ]);
    }

    // hitung laporan yg masih Terkirim (belum dibaca) 
    public function unreadLaporanCount()
    {
        $count = DB::table('laporan_users')
            ->where('status_laporan', 'Terkirim')
            ->count();

        return response()->json(['unreadCount' => $count]);
    }

    // untuk menandai semua pesab menjadi dibaca
    public function markAllRead(Request $request)
    {
        // Ambil semua laporan dengan status 'Terkirim'
        $laporan = LaporanUser::where('status_laporan', 'Terkirim')->get();

        if ($laporan->count() > 0) {
            // Dapatkan daftar ID laporan
            $laporanIds = $laporan->pluck('id')->toArray();

            // Update status laporan
            LaporanUser::whereIn('id', $laporanIds)
                ->update(['status_laporan' => 'Dibaca_Admin']);

            // Update status notifikasi
            NotifikasiUser::whereIn('id_laporan', $laporanIds)
                ->whereIn('tipe', ['Laporan', 'Saran'])
                ->update(['status_laporan' => 'Dibaca_Admin']);

            // Ambil ulang data laporan yang sudah diupdate (agar accessor status_icon ikut terambil)
            $laporanUpdated = LaporanUser::whereIn('id', $laporanIds)->get();

            // Siapkan data ikon status per ID
            $statusIcon = $laporanUpdated->mapWithKeys(function ($item) {
                return [$item->id => $item->status_laporan_icon];
            });

            return response()->json([
                'success' => true,
                'status_icon' => $statusIcon, // key: ID laporan, value: HTML icon
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Tidak ada pesan yang perlu diupdate'
        ]);
    }


    public function balasLaporan(Request $request, $id)
    {
        $request->validate([
            'balasan' => 'required|min:10|max:500',
        ]);

        // Cari laporan berdasarkan ID yang dikirimkan
        $laporan = LaporanUser::findOrFail($id);

        // Cari notifikasi yang berhubungan dengan laporan ini
        $notifikasi = NotifikasiUser::where('id_laporan', $laporan->id)
            ->orderBy('created_at', 'desc') // Ambil yang terbaru
            ->first();

        // Update laporan dengan balasan admin
        $laporan->balasan = $request->balasan;
        $laporan->status_laporan = 'Dibalas';
        $laporan->save();

        // Update notifikasi yang terkait
        if ($notifikasi) {
            $notifikasi->balasan = $request->balasan;
            $notifikasi->status = ($notifikasi->status === 'Dibaca') ? 'Belum Dibaca' : $notifikasi->status;
            $notifikasi->status_laporan = 'Dibalas'; // update status_laporan menjadi Dibalas
            $notifikasi->save();
        }

        return response()->json([
            'success' => true,
            'balasan' => $request->balasan,
            'created_at' => now()->format('d M Y, H:i')
        ]);
    }

    public function filterAdmin(Request $request)
    {
        // Ambil tipe filter, default 'all'
        $filter = $request->query('filter', 'all');

        $query = LaporanUser::query();

        switch ($filter) {
            case 'all':
                // biarkan semua pesan ditampilkan
                break;
            case 'unread':
                $query->where('status_laporan', 'Terkirim');
                break;
            case 'unreply':
                $query->whereNull('balasan');
                $query->whereNull('balasan')->orderByRaw("FIELD(status_laporan, 'Terkirim', 'Dibaca_Admin')");

                break;
            case 'report':
                $query->where('tipe', 'Laporan');
                break;
            case 'advice':
                $query->where('tipe', 'Saran');
                break;
            case 'sent-reply':
                $query->where('status_laporan', 'Dibalas');
                break;
            default:
                // Jika filter tidak dikenali, kembalikan semua notifikasi
                break;
        }

        // Urutkan notifikasi berdasarkan tanggal pembuatan secara menurun
        $notifications = $query->orderBy('created_at', 'desc')->get();

        // Kembalikan data dalam format JSON
        return response()->json($notifications);
    }

    public function searchNotifications(Request $request)
    {
        $searchTerm = $request->input('query'); // Ambil query pencarian
        $filter = $request->query('filter', 'all'); // Ambil filter yang aktif, default 'all'

        // Buat query dasar tanpa filter user, karena di halaman admin tampilkan semua data laporan
        $queryBuilder = LaporanUser::query();

        // Jika ada input pencarian, cari berdasarkan nama_pengirim, email, isi_pesan, atau tipe
        if (!empty($searchTerm)) {
            $queryBuilder->where(function ($q) use ($searchTerm) {
                $q->where('nama_pengirim', 'like', "%{$searchTerm}%")
                    ->orWhere('email', 'like', "%{$searchTerm}%")
                    ->orWhere('isi_pesan', 'like', "%{$searchTerm}%")
                    ->orWhere('tipe', 'like', "%{$searchTerm}%");
            });
        }

        // Terapkan filter sesuai kategori yang aktif
        switch ($filter) {
            case 'all':
                // Tampilkan semua data laporan
                break;
            case 'unread':
                // Pesan yang status_laporannya 'Terkirim'
                $queryBuilder->where('status_laporan', 'Terkirim');
                break;
            case 'unreply':
                // Pesan yang status_laporannya 'Dibaca_Admin' dan belum memiliki balasan
                $queryBuilder->where('status_laporan', 'Dibaca_Admin')
                    ->whereNull('balasan');
                break;
            case 'report':
                // Pesan dengan tipe 'Laporan'
                $queryBuilder->where('tipe', 'Laporan');
                break;
            case 'advice':
                // Pesan dengan tipe 'Saran'
                $queryBuilder->where('tipe', 'Saran');
                break;
            case 'sent-reply':
                // Pesan yang status_laporannya 'Dibalas'
                $queryBuilder->where('status_laporan', 'Dibalas');
                break;
            default:
                // Jika filter tidak dikenali, biarkan tanpa filter tambahan
                break;
        }

        // Urutkan berdasarkan tanggal terbaru dan ambil data
        $notifikasi = $queryBuilder->orderBy('created_at', 'desc')->get();

        return response()->json($notifikasi);
    }

    public function loadNotifications()
    {
        $notifikasi = LaporanUser::orderBy('created_at', 'desc')->get();

        return response()->json($notifikasi);
    }
}
