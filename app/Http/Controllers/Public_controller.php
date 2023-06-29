<?php

namespace App\Http\Controllers;


use App\Models\cuenta;
use App\Models\perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class public_controller extends Controller
{
    public function inicio()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $user = $request->user;
        $password = $request->password;
        
        if (Auth::attempt(['user'=>$user,'password'=>$password])) {
            return redirect()->route('home');
        } else {
            return redirect()->back()->withInput()->withErrors('Credenciales inválidas.');
        }
    }

    public function dashboard()
    {
        return view('home');
    }

}
