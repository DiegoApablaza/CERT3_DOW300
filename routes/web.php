<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Artista_Controller;
use App\Http\Controllers\Public_Controller;
use App\Http\Controllers\Admin_Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/public/logout',[Public_Controller::class, 'logout'] )->name('public.cerrarSesion');
Route::post('/public/AñadirCuenta', [Public_controller::class, 'userStore'])->name('public.userStore');
Route::get('/loginPublicHome', [Public_controller::class, 'inicio'])->name('public.home');
Route::get('/loginPublicLogin', [Public_controller::class, 'login'])->name('public.login');


Route::get('/artistaHome', [artista_controller::class, 'artistaHome'])->name('artista.Home');
Route::post('/artistaPost',[artista_controller::class, 'artistaPost'])->name('artista.subirImagen');
Route::get('/artistaIndex',[artista_controller::class,'inicio'])->name('artista.index');
Route::delete('/artistaDelete/{id}',[artista_controller::class,'delete'])->name('artista.eliminarImagen');
Route::post('/artista/editarImagen/{id}', [artista_controller::class, 'edit'])->name('artista.editarImagen');


Route::get('/adminHome',[Admin_controller::class,'adminHome'])->name('admin.home');
Route::get('/admimvolver/{administrador}',[Admin_controller::class,'volver'])->name('admin.volver');
Route::get('/adminIndex',[Admin_controller::class,'inicio'])->name('admin.index');
Route::post('/admin/añadirCuenta', [Admin_controller::class, 'userStore'])->name('admin.userStore');
Route::delete('/admin/deleteCuenta/{id}', [Admin_controller::class, 'deleteCuenta'])->name('admin.deleteCuenta');
Route::get('/admin/editarCuenta/{user}', [Admin_controller::class, 'editCuenta'])->name('admin.editCuenta');
Route::put('/admin/Updatecuenta/{user}', [Admin_controller::class, 'updateCuenta'])->name('admin.updateCuenta');
Route::post('/admin/banearImagen/{imagen}', [Admin_controller::class, 'banearImagen'])->name('admin.banearImagen');
Route::post('/admin/editarNombre/{user}', [Admin_controller::class, 'editNombre'])->name('admin.editarNombre');
Route::post('/admin/editarApellido/{user}', [Admin_controller::class, 'editApellido'])->name('admin.editarApellido');



Route::get('/', function () {
    return view('login');
});

