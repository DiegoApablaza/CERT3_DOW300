<?php

namespace App\Http\Controllers;


use App\Models\Cuenta;
use App\Models\Imagen;
use App\Models\Perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class public_controller extends Controller
{
    public function inicio()
    {
        $imagenes = Imagen::has('cuenta')->get();
        $cuentas = Cuenta::all();
        return view('dashboard', compact('cuentas','imagenes'));
    }

    public function login(Request $request)
    {
        $credentials = $request->only('user', 'password');

        $user = cuenta::where('user', $credentials['user'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return redirect()->back()->withErrors(['user' => 'Usuario o contraseña incorrectos']);
        }

        if ($user->perfil_id == 1) {
            return redirect()->route('admin.home')->with('user', $user);
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

        if (Cuenta::where('user',$cuenta->user)->exists())
        {
            return redirect()->back()->with('error','el nombre de usuario ya existe');
        }

        $cuenta->save();

        return redirect()->back()->with('success','Usuario creado exitosamente');
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
