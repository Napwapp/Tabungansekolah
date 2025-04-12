<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InformasiAlamat;
use App\Models\InformasiSosmed;
use App\Models\InformasiKontak;
use App\Models\InformasiEmail;

class LandController extends Controller
{
    public function index()
    {
        // Ambil data sosial media untuk setiap anggota
        $sosmedAnggota = [
            'anggota_1' => [
                'github' => InformasiSosmed::where('nama_anggota', 'anggota_1')->value('github'),
                'instagram' => InformasiSosmed::where('nama_anggota', 'anggota_1')->value('instagram'),
                'linkedin' => InformasiSosmed::where('nama_anggota', 'anggota_1')->value('linkedin'),
            ],
            'anggota_2' => [
                'github' => InformasiSosmed::where('nama_anggota', 'anggota_2')->value('github'),
                'instagram' => InformasiSosmed::where('nama_anggota', 'anggota_2')->value('instagram'),
                'linkedin' => InformasiSosmed::where('nama_anggota', 'anggota_2')->value('linkedin'),
            ],
            'anggota_3' => [
                'github' => InformasiSosmed::where('nama_anggota', 'anggota_3')->value('github'),
                'instagram' => InformasiSosmed::where('nama_anggota', 'anggota_3')->value('instagram'),
                'linkedin' => InformasiSosmed::where('nama_anggota', 'anggota_3')->value('linkedin'),
            ]
        ];
        
    
        // Ambil data alamat
        $alamat = InformasiAlamat::latest()->value('alamat');
    
        // Ambil data kontak
        $kontak = InformasiKontak::pluck('nomor');
    
        // Ambil data email
        $email = InformasiEmail::pluck('email');
    
        return view('landingpage.landingpage', compact('sosmedAnggota', 'alamat', 'kontak', 'email'));
    }
    
}
