<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DominioController;
use App\Http\Controllers\SubdominioController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\PersonaPerfilController;
use App\Http\Controllers\PersonaInsController;
use App\Http\Controllers\ContraseñaController;
use App\Http\Controllers\PortalAdminQSController;
use App\Http\Controllers\PortalAdminNoticeController;
use App\Http\Controllers\PortalAdminContactController;
use App\Http\Controllers\PortalAdminGalleryController;
use App\Http\Controllers\PortalAdminVideosController;
use App\Http\Controllers\AdministracionController;

use App\Http\Controllers\InstitucionController;
use App\Http\Controllers\UnidadAcademicaController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\SemestreController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\CategoriaDocenteController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\MateriaDocenteController;
use App\Http\Controllers\NotaController;

use App\Http\Controllers\PensumController;

use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\PostulantesController;
use App\Http\Controllers\ComprobanteController;
use App\Http\Controllers\SubirComprobanteController;
use App\Http\Controllers\SubirComprobante2Controller;
use App\Http\Controllers\ValidarComprobanteController;
use App\Http\Controllers\CalendarioExamenIngresoController;
use App\Http\Controllers\EstudianteNuevoController;
use App\Models\Subdominios;

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
Route::resource('/administracion', AdministracionController::class);

/***********Rutas Administracion de Portal Web**********/
Route::prefix('administracion')->group(function () {
    Route::resource('/quienessomos', PortalAdminQSController::class);
    Route::resource('/contactos', PortalAdminContactController::class);
    Route::resource('/noticias', PortalAdminNoticeController::class);
    Route::resource('/galeria', PortalAdminGalleryController::class);
    Route::resource('/videos', PortalAdminVideosController::class);
});

/***********Rutas inscripcion del estudiante**********/
Route::prefix('administracion/inscripcion')->group(function () {
    Route::resource('/estudiante', EstudianteController::class);
    Route::resource('/postulante', PostulantesController::class);
    Route::resource('/comprobante', ComprobanteController::class);
    Route::resource('/subir-comprobante', SubirComprobanteController::class);
    Route::resource('/subir-comprobantes', SubirComprobante2Controller::class);
    Route::resource('/valida-comprobante', ValidarComprobanteController::class);
    Route::resource('/calendario-ingreso', CalendarioExamenIngresoController::class);
    Route::resource('/estudiante-nuevo', EstudianteNuevoController::class);
    Route::post('/estudiante-buscar', [EstudianteController::class, 'busquedaEstudiante'])->name('busquedaEstudiante');
});

/***********Rutas dominio**********/
Route::resource('/Dominio', DominioController::class);
/***********Rutas Subdominio**********/
Route::resource('/Subdominio', SubdominioController::class);


/***************  LOGIN  ****************** */
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/login_', function () {return view('ebid-views-login.login');});
Route::get('/register_', function () {
    $extension = Subdominios::select('subdominios.*')
                        ->where('subd_dom_id','=',9)
                        ->get();
    return view('ebid-views-login.register')->with('extension', $extension);
});
/***************  PERFIL  ****************** */
Route::resource('/Persona', PersonaController::class);
Route::resource('/PersonaInstitucional', PersonaInsController::class);
Route::resource('/PersonaPerfil', PersonaPerfilController::class);
Route::resource('/Contrasenia', ContraseñaController::class);

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
/***************  Rol  ****************** */
Route::resource('/Rol', RolController::class);
/***************  CategoriDocente  ****************** */
Route::resource('/CategoriaDocente', CategoriaDocenteController::class);
/***************  Docente  ****************** */
Route::resource('/Docente', DocenteController::class);
/***************  MateriaDocente  ****************** */
Route::resource('/MateriaDocente', MateriaDocenteController::class);
/***************  Nota  ****************** */
Route::resource('/Nota', NotaController::class);