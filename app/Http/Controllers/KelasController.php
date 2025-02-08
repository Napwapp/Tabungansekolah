<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KelasController extends Controller
{
    function kelasmin () {
        return view('pointakses/user/tabungan_kelas');
    }
}
