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

Route::get('/login', [home_Controller::class, 'inicio'])->name('login');
Route::get('/artistaHome', [artista_controller::class, 'inicio'])->name('artista.Home');
Route::get('/loginPublicHome', [Public_controller::class, 'dashboard'])->name('public.home');
Route::post('/loginPublicLogin', [Public_controller::class, 'login'])->name('public.login');
Route::get('/adminHome',[Admin_controller::class,'adminHome'])->name('admin.home');
Route::post('/adminHomeUser', [Admin_controller::class, 'userStore'])->name('admin.userStore');


Route::get('/', function () {
    return view('login');
});

