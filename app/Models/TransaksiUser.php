<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiUser extends Model
{
    use HasFactory;
    // MAYBE WILL BE USELESS
    protected $table = 'transaksi_users'; // Sesuaikan dengan nama tabel

    protected $fillable = [
        'user_id',
        'id_tabungan',
        'jenis_transaksi',
        'jumlah',
        'status'
    ];

}
