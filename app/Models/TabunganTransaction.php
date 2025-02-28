<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabunganTransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'jumlah_tabungan',
        'jenis_transaksi'
    ];

     // Relasi ke user
     public function user() {
        return $this->belongsTo(User::class);
    }
}