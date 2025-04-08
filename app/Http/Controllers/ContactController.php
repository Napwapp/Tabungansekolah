<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NotifikasiUser;
use App\Models\TransaksiTopup;
use App\Models\TransaksiMenabungUser;
use App\Models\PenarikanUser;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    //untuk menampilkan halaman kontak kami
    public function contact()
    {
        $user = auth()->user();

        $notifikasi = NotifikasiUser::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->each(function ($pesan) {
                // Ambil status transaksi hanya jika tipe adalah "Transaksi"
                if ($pesan->tipe === "Transaksi" && $pesan->id_transaksi) {
                    $statusTransaksi = TransaksiTopup::where('id', $pesan->id_transaksi)->value('status') ??
                        TransaksiMenabungUser::where('id', $pesan->id_transaksi)->value('status') ??
                        PenarikanUser::where('id', $pesan->id_transaksi)->value('status');

                    // Simpan jika ada perubahan status
                    if ($pesan->status_transaksi !== $statusTransaksi) {
                        $pesan->status_transaksi = $statusTransaksi;
                        $pesan->save();
                    }
                }
            });

        return view('pointakses.user.kontak', compact('notifikasi'));
    }

    public function getDetail($id)
    {
        $pesan = NotifikasiUser::findOrFail($id);

        return response()->json([
            'id'               => $pesan->id,
            'judul'            => $pesan->judul,
            'isi_pesan'        => $pesan->isi_pesan,
            'nama_pengirim'    => $pesan->nama_pengirim ?? 'Sistem',
            'foto_pengirim'    => $pesan->foto_pengirim,
            'created_at'       => $pesan->created_at, // Pastikan frontend menangani format tanggal
            'status_transaksi' => $pesan->status_transaksi, // Ambil langsung dari model
            'status_icon'      => $pesan->status_icon, // Gunakan accessor di model
            'tipe'             => $pesan->tipe,
        ]);
    }

    public function updateStatus($id)
    {
        $pesan = NotifikasiUser::findOrFail($id);

        if ($pesan->status !== 'Dibaca') {
            $pesan->status = 'Dibaca';
            $pesan->save();
        }

        return response()->json(['message' => 'Status diperbarui']);
    }

    // logika untuk Menandai semua pesan yg Belum Dibaca menjadi Dibaca
    public function countUnread()
    {
        $unreadCount = DB::table('notifikasi_users')
            ->where('user_id', auth()->id())
            ->where('status', 'Belum Dibaca')
            ->count();

        return response()->json(['unreadCount' => $unreadCount]);
    }

    public function markAllRead()
    {
        DB::table('notifikasi_users')
            ->where('user_id', auth()->id())
            ->where('status', 'Belum Dibaca')
            ->update([
                'status' => 'Dibaca',
                'updated_at' => now()
            ]);

        return response()->json(['success' => true]);
    }
}
