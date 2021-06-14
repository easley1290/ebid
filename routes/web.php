<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DominioController;
use App\Http\Controllers\SubdominioController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\PersonaPerfilController;
use App\Http\Controllers\PersonaInsController;
use App\Http\Controllers\ContrasenaController;
use App\Http\Controllers\PortalAdminQSController;
use App\Http\Controllers\PortalAdminNoticeController;
use App\Http\Controllers\PortalAdminContactController;
use App\Http\Controllers\PortalAdminGalleryController;
use App\Http\Controllers\PortalAdminVideosController;
use App\Http\Controllers\NosotrosController;
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
use App\Http\Controllers\AdministradorController;
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
use App\Http\Controllers\EstudianteNuevoEstController;
use App\Models\Subdominios;
use App\Http\Controllers\EstudianteUsuarioController;
use App\Http\Controllers\MailController;

use App\Http\Controllers\NotasController;
use App\Http\Controllers\NotasSubirController;
use App\Http\Controllers\NotasSeguimientoController;

/*---------------- Portal web controllers---------------- */
use App\Http\Controllers\HomePortalController;
use App\Http\Controllers\PortalWeb\PWContactoController;
use App\Http\Controllers\PortalVistaController;
use App\Http\Controllers\PortalVistaPerfilController;
use App\Http\Controllers\PortalVistaProcesoController;
use App\Http\Controllers\PortalVistaMallaController;
use App\Http\Controllers\PortalVistaInscripcionController;

use App\Http\Controllers\ImprimirController;
use App\Http\Controllers\Zoom;


/*PORTAL*/ 
Route::resource('/', HomePortalController::class);
Route::post('/contactanos', [HomePortalController::class, 'store'])->name('contactus');

Route::get('/MisionVision', [NosotrosController::class, 'MisionVision'])->name('MisionVision');
Route::get('/PlantelAdministrativo', [NosotrosController::class, 'PlantelAdm'])->name('PlantelAdm');
Route::get('/PlantelDocente', [NosotrosController::class, 'PlantelDoc'])->name('PlantelDoc');
Route::get('/pcontactos', [PWContactoController::class, 'indexContactos'])->name('indexContactos');
Route::get('/pnoticias', [PWContactoController::class, 'indexNoticias'])->name('indexNoticias');
Route::get('/pgaleria', [PWContactoController::class, 'indexGaleria'])->name('indexGaleria');
Route::get('/pvideo', [PWContactoController::class, 'indexVideo'])->name('indexVideo');

Route::resource('/administracion', AdministracionController::class);

/***********Rutas Administracion de Portal Web**********/
Route::prefix('administracion/portal-web')->group(function () {
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
    Route::resource('/subir-comprobantes', SubirComprobanteController::class);
    Route::resource('/subir-comprobante', SubirComprobante2Controller::class);
    Route::resource('/valida-comprobante', ValidarComprobanteController::class);
    Route::resource('/calendario-ingreso', CalendarioExamenIngresoController::class);
    Route::resource('/estudiante-nuevo', EstudianteNuevoController::class);
    Route::resource('/estudiante-nuevo-est', EstudianteNuevoEstController::class);
    Route::post('/estudiante-buscar', [EstudianteController::class, 'busquedaEstudiante'])->name('busquedaEstudiante');
});

Route::prefix('administracion/notas')->group(function () {
    Route::resource('/subir-notas', NotasSubirController::class);
    Route::resource('/ver-notas', NotasController::class);
    Route::resource('/seguimiento-estudiantes', NotasSeguimientoController::class);
    Route::post('/materia-estudiante-buscar', [NotasSubirController::class, 'busquedaMateriaEstudiante'])->name('busquedaMateriaEstudiante');
    Route::post('/materia-estudiante-buscar-notas', [NotasController::class, 'busquedaMateriaEstudianteNotas'])->name('busquedaMateriaEstudianteNotas');
    Route::post('/estudiante-materia-buscar', [NotasSeguimientoController::class, 'busquedaEstudianteMateria'])->name('busquedaEstudianteMateria');
    Route::post('/estudiante-materia-imprimir', [NotasSeguimientoController::class, 'imprimirEstudianteMateria'])->name('imprimirEstudianteMateria');
    Route::get('/cerrar-abrir-parcial', [NotasController::class, 'cerrarAbrirParcialVer'])->name('cerrarAbrirParcialVer');
    Route::post('/cerrar-abrir-parcial', [NotasController::class, 'cerrarAbrirParcialMod'])->name('cerrarAbrirParcialMod');
    Route::get('/modificar-permisos-notas', [NotasController::class, 'permisoModificarNotasVer'])->name('permisoModificarNotasVer');
    Route::post('/modificar-permisos-notas', [NotasController::class, 'permisoModificarNotasMod'])->name('permisoModificarNotasMod');
    Route::post('/cerrar-ges-acad', [NotasController::class, 'cerrarGestionAcademica'])->name('cerrarGestionAcademica');
    Route::post('/cerrar-2t', [NotasController::class, 'cerrarDosT'])->name('cerrarDosT');
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
Route::get('/MailContrasena',[MailController::class,'index']);
Route::post('/CambioContrasena',[MailController::class,'sendEmail'])->name('CambioContrasena');

/***************  PERFIL  ****************** */
Route::resource('/Persona', PersonaController::class);
Route::resource('/PersonaInstitucional', PersonaInsController::class);
Route::resource('/PersonaPerfil', PersonaPerfilController::class);
Route::resource('/Contrasena', ContrasenaController::class);

/***************  Institucion  ****************** */
//?
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
/***************  Administrador  ****************** */
Route::resource('/Administrador', AdministradorController::class);
Route::resource('/estudiante-usuario', EstudianteUsuarioController::class);
/***************  MateriaDocente  ****************** */
Route::resource('/MateriaDocente', MateriaDocenteController::class);
/***************  Nota  ****************** */
Route::resource('/Nota', NotaController::class);
Route::resource('/Imprimir', ImprimirController::class);

/***************  oferta academica  ****************** */
//Route::resource('/portal-vista', PortalVistaController::class);

Route::prefix('portal-vista/oferta-academica')->group(function () {
    Route::resource('/perfilProfesional', PortalVistaPerfilController::class);
    Route::resource('/procesoAdmision', PortalVistaProcesoController::class);
    Route::resource('/malla', PortalVistaMallaController::class);
    Route::resource('/inscripcion', PortalVistaInscripcionController::class);
    Auth::routes();
    Route::get('/login_', function () {return view('ebid-views-login.login');});
    Route::get('/register_', function () {
        $extension = Subdominios::select('subdominios.*')
                            ->where('subd_dom_id','=',9)
                            ->get();
        return view('ebid-views-login.register')->with('extension', $extension);
    });
});


/******************ZOOM********************** */
// Get list of meetings.
Route::get('/meetings', [Zoom\MeetingController::class,'list'])->name('listZoom');
// Create meeting room using topic, agenda, start_time.
Route::post('/meetings', [Zoom\MeetingController::class,'create'])->name('createZoom');
// Get information of the meeting room by ID.
Route::get('/meetings/{id}', [Zoom\MeetingController::class,'get'])->where('id', '[0-9]+')->name('showZoom');
Route::patch('/meetings/{id}', [Zoom\MeetingController::class,'update'])->where('id', '[0-9]+')->name('updateZoom');
Route::delete('/meetings/{id}', [Zoom\MeetingController::class,'delete'])->where('id', '[0-9]+')->name('deleteZoom');