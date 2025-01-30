<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    //untuk menampilkan halaman kontak kami
    function contact() {
        return view('pointakses.user.kontak');
    }
}
