<?php

namespace App\Http\Controllers;

use App\Models\Tabungan;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class RiwayatAdminController extends Controller
{
    public function riwayatadmin()
    {
        $riwayats = Tabungan::all();
        
        return view('pointakses.admin.riwayatadmin', compact('riwayats'));
    }
}
