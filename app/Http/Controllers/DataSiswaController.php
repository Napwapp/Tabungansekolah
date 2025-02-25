<?php

namespace App\Http\Controllers;

use App\Models\DataAnggota;
use App\Models\DataSiswa;
use Illuminate\Http\Request;

class DataSiswaController extends Controller
{
    public function dataSiswa()
    {
        $datasiswa = DataSiswa::all();
        return view('pointakses.admin.datasiswa', compact('datasiswa'));
    }
}
