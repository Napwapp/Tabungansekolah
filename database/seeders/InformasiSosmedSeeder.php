<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InformasiSosmedSeeder extends Seeder
{
    public function run()
    {
        DB::table('informasi_sosmed')->insert([
            ['nama_anggota' => 'anggota_1'],
            ['nama_anggota' => 'anggota_2'],
            ['nama_anggota' => 'anggota_3'],
        ]);
    }
}
