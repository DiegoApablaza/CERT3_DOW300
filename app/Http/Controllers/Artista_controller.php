<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Artista_controller extends Controller
{
    public function inicio()
    {
        return view('artistas.home');
    }
}
