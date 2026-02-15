<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanUser extends Model
{
    use HasFactory;
    protected $table = 'laporan_users';

    protected $fillable = [
        'user_id',
        'nama_pengirim',
        'email',
        'foto_pengirim',
        'judul',
        'isi_pesan',
        'tipe',
        'status_laporan',
        'balasan',
    ];

    public function getStatusLaporanIconAttribute()
    {
        return match ($this->status_laporan) {
            'Terkirim' => '<i class="bi bi-check-all text-gray"></i> Belum Dibaca',
            'Dibaca_Admin' => '<i class="bi bi-check-all text-primary"></i> Telah Dibaca',
            'Dibalas' => '<i class="bi bi-chat-left-text"></i> Sudah Dibalas',
            default => '<i class="bi bi-question-circle text-secondary"></i> Status Tidak Diketahui',
        };
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Di LaporanUser.php, jika mau disiapkan
    public function getFotoPengirimAttribute()
    {
        return $this->user && $this->user->gambar
            ? asset('picture/accounts/' . $this->user->gambar)
            : asset('picture/accounts/default.png');
    }
}
