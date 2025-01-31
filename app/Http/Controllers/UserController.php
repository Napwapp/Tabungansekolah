<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function index(){
        $user = Auth::user(); // Ambil data user yang sedang login
        return view ('pointakses/user/index', compact('user'));
    }
}
