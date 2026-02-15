<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiKontak extends Model
{
    use HasFactory;

    protected $table = 'informasi_kontak'; 

    // Tentukan kolom yang bisa diisi
    protected $fillable = [
        'user_id',
        'id_informasi_kontak',  
        'nomor',
    ];

    // Relasi ke users
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
