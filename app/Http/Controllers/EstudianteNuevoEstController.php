<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

use App\Models\Estudiantes;
use App\Models\Subdominios;
use App\Models\Semestre;
use App\Models\MateriaEstudiante;
use App\Models\Personas;
use App\Models\UnidadAcademica;
use App\Models\Pensum;
use App\Models\Especialidades;

class EstudianteNuevoEstController extends Controller
{
    public function store(Request $request)
    {
        /**----------------------------------- Guardar formulario de registro de estudiantes desde el rol de estudiante ---------------------- */
        // esta funcion se utilizará al guardar el formulario despues de aprpobar el examen
        try{
            $this->validate($request,[
                'nombre_estudiante' => 'required|min:2|max:50',
                'paterno_estudiante' => 'required|min:2|max:50',
                'materno_estudiante' => 'required|min:2|max:50',
                'numero_ci_estudiante' => 'required|min:5',
                'extension_ci_estudiante' => 'required',
                'fec_nacimiento_estudiante' => 'required',
                'numero_telefono_estudiante' => 'required|min:8|max:11',
                'correo_personal_estudiante' => 'required|min:8|max:50',
                'domicilio_estudiante' => 'required|min:5|max:100',
                'genero_estudiante' => 'required',
                'nombre_tutor' => 'required|min:10|max:150',
                'telefono_tutor' => 'required|min:8|max:11',
                'domicilio_tutor' => 'required|max:100',
            ]);
           
            $personaE = Personas::select('personas.*')
                        ->where('personas.per_num_documentacion', '=', $request->get('numero_ci_estudiante'))
                        ->get()
                        ->first();

            $personaE->per_nombres = (string) $request->get('nombre_estudiante');
            $personaE->per_paterno = (string) $request->get('paterno_estudiante');
            $personaE->per_materno = (string) $request->get('materno_estudiante');
            $personaE->per_num_documentacion = trim($request->get('numero_ci_estudiante'));
            $personaE->per_subd_extension = $request->get('extension_ci_estudiante');
            $personaE->per_fecha_nacimiento = $request->get('fec_nacimiento_estudiante');
            $personaE->per_telefono = (int) $request->get('numero_telefono_estudiante');
            $personaE->name = $request->get('nombre_estudiante').' '.$request->get('paterno_estudiante').' '. $request->get('materno_estudiante');
            $personaE->email = (string) $request->get('correo_personal_estudiante');
            $personaE->per_domicilio = (string) $request->get('domicilio_estudiante');
            $personaE->per_subd_genero = $request->get('genero_estudiante');
            $personaE->per_rol = 3;

            $estudianteE = Estudiantes::select('estudiantes.*')
                            ->where('estudiantes.est_per_id', '=', $personaE->per_id)
                            ->get()
                            ->first();

            $estudianteE->est_sem_id = $request->get('anio_estudiante');
            $estudianteE->est_subd_estado = 6;
            $estudianteE->est_nombre_tutor =  $request->get('nombre_tutor');
            $estudianteE->est_telefono_tutor =  $request->get('telefono_tutor');
            $estudianteE->est_domicilio_tutor =  $request->get('domicilio_tutor');
            $estudianteE->est_ocupacion_tutor =  $request->get('ocupacion_tutor');
            
            $estudianteE->est_examen_ingreso_estado =  13;
            
            $personaE->save();
            $estudianteE->save();
            return redirect()->route('administracion.index')->with('status', 'Se completo el registro de sus datos, ahora tiene que realizar el deposito de Bs. 1, a la cuenta bancaria XXXXXXXXXXX para su inscripcion.');

        }
        catch(QueryException $err, Exception $e){
            if($err){
                $e = json_decode(json_encode($err), true);
                $numeroError = $e['errorInfo'][1];
                $nombreError = $e['errorInfo'][2];
                return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual ('.$numeroError.' - '.$nombreError.')');
            }
            else{
                return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
            }
        }
    }

    public function show($id)
    {
        /** ------------------- mostrar formulario de registro de datos de estudiantes --------------------- */
        // esta funcion se llama cuando el estudiante esta en un estado de preinscrito (7) con el rol estudiante
        try{
            $idnumero = (int) $id;
            $datos = DB::table('personas')
                    ->join('estudiantes', 'estudiantes.est_per_id', '=', 'personas.per_id')
                    ->where('personas.per_id', '=', (int)$idnumero)
                    ->where('estudiantes.est_subd_estado', '<=', 7)
                    ->where('personas.per_rol', '<=', 5)
                    ->get()
                    ->first();
            if($datos != null){

                $nombreExt = Subdominios::select('subdominios.*')
                        ->where('subd_id', '=', $datos->per_subd_extension)
                        ->get()
                        ->first();

                $nombreGenero = Subdominios::select('subdominios.*')
                                ->where('subd_id', '=', $datos->per_subd_genero)
                                ->get()
                                ->first();

                $nombreSem = Semestre::select('semestre.*')
                                ->where('sem_id', '=', $datos->est_sem_id)
                                ->get()
                                ->first();

                $genero = Subdominios::select('subdominios.*')
                        ->where('subd_dom_id', '=', 2)
                        ->get();
                        
                $extension = Subdominios::select('subdominios.*')
                        ->where('subd_dom_id', '=', 9)
                        ->get();

                $anio = Semestre::select('semestre.*')
                        ->get();

                $ua = UnidadAcademica::select('unidad_academica.*')
                        ->get();

                $especialidades = Especialidades::select('especialidades.*')
                                    ->get();
                return view('ebid-views-administrador.estudiante.estudiante-nuevo-est', [
                    'datos'=>$datos, 
                    'genero'=>$genero, 
                    'extension'=>$extension, 
                    'anio'=>$anio, 
                    'uacad'=>$ua, 
                    'nombreExt'=>$nombreExt,
                    'nombreGen'=>$nombreGenero,
                    'nombreSem' => $nombreSem,
                    'especialidad' => $especialidades]);

            }else if($datos == null){
                return redirect()->route('administracion.index')->with('status', 'No puede ingresar a esta pagina');
            }
            
        }
        catch(QueryException $err, Exception $e){
            if($err){
                $e = json_decode(json_encode($err), true);
                $numeroError = $e['errorInfo'][1];
                $nombreError = $e['errorInfo'][2];
                return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual ('.$numeroError.' - '.$nombreError.')');
            }
            else{
                return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
            }
        }
    }
}
