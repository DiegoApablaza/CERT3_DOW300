<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perfil;
use App\Models\Artista;
use App\Models\Administrador;
use App\Models\Cuenta;
use App\Models\Imagen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Admin_controller extends Controller
{
    public function inicio()
    {
        return view('login');
    }

    public function adminHome()
    {
            $perfiles = Perfil::all();
            $cuentas = Cuenta::all();
            $imagenes = Imagen::all();

            return view('Administrador.home', compact('perfiles', 'cuentas', 'imagenes'));
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

        return redirect()->route('admin.home')->with('success','Usuario creado exitosamente');
    }

    public function editCuenta($user)
    {
        $cuenta = Cuenta::find($user);

        if (!$cuenta) {
            abort(404); // O cualquier otra acción que desees realizar si la cuenta no existe
        }

        return view('Administrador.edit', compact('cuenta'));
    }
    public function updateCuenta(Request $request, $user)
    {
        $cuenta = Cuenta::find($user);

        if (!$cuenta) {
            abort(404); // O cualquier otra acción que desees realizar si la cuenta no existe
        }

        $hashedPassword = Hash::make($request->input('password'));

        $cuenta->user = $request->input('user');
        $cuenta->password = $hashedPassword;
        $cuenta->nombre = $request->input('nombre');
        $cuenta->apellido = $request->input('apellido');
        $cuenta->perfil_id = $request->input('perfil_id');

        $cuenta->save();

        return redirect()->route('admin.home')->with('success', 'La cuenta se actualizó correctamente.');
    }


    public function deleteCuenta($id)
    {
        $cuenta = Cuenta::find($id);
        
        if (!$cuenta) {
            return redirect()->back()->with('error', 'La cuenta no existe');
        }
        
        $cuenta->delete();
        
        return redirect()->back()->with('success', 'La cuenta ha sido eliminada exitosamente');
    }
}
