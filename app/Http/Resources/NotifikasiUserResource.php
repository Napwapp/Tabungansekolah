<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotifikasiUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'nama_pengirim' => $this->nama_pengirim,
            'foto_pengirim' => $this->foto_pengirim,
            'judul' => $this->judul,
            'isi_pesan' => $this->isi_pesan,
            'status' => $this->status,
            'tipe' => $this->tipe,
            'status_transaksi' => $this->status_transaksi,
            'status_laporan' => $this->status_laporan,
            'created_at' => $this->created_at,
            'status_icon' => $this->status_icon, // Tambahkan ini!
        ];
    }
}
