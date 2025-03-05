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
            ->whereNull('deleted_at') // Pastikan tidak menghitung notifikasi yang sudah dihapus
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

    // Fungsi untuk menghapus notifikasi
    public function hapusNotifikasi($id)
    {
        $notification = NotifikasiUser::where('id', $id)
            ->whereNull('deleted_at') // Cek agar tidak menghapus yang sudah dihapus
            ->first();

        if ($notification) {
            $notification->delete(); // Soft delete (update deleted_at)
            return response()->json(['success' => true, 'message' => 'Notifikasi berhasil dihapus.']);
        }

        return response()->json(['success' => false, 'message' => 'Notifikasi tidak ditemukan atau sudah dihapus.']);
    }

    // Fungsi untuk hapus semua notifikasi
    public function hapusSemuaPesanDibaca()
{
    try {
        $userId = auth()->id();

        // Cek apakah ada notifikasi yang sudah Dibaca dan belum dihapus
        $affectedRows = DB::table('notifikasi_users')
            ->where('user_id', $userId) // Menargetkan notifikasi untuk user yang sedang login
            ->where('status', 'Dibaca') // Menyaring hanya yang sudah Dibaca
            ->whereNull('deleted_at') // Menyaring yang belum dihapus
            ->update(['deleted_at' => now()]); // Menghapus notifikasi dengan mengisi kolom deleted_at

        if ($affectedRows > 0) {
            return response()->json(['success' => true, 'message' => 'Semua notifikasi yang sudah dibaca berhasil dihapus.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Tidak ada notifikasi yang sudah dibaca untuk dihapus.']);
        }
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
    }
}

}
