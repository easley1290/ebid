<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PruebaController;
use App\Http\Controllers\DominioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('ebid-views-portal.home');
});
Route::get('/contactos', function () {
    return view('ebid-views-portal.contactos');
});
Route::get('/administracion', function () {
    return view('ebid-views-admin.home');
});

Route::resource('/Prueba', PruebaController::class);
/***********Rutas dominio**********/
Route::resource('/Dominio', DominioController::class);