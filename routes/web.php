<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DominioController;
use App\Http\Controllers\SubdominioController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\PortalAdminQSController;
use App\Http\Controllers\PortalAdminNoticeController;
use App\Http\Controllers\PortalAdminContactController;
use App\Http\Controllers\PortalAdminGalleryController;
use App\Http\Controllers\PortalAdminVideosController;

use App\Http\Controllers\InstitucionController;
use App\Http\Controllers\UnidadAcademicaController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\SemestreController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\PensumController;

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
/*PORTAL*/ 
Route::get('/', function () {
    return view('ebid-views-portal.home');
});
Route::get('/contactos', function () {
    return view('ebid-views-portal.contactos');
});
Route::get('/administracion', function () {
    return view('ebid-views-administrador.home');
});

/***********Rutas Administracion de Portal Web**********/
Route::prefix('administracion')->group(function () {
    Route::resource('/quienessomos', PortalAdminQSController::class);
    Route::resource('/contactos', PortalAdminContactController::class);
    Route::resource('/noticias', PortalAdminNoticeController::class);
    Route::resource('/galeria', PortalAdminGalleryController::class);
    Route::resource('/videos', PortalAdminVideosController::class);
});

/***********Rutas dominio**********/
Route::resource('/Dominio', DominioController::class);
/***********Rutas Subdominio**********/
Route::resource('/subdominio', SubdominioController::class);


/***************  LOGIN  ****************** */
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/login_', function () {return view('ebid-views-login.login');});
Route::get('/register_', function () {return view('ebid-views-login.register');});
/***************  PERFIL  ****************** */
Route::resource('/Persona', PersonaController::class);
/***************  Institucion  ****************** */
Route::resource('/Institucion', InstitucionController::class);
/***************  UnidadAcademica  ****************** */
Route::resource('/UnidadAcademica', UnidadAcademicaController::class);
/***************  Carrera  ****************** */
Route::resource('/Carrera', CarreraController::class);
/***************  Semestre  ****************** */
Route::resource('/Semestre', SemestreController::class);
/***************  Especialidad  ****************** */
Route::resource('/Especialidad', EspecialidadController::class);
/***************  Materia  ****************** */
Route::resource('/Materia', MateriaController::class);
/***************  Pensum  ****************** */
Route::resource('/Pensum', PensumController::class);