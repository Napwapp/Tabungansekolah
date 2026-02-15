<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\NotifikasiUser;

class NotifikasiTransaksiEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $notifikasi;

    /**
     * Buat event baru.
     *
     * @param NotifikasiUser $notifikasi Objek notifikasi yang akan dikirim
     */
    public function __construct(NotifikasiUser $notifikasi)
    {
        $this->notifikasi = $notifikasi;
    }

    /**
     * Tentukan channel broadcast.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['notifikasi-channel']; // Channel untuk broadcast notifikasi
    }

    /**
     * Tentukan nama event saat dikirim melalui broadcasting.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'notifikasi-transaksi'; // Nama event yang akan didengarkan oleh client
    }
}
