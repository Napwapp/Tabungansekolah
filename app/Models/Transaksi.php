<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis';
    protected $fillable = [
        'tanggal', 'nama_siswa', 'nis', 'kelas', 'jurusan', 'jenis_transaksi', 'nominal', 'saldo_akhir', 'keterangan'
    ];
}
