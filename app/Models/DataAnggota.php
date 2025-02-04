<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class DataAnggota extends Model
{
    use HasFactory;
    public $table = 'dataanggota';
    public $fillable = [
        'namalengkap',
        'email',
        'id_tabungan',
        'kelas',
        'role'
    ];
}
