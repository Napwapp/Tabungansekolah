<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    // untuk menampilkan halaman riwayat
    function riwayat () {
        return view('pointakses.user.riwayat');
    }
}
