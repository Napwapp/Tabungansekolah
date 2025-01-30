<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenabungController extends Controller
{
    // untuk menampilkan halaman menabung
    function menabung() {
        return view('pointakses.user.topup.menabung');
    }
}
