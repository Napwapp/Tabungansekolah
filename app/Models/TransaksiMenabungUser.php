<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Tambahkan ini

class TransaksiMenabungUser extends Model
{
    use HasFactory, SoftDeletes; // Gunakan SoftDeletes

    protected $table = 'transaksi_menabung_users';

    protected $fillable = [
        'user_id',
        'id_tabungan',
        'jumlah', 
        'status',
        'namalengkap',
        'kelas'       
    ];

    protected $dates = ['deleted_at']; // Agar deleted_at otomatis dikonversi ke Carbon

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tabungan(){
        return $this->belongsTo(TabunganUser::class, 'id_tabungan', 'id_tabungan');
    }    
}
