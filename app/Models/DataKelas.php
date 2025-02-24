<?php

namespace App\Models;

use Database\Seeders\JurusanSeeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKelas extends Model
{
    use HasFactory;
    protected $table = 'DataKelas';
    protected $fillable = ['jurusan','pengeluaran', ' pemasukan', 'dana', 'akhir'];
}
