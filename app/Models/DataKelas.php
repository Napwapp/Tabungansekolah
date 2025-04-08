<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKelas extends Model
{
    use HasFactory;
    protected $table = 'datakelas';
    protected $fillable = ['namalengkap', 'kelas', 'saldo', 'tabungan', 'penarikan'];
    public function scopeByKelas($query, $kelas)
    {
        return $query->where('kelas', $kelas);
    }
}
