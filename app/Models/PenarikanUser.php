<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenarikanUser extends Model
{
    use HasFactory;

    protected $table = 'penarikan_users';

    protected $fillable = [
        'user_id',
        'tabungan_id',
        'jumlah',
        'status'
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
