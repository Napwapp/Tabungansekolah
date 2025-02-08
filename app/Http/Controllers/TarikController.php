<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TarikController extends Controller
{
    function menarik() {
        return view('pointakses.user.topup.menarik');
    }
}
