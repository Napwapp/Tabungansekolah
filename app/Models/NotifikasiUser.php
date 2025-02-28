<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifikasiUser extends Model
{
    use HasFactory;

    protected $table = 'notifikasi_users';

    protected $fillable = [
        'user_id',
        'nama_pengirim',
        'foto_pengirim',
        'judul',
        'isi_pesan',
        'status',
        'tipe',
        'status_transaksi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessor untuk status_icon
    public function getStatusIconAttribute()
    {
        if ($this->tipe !== "Transaksi" || !$this->status_transaksi) {
            return '<i class="bi bi-question-circle text-secondary"></i> Status Tidak Diketahui';
        }
    
        return match ($this->status_transaksi) { 
            'Sukses' => '<i class="bi bi-check-circle text-success"></i> Transaksi Berhasil',
            'Menunggu Persetujuan' => '<i class="bi bi-hourglass-split text-warning"></i> Menunggu Persetujuan',
            'Gagal' => '<i class="bi bi-x-circle text-danger"></i> Transaksi Gagal',
            default => '<i class="bi bi-question-circle text-secondary"></i> Status Tidak Diketahui',
        };
    }
}
    


