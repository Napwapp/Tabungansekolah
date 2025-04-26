<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi_menabung_users';
    protected $fillable = [
        'id', 'id_user', 'id_tabungan', 'namalengkap', 'kelas', 'jumlah', 'status'
    ];
}
