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

Route::get('/artistaHome', [artista_controller::class, 'inicio'])->name('artista.Home');

Route::get('/loginPublicHome', [Public_controller::class, 'dashboard'])->name('public.home');
Route::post('/loginPublicLogin', [Public_controller::class, 'login'])->name('public.login');

Route::get('/adminHome',[Admin_controller::class,'adminHome'])->name('admin.home');
Route::post('/admin/añadirCuenta', [Admin_controller::class, 'userStore'])->name('admin.userStore');
Route::delete('/admin/deleteCuenta/{id}', [Admin_controller::class, 'deleteCuenta'])->name('admin.deleteCuenta');
Route::get('/admin/editarCuenta/{user}', [Admin_controller::class, 'editCuenta'])->name('admin.editCuenta');
Route::put('/admin/Updatecuenta/{user}', [Admin_controller::class, 'updateCuenta'])->name('admin.updateCuenta');


Route::get('/', function () {
    return view('login');
});

