<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Cuenta;
use App\Models\Imagen;

class Artista_controller extends Controller
{
    public function inicio(Request $request)
    {
        $user = $request->user;
        $password = $request->password;

        $cuenta = Cuenta::where('user',$user)->first();

        if ($cuenta->perfil_id !== 2) {
                return redirect()->back()->withErrors(['user' => 'Accesso no autorizado']);
            }

        if (!$cuenta || !Hash::check($password, $cuenta->password)) {
            return redirect()->back()->withErrors(['user' => 'Usuario o contraseña incorrectos']);
        }

        $cuentas = Cuenta::where('perfil_id',2)->get();





        return view('Artistas.home', compact('cuentas','cuenta'));
    }

    public function edit(Request $request,$id)
    {
            $imagen = Imagen::findorFail($id);

            $titulo = $request->input('tituloNuevo');

            $imagen->titulo = $titulo;
            $imagen->save();

            return redirect()->back()->with('success','Imagen Editada');
    }

    public function delete($id)
    {
            $imagen = Imagen::findorFail($id);

            Storage::delete($imagen->archivo);

            $imagen->delete();

            return redirect()->back()->with('success','Imagen Eliminada');
    }


    public function artistaHome()
    {
            $cuentas = Cuenta::all();
            $imagenes = Imagen::all();


            return view('artistas.home', compact('cuentas', 'imagenes'));
    }

    public function artistaPost(Request $request)
    {
            $nuevaImagen = new Imagen();
            $nuevaImagen->titulo = $request->titulo;
            $nuevaImagen->baneada = false;
            $nuevaImagen->cuenta_user = $request->cuenta_user;

            $path = $request->archivo->store('imagenes','public');
            $nuevaImagen->archivo = $path;

            $nuevaImagen->save();

            $cuenta = Cuenta::where('user',$request->cuenta_user)->first();

            $imagenes = $cuenta->imagenes;

            return redirect()->back()->with('success','Imagen epica');
    }
}
