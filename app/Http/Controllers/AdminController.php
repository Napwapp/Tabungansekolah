<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    function index() {
        return view('pointakses/admin/index');
    }

    function adminprofil () {
    
        return view('pointakses.admin.profiladmin');
    }
}
