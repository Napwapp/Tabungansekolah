<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NotifikasiUser;
use App\Models\TransaksiTopup;
use App\Models\TransaksiMenabungUser;
use App\Models\PenarikanUser;
use App\Models\User;

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

        // Ambil gambar pengirim dari tabel users berdasarkan user_id
        $user = User::find($pesan->user_id);
        $gambarPengirim = $user->gambar ? asset('picture/accounts/' . $user->gambar) : asset('dashboard/dist/assets/images/logo/logoSMK_.png');


        return response()->json([
            'id'               => $pesan->id,
            'judul'            => $pesan->judul,
            'isi_pesan'        => $pesan->isi_pesan,
            'nama_pengirim'    => $pesan->nama_pengirim ?? 'Sistem',
            'foto_pengirim'    => $gambarPengirim, // Gambar pengirim yang diambil dari tabel users
            'created_at'       => $pesan->created_at, // Pastikan frontend menangani format tanggal
            'status_transaksi' => $pesan->status_transaksi, // Ambil langsung dari model
            'status_icon'      => $pesan->status_icon, // Gunakan accessor di model
            'tipe'             => $pesan->tipe,
            'balasan'          => $pesan->balasan,
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

    // filter notifikasi 
    public function filter(Request $request)
    {
        // Ambil tipe filter, default 'all'
        $filter = $request->query('filter', 'all');
        $userId = auth()->id();

        // Ambil notifikasi berdasarkan user yang sedang login
        $query = NotifikasiUser::query()->where('user_id', $userId);

        switch ($filter) {
            case 'all':
                $query->whereNull('deleted_at'); // agar tidak menampilkan yg sudah terhapus
                break;
            case 'unread':
                $query->where('status', 'Belum Dibaca');
                break;
            case 'transaksi-sukses':
                $query->where('status_transaksi', 'Sukses');
                break;
            case 'transaksi-diproses':
                $query->where('status_transaksi', 'Menunggu Persetujuan');
                break;
            case 'transaksi-gagal':
                $query->where('status_transaksi', 'Gagal');
                break;
            case 'pengingat':
                $query->where('tipe', 'Pengingat');
                break;
            case 'sent-laporan':
                $query->where('tipe', 'Laporan');
                break;
            case 'sent-saran':
                $query->where('tipe', 'Saran');
                break;
            case 'sent-terkirim':
                $query->where('status_laporan', 'Terkirim');
                break;
            case 'sent-dibaca':
                $query->where('status_laporan', 'Dibaca_Admin');
                break;
            case 'sent-dibalas':
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

    public function searchNotifications(Request $request)
    {
        $query = $request->input('query'); // Ambil query pencarian
        $filter = $request->query('filter', 'all'); // Ambil filter yang aktif, default 'all'
        $userId = auth()->id();

        // Buat query dasar berdasarkan user yang sedang login
        $queryBuilder = NotifikasiUser::where('user_id', $userId);

        // Jika ada input pencarian, cari berdasarkan nama pengirim, judul, atau isi pesan
        if (!empty($query)) {
            $queryBuilder->where(function ($q) use ($query) {
                $q->where('nama_pengirim', 'like', "%$query%")
                    ->orWhere('judul', 'like', "%$query%")
                    ->orWhere('isi_pesan', 'like', "%$query%");
            });
        }

        // Terapkan filter sesuai kategori yang aktif
        switch ($filter) {
            case 'all':
                $queryBuilder->whereNull('deleted_at'); // agar tidak menampilkan yang sudah terhapus        
                break;
            case 'unread':
                $queryBuilder->where('status', 'Belum Dibaca');
                break;
            case 'transaksi-sukses':
                $queryBuilder->where('status_transaksi', 'Sukses');
                break;
            case 'transaksi-diproses':
                $queryBuilder->where('status_transaksi', 'Menunggu Persetujuan');
                break;
            case 'transaksi-gagal':
                $queryBuilder->where('status_transaksi', 'Gagal');
                break;
            case 'pengingat':
                $queryBuilder->where('tipe', 'Pengingat');
                break;
            case 'sent-laporan':
                $queryBuilder->where('tipe', 'Laporan');
                break;
            case 'sent-saran':
                $queryBuilder->where('tipe', 'Saran');
                break;
            case 'sent-terkirim':
                $queryBuilder->where('status_laporan', 'Terkirim');
                break;
            case 'sent-dibaca':
                $queryBuilder->where('status_laporan', 'Dibaca_Admin');
                break;
            case 'sent-dibalas':
                $queryBuilder->where('status_laporan', 'Dibalas');
                break;
            default:

                break;
        }

        $notifikasi = $queryBuilder->orderBy('created_at', 'desc')->get();
        return response()->json(['data' => $notifikasi]);
    }

    public function loadNotifications()
    {
        // Ambil semua notifikasi untuk ditampilkan
        $notifikasi = NotifikasiUser::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($notifikasi); // Kembalikan semua notifikasi dalam format JSON
    }
}
