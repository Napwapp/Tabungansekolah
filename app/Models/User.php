<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

/**
 * @property TabunganUser $tabunganUser
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'namalengkap',
        'kelas',
        'username',
        'email',
        'password',
        'gambar',
        'verify_key',
        'role',
        'id_tabungan'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];
    protected $casts = ['email_verified_at' => 'datetime'];

    // Relasi

    // Relasi ke tabungan (satu user punya satu tabungan)
    public function tabungan()
    {
        return $this->hasOne(TabunganUser::class, 'user_id');
    }

    // Relasi ke penarikan lewat tabungan (harus via tabungan_id)
    public function penarikan()
    {
        return $this->hasManyThrough(
            PenarikanUser::class,
            TabunganUser::class,
            'user_id', // Foreign key di TabunganUser
            'id_tabungan', // Foreign key di PenarikanUser
            'id', // Primary key di User
            'id'  // Primary key di TabunganUser
        );
    }

    // Relasi ke transaksi menabung
    public function transaksiMenabung()
    {
        return $this->hasManyThrough(
            TransaksiMenabungUser::class,
            TabunganUser::class,
            'user_id', // Foreign key di TabunganUser
            'id_tabungan', // Foreign key di TransaksiMenabungUser
            'id',
            'id'
        );
    }

    // Relasi ke top-up
    public function transaksiTopup()
    {
        return $this->hasMany(TransaksiTopup::class, 'user_id');
    }

    // Relasi ke notifikasi
    public function notifikasi()
    {
        return $this->hasMany(NotifikasiUser::class, 'user_id');
    }

    // Relasi ke laporan
    public function laporan()
    {
        return $this->hasMany(LaporanUser::class, 'user_id');
    }

    // Untuk hapus otomatis data terkait apabila ada akun yg dihapus
    protected static function booted()
    {
        static::deleting(function ($user) {
            // Hapus relasi langsung
            $user->notifikasi()->delete();
            $user->laporan()->delete();
            $user->transaksiTopup()->delete();

            // Hapus transaksi dan penarikan yang lewat tabungan
            $user->transaksiMenabung()->delete();
            $user->penarikan()->delete();

            // Terakhir, hapus tabungan
            $user->tabungan()->delete();
        });
    }
}
