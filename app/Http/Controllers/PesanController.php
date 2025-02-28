<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PesanController extends Controller
{
    public function pesan()
    {
        return view('pointakses.admin.pesan');
    }
}
