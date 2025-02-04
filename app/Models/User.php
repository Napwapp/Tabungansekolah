<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'namalengkap',
        'kelas',
        'username',
        'email',
        'password',
        're_password',
        'gambar',
        'verify_key',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function generateIdTabungan() {
        return Str::random(13); // 13 karakter acak
    }

    // Relasi satu-ke-satu antara User dan TabunganUser
   // Di model User.php
   public function tabunganUser()
   {
       return $this->hasOne(TabunganUser::class, 'user_id'); // Hubungan one-to-one
   }
   

}


