<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // untuk menampilkan halaman profil
    function profile() {
        return view('pointakses/user/profil');
    }
}
