<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Tambahkan ini

class TransaksiTopup extends Model
{
    use HasFactory, SoftDeletes; // Gunakan SoftDeletes

    protected $table = 'transaksi_topup';

    protected $fillable = [
        'user_id',
        'id_tabungan',
        'namalengkap',
        'kelas',
        'jumlah',
        'status',
    ];

    protected $dates = ['deleted_at']; // Agar deleted_at dikonversi ke Carbon

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tabungan(){
        return $this->belongsTo(TabunganUser::class, 'id_tabungan', 'id_tabungan');
    }
}
