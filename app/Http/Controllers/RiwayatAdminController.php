<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class RiwayatAdminController extends Controller
{
    function riwayatadmin()
    {
        return view('pointakses.admin.riwayatadmin');
    }

    public function gettransaksi()
    {
        $transaksis = Transaksi::orderBy('tanggal', 'desc')->get();
        return response()->json($transaksis);
    }
}
