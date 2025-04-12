<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiEmail extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak mengikuti konvensi
    protected $table = 'informasi_email'; 

    // Tentukan kolom yang bisa diisi
    protected $fillable = [
        'user_id',
        'id_informasi_email',  // Ini adalah id khusus yang dimaksud
        'email',
    ];

    // Relasi ke users
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
