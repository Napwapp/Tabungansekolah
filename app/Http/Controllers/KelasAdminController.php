<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KelasAdminController extends Controller
{
    function kelasmin () {
        return view('pointakses/admin/tabungan_kelas_admin');
    }
}
