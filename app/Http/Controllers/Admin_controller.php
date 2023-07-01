<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perfil;
use App\Models\Artista;
use App\Models\Administrador;
use App\Models\Cuenta;
use App\Models\Imagen;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Admin_controller extends Controller
{
    public function inicio(Request $request)
    {
        $request->validate([
            'user'=> 'required',
            'password'=> 'required'
        ]);
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

    public function volver($administrador)
    {
        $cuenta = Cuenta::where('user', $administrador->user)->first();
        return view('Administrador.home',compact('cuenta'));
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
        
        $request->validate([
            'user'=> 'required',
            'password'=> 'required',
            'nombre'=> 'required',
            'apellido'=> 'required',
            'perfil_id'=> 'required'
        ]);

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

    public function editNombre(Request $request,$user)
    {
        $cuenta = Cuenta::findorFail($user);

        $nombreNuevo = $request->input('nombreNuevo');
        $cuenta->nombre = $nombreNuevo;
        $cuenta->save();

        return redirect()->back()->with('success','Nombre Editado');
    }

    public function editApellido(Request $request,$user)
    {
        $cuenta = Cuenta::findorFail($user);

        $apellidoNuevo = $request->input('apellidoNuevo');
        $cuenta->apellido = $apellidoNuevo;
        $cuenta->save();

        return redirect()->back()->with('success','Apellido Editado');
    }

    public function editCuenta($user)
    {
        $cuenta = Cuenta::findorFail($user);

        $nombreNuevo = $request->input('nombreoNuevo');
        $cuenta->nombre = $nombreNuevo;
        $cuenta->save();

        return redirect()->back()->with('success','Nombre Editado');
        
    }

    public function updateCuenta(Request $request, $user)
    {
        $cuenta = Cuenta::find($user);


        $hashedPassword = Hash::make($request->input('password'));

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
        $tables = DB::select('SHOW TABLES');

        foreach ($tables as $table) {
            $tableName = reset($table);
        
            // Elimina los registros de la tabla que cumplan con la condición
            DB::table('imagenes')->where('cuenta_user', $cuenta->user)->delete();
        }
        
        if (!$cuenta) {
            return redirect()->back()->with('error', 'La cuenta no existe');
        }

        $relations = $cuenta->getRelations();
    
        // Recorrer cada relación y eliminar los registros relacionados
        foreach ($relations as $relation) {
            $relation->each(function ($item) {
                $item->delete();
            });
        }
        
        $cuenta->delete();
        
        return redirect()->back()->with('success', 'La cuenta ha sido eliminada exitosamente');
    }
}
