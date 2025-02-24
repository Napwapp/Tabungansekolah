<?php

namespace App\Listeners;

use App\Events\NotifikasiTransaksiEvent;
use App\Models\NotifikasiUser;
use App\Models\TransaksiTopup;
use App\Models\TransaksiMenabungUser;
use App\Models\PenarikanUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Schema;

class UpdateOrCreateNotifikasiTransaksi implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Untuk menangani event.
     *
     * @param  \App\Events\NotifikasiTransaksiEvent  $event
     * @return void
     */
    public function handle(NotifikasiTransaksiEvent $event)
    {
        $userId = $event->notifikasi->user_id;
    
        // Ambil transaksi terbaru dari masing-masing tabel
        $topup = TransaksiTopup::where('user_id', $userId)->latest()->first();
        $menabung = TransaksiMenabungUser::where('user_id', $userId)->latest()->first();
        $penarikan = PenarikanUser::where('user_id', $userId)->latest()->first();
    
        // Kumpulkan semua transaksi dalam koleksi dan ambil yang terbaru
        $transaksi = collect([$topup, $menabung, $penarikan])
            ->filter() // Hapus nilai null
            ->sortByDesc('created_at') // Urutkan berdasarkan yang terbaru
            ->first(); // Ambil transaksi terbaru
    
        // Tentukan status transaksi
        $statusTransaksi = $transaksi ? $transaksi->status : null;
    
        // Update atau buat notifikasi baru untuk transaksi ini
        NotifikasiUser::updateOrCreate(
            [
                'user_id' => $userId,
                'judul' => $event->notifikasi->judul // Gunakan judul sebagai identifier transaksi
            ],
            [
                'isi_pesan' => $event->notifikasi->isi_pesan,
                'status' => 'Belum Dibaca', // Status diubah kembali agar dianggap sebagai notifikasi baru
                'tipe' => $event->notifikasi->tipe,
                'updated_at' => now(), // Pastikan timestamp diperbarui
                'status_transaksi' => $statusTransaksi, // Simpan status transaksi ke dalam notifikasi
            ]
        );
        
        // Trigger broadcasting setelah update atau create
        broadcast(new NotifikasiTransaksiEvent($event->notifikasi));
    }
    }
