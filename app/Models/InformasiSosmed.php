<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Validator;

class InformasiSosmed extends Model
{
    use HasFactory;

    protected $table = 'informasi_sosmed';

    protected $fillable = [
        'nama_anggota',
        'github',
        'instagram',
        'linkedin',
    ];

    public static function rules($id = null) {
        return [
            'github' => ['nullable', 'url', 'regex:/^https?:\/\/(www\.)?github\.com\/.+/i'],
            'instagram' => ['nullable', 'url', 'regex:/^https?:\/\/(www\.)?instagram\.com\/.+/i'],
            'linkedin' => ['nullable', 'url', 'regex:/^https?:\/\/(www\.)?linkedin\.com\/in\/.+/i'],
        ];
    }    

    public static function messages() {
        return [
            'github.url' => 'URL GitHub tidak valid.',
            'github.regex' => 'URL harus dari domain github.com.',
            'instagram.url' => 'URL Instagram tidak valid.',
            'instagram.regex' => 'URL harus dari domain instagram.com.',
            'linkedin.url' => 'URL LinkedIn tidak valid.',
            'linkedin.regex' => 'URL harus dari domain linkedin.com/in/.',
        ];
    }
}
