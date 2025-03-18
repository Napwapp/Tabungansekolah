<?php

namespace App\Http\Controllers;

use App\Models\LaporanUser;
use App\Models\NotifikasiUser;
use Illuminate\Http\Request;

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
            'foto_pengirim' => $laporan->foto_pengirim ?? null,
            'judul' => $laporan->judul,
            'isi_pesan' => $laporan->isi_pesan,
            'status_laporan' => $laporan->status_laporan,
            'status_icon' => $laporan->status_laporan_icon,
            'tanggal' => $laporan->created_at->format('d M Y, H:i'),
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

    // untuk menandai semua pesab menjadi dibaca
    public function markAllRead(Request $request)
    {
        // Ambil semua laporan dengan status 'Terkirim'
        $laporan = LaporanUser::where('status_laporan', 'Terkirim')->get();
    
        if ($laporan->count() > 0) {
            // Dapatkan daftar ID laporan
            $laporanIds = $laporan->pluck('id')->toArray();
            
            // Update laporan_users
            LaporanUser::whereIn('id', $laporanIds)
                       ->where('status_laporan', 'Terkirim')
                       ->update(['status_laporan' => 'Dibaca_Admin']);
    
            // Update notifikasi_users untuk tipe 'Laporan' dan 'Saran'
            NotifikasiUser::whereIn('id_laporan', $laporanIds)
                          ->whereIn('tipe', ['Laporan', 'Saran'])
                          ->where('status_laporan', 'Terkirim')
                          ->update(['status_laporan' => 'Dibaca_Admin']);
    
            return response()->json(['success' => true]);
        }
        
        return response()->json(['success' => false, 'message' => 'Tidak ada pesan yang perlu diupdate']);
    }    
}
