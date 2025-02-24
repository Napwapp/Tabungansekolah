<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabunganUser extends Model
{
    use HasFactory;

    protected $table = 'tabungan_users'; // Nama tabel

    protected $fillable = [
        'user_id',
        'id_tabungan',
        'saldo',
        'total_tabungan',
        'target_tabungan'
    ]; // Kolom yang bisa diisi


    public static function generateIdTabungan()
    {
        $maxAttempts = 10; // Batas percobaan untuk menghindari loop tak terbatas
        $attempts = 0;

        do {
            $idTabungan = str_pad(mt_rand(0, 9999999999999), 13, '0', STR_PAD_LEFT); // Pastikan selalu 13 digit
            $exists = self::where('id_tabungan', $idTabungan)->exists();
            $attempts++;
        } while ($exists && $attempts < $maxAttempts);

        if ($exists) {
            throw new \Exception('Gagal menghasilkan ID Tabungan yang unik.');
        }

        return $idTabungan;
    }


    // Relasi dengan tabel users
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function transaksiMenabung()
    {
        return $this->hasMany(TransaksiMenabungUser::class, 'id_tabungan');
    }

    // Relasi ke TransaksiTopup (jika perlu)
    public function topupTransaksis()
    {
        return $this->hasMany(TransaksiTopup::class, 'id_tabungan', 'id_tabungan');
    }
}
