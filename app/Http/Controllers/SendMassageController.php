<?php

namespace App\Http\Controllers;

use App\Models\LaporanUser;
use App\Models\NotifikasiUser;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SendMassageController extends Controller
{
    function index()
    {
        $user = Auth::user(); // Ambil data user yang sedang login

        return view('pointakses.user.kirimpesan', compact('user'));
    }

    public function kirimLaporan(Request $request)
    {
        $request->validate([
            'kategori'  => 'required|in:laporan,saran',
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        // Simpan laporan ke tabel laporan_users
        $laporan = LaporanUser::create([
            'user_id'       => auth()->id(),
            'nama_pengirim' => auth()->user()->namalengkap,
            'email'         => Auth::user()->email,
            'foto_pengirim' => auth()->user()->gambar ? asset('picture/accounts/' . auth()->user()->gambar) : asset('picture/accounts/default.png'),
            'tipe'          => $request->kategori === 'laporan' ? 'Laporan' : 'Saran',
            'judul'         => $request->judul,
            'isi_pesan'     => $request->deskripsi,
            'status_laporan' => 'Terkirim',
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        // Ambil laporan berdasarkan user_id
        $laporan = LaporanUser::where('user_id', auth()->id())->latest()->first(); // Ambil laporan terakhir

        $statusLaporan = $laporan->status_laporan ?? 'Terkirim'; // Mengambil status_laporan dari laporan_users

        // Simpan notifikasi ke tabel notifikasi_users agar user dapat melihat status laporan
        NotifikasiUser::create([
            'user_id'       => auth()->id(), // Simpan notifikasi untuk user yang mengirim laporan
            'nama_pengirim' => auth()->user()->namalengkap,
            'foto_pengirim' => auth()->user()->gambar ? asset('picture/accounts/' . auth()->user()->gambar) : asset('picture/accounts/default.png'),
            'judul' => $laporan->tipe . ' : ' . $request->judul,
            'isi_pesan'     => $laporan->isi_pesan,
            'status'        => 'Belum Dibaca', // Untuk keperluan user, status ini menunjukkan bahwa admin belum melihat laporan
            'status_laporan' => $statusLaporan,   // Gunakan status_laporan dari laporan_users
            'tipe'          => $laporan->tipe, // 'Laporan' atau 'Saran'
            'id_laporan'     => in_array($request->kategori, ['laporan', 'saran']) ? $laporan->id : null, // Hanya diisi jika tipe Laporan atau Saran
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Laporan atau saran berhasil dikirim.'
        ]);
    }
}
