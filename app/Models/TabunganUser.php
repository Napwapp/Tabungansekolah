<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabunganUser extends Model {
    use HasFactory;

    protected $table = 'tabungan_users'; // Nama tabel
    protected $fillable = [
    'user_id',
    'id_tabungan',
    'saldo'
     ]; // Kolom yang bisa diisi

    // Relasi dengan tabel users
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function generateIdTabungan()
    {
        do {
            $idTabungan = mt_rand(1000000000000, 9999999999999); // 13 digit angka random
        } while (self::where('id_tabungan', $idTabungan)->exists()); // Pastikan unik
        return $idTabungan;
    }

}

