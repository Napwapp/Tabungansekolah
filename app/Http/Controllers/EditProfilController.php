<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditProfilController extends Controller
{
    public function edit() {
        return view('pointakses.admin.edit');
    }
}
