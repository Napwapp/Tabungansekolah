<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiAlamat extends Model
{
    use HasFactory;

    protected $table = 'informasi_alamat';

    protected $fillable = [
        'user_id',
        'alamat',
    ];

    // Relasi ke users
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
