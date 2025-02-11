<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenarikanUser extends Model
{
    use HasFactory;

    protected $table = 'penarikan_users';

    protected $fillable = [
        'id_tabungan', 
        'user_id', 
        'jumlah', 
        'status', 
        'updated_at', 
        'created_at'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tabungan()
    {
        return $this->belongsTo(TabunganUser::class, 'tabungan_id');
    }
}
