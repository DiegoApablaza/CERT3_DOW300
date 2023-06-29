<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perfil;
use App\Models\Artista;
use App\Models\Administrador;
use App\Models\Cuenta;
use App\Models\Imagen;

class Admin_controller extends Controller
{
    public function inicio()
    {
        return view('login');
    }

    public function adminHome()
    {
        $perfiles = Perfil::All();
        $cuentas = Cuenta::All();
        $imagenes = Imagen::All();

        return view('Administrador.home',compact('perfiles','cuentas','imagenes'));
    }

    public function userStore(Request $request)
    {
        
        
        $cuenta = new Cuenta();
        $cuenta->user = $request->user;
        $cuenta->password = $request->password;
        $cuenta->nombre = $request->nombre;
        $cuenta->apellido = $request->apellido;
        $cuenta->perfil_id = $request->perfil_id;

        $cuenta->save();

        return redirect()->route('admin.home')->with('success','Usuario creado exitosamente');
    }
}
