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
    public function inicio(Request $request)
    {
        $user = $request->user;
        $password = $request->password;

        $cuenta = Cuenta::where('user',$user)->first();

        if ($cuenta->perfil_id !== 1) {
            return redirect()->back()->withErrors(['user' => 'Accesso no autorizado']);
        }

        if (!$cuenta || !Hash::check($password, $cuenta->password)) {
            return redirect()->back()->withErrors(['user' => 'Usuario o contraseña incorrectos']);
        }
        $perfiles = Perfil::all();
        $cuentas = Cuenta::all();
        $imagenes = Imagen::all();





        return view('Administrador.home', compact('perfiles', 'cuentas', 'imagenes','cuenta'));
    }

    public function index(Request $request)
    {
        return view('login');
    }

    public function adminHome()
    {
        
            $perfiles = Perfil::all();
            $cuentas = Cuenta::all();
            $imagenes = Imagen::all();
            $user = session('user');


            return view('Administrador.home', compact('perfiles', 'cuentas', 'imagenes','user'));
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


        $hashedPassword = Hash::make($request->input('password'));

        $cuenta->user = $request->input('user');
        $cuenta->password = $hashedPassword;
        $cuenta->nombre = $request->input('nombre');
        $cuenta->apellido = $request->input('apellido');
        $cuenta->perfil_id = $request->input('perfil_id');

        if (Cuenta::where('user',$cuenta->user)->exists())
        {
            return redirect()->back()->with('error','el nombre de usuario ya existe');
        }

        $cuenta->save();

        return redirect()->route('admin.home')->with('success', 'La cuenta se actualizó correctamente.');
    }

    public function banearImagen(Imagen $imagen,Request $request)
    {
        $imagen->baneada = !$imagen->baneada;
        $imagen->motivo_ban = $request->input('motivo_ban');
        $imagen->save();
        return redirect()->back()->with('success', 'Imagen Baneada');
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
