<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Import trait SoftDeletes

class NotifikasiUser extends Model
{
    use HasFactory, SoftDeletes; // Sertakan SoftDeletes

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
        'status_laporan',
        'id_laporan',
        'balasan',
    ];


    // Accessor untuk status_icon
    public function getStatusIconAttribute()
    {
        if ($this->status_laporan == 'Dibaca_Admin') {
            return '<i class="bi bi-check-all text-primary"></i>  Dibaca Admin';
        }

        if ($this->status_laporan == 'Dibalas') {
            return '<i class="bi bi-check-all text-primary"></i>  Telah Dibalas';
        }

        if ($this->tipe == "Laporan" || $this->tipe == "Saran") {
            return '<i class="bi bi-check-all text-gray"></i> Terkirim';
        }

        if ($this->tipe == "Pengingat") {
            return '<i class="bi bi-bell text-danger"></i> Pengingat';
        }

        if ($this->tipe == "Target Tercapai") {
            return '<i class="bi bi-trophy"></i> Target telah tercapai';
        }

        if ($this->tipe == "Transaksi" && !$this->status_transaksi) {
            return '<i class="bi bi-question-circle text-secondary"></i> Status Tidak Diketahui';
        }

        return match ($this->status_transaksi) {
            'Sukses' => '<i class="bi bi-check-circle text-success"></i> Transaksi Berhasil',
            'Menunggu Persetujuan' => '<i class="bi bi-hourglass-split text-warning"></i> Menunggu Persetujuan',
            'Gagal' => '<i class="bi bi-x-circle text-danger"></i> Transaksi Gagal',
            default => '<i class="bi bi-question-circle text-secondary"></i> Status Tidak Diketahui',
        };
    }


    // relasi
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFotoPengirimAttribute($value)
    {
        // Jika relasi user masih ada dan punya gambar
        if ($this->user && $this->user->gambar) {
            return asset('picture/accounts/' . $this->user->gambar);
        }

        // Fallback ke default
        return asset('picture/accounts/default.png');
    }

    public function getNamaPengirimAttribute($value)
    {
        if (($this->tipe === 'Laporan' || $this->tipe === 'Saran') && $this->user) {
            return $this->user->namalengkap;
        }

        return $value; // fallback ke nilai kolom nama_pengirim di notifikasi_users
    }

    public function laporanUser()
    {
        return $this->belongsTo(LaporanUser::class, 'user_id', 'id');  // Relasi berdasarkan user_id
    }
}
