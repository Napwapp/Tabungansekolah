<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

/**
 * @property TabunganUser $tabunganUser
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'namalengkap', 
        'kelas', 
        'username', 
        'email', 
        'password', 
        'gambar', 
        'verify_key', 
        'role', 
        'id_tabungan'
    ];

    protected $hidden = [
        'password', 
        'remember_token'
    ];
    protected $casts = ['email_verified_at' => 'datetime'];

    // Relasi satu-ke-satu antara User dan TabunganUser
    public function tabunganUser()
    {
        return $this->hasOne(TabunganUser::class, 'user_id');
    }

    public function transaksiTabungan()
    {
        return $this->hasMany(TabunganTransaction::class);
    }

    public function ensureIdTabungan()
    {
        if (!$this->id_tabungan) {
            $id_tabungan = TabunganUser::where('user_id', $this->id)->value('id_tabungan');
            if ($id_tabungan) {
                $this->id_tabungan = $id_tabungan;
                $this->save();
            }
        }
    }
}

