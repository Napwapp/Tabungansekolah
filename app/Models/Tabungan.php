<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tabungan extends Model
{
    use HasFactory;

    protected $table = 'transaksi_menabung_users'; // Nama tabel di database
    protected $fillable = ['user_id', 'jumlah', 'created_at']; // Kolom yang digunakan
}
