<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Tambahkan ini

class PenarikanUser extends Model {
    use HasFactory, SoftDeletes; // Gunakan SoftDeletes

    protected $table = 'penarikan_users';

    protected $fillable = [
        'id_tabungan',
        'user_id',
        'namalengkap',
        'kelas',
        'jumlah',
        'status',
        'created_at',
        'updated_at'
    ];

    protected $dates = ['deleted_at']; // Agar deleted_at dikonversi ke Carbon

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tabungan() {
        return $this->belongsTo(TabunganUser::class, 'id_tabungan', 'id_tabungan');
    }
}
