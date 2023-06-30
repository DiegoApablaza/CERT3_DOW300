<?php

namespace App\Http\Controllers;


use App\Models\cuenta;
use App\Models\perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class public_controller extends Controller
{
    public function inicio()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'user' => 'required',
            'password' => 'required',
        ]);

        $user = cuenta::where('user', $credentials['user'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return redirect()->back()->withErrors(['user' => 'Usuario o contraseña incorrectos']);
        }

        if ($user->perfil_id == 1) {
            return redirect()->route('admin.home');
        } elseif ($user->perfil_id == 2) {
            return redirect()->route('artista.Home');
        } else {
            return redirect()->route('public.home');
        }


    }
    public function userStore(Request $request)
    {
        
        $hashedPassword = Hash::make($request->password);


        $cuenta = new Cuenta();
        $cuenta->user = $request->user;
        $cuenta->password = $hashedPassword;
        $cuenta->nombre = $request->nombre;
        $cuenta->apellido = $request->apellido;
        $cuenta->perfil_id = $request->perfil_id;

        $cuenta->save();

        return redirect()->route('public.home')->with('success','Usuario creado exitosamente');
    }

    public function logout()
    {
        Auth::logout();
        return view('login');
    }

    public function dashboard()
    {
        return view('login');
    }

}
