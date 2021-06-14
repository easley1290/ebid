<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

use App\Models\Estudiantes;
use App\Models\Subdominios;
use App\Models\Semestre;
use App\Models\MateriaEstudiante;
use App\Models\Personas;
use App\Models\UnidadAcademica;
use App\Models\Pensum;

class EstudianteUsuarioController extends Controller
{
    public function index()
    {
        // esta funcion llama a la vista de lista de los estudiantes inscritos en estado (6)
        try{
            $estudiante = DB::table('estudiantes')
                            ->select('personas.*', 'estudiantes.*')
                            ->join('personas', 'estudiantes.est_per_id', '=', 'personas.per_id')
                            ->where('personas.per_rol', '=', 3)
                            ->where('estudiantes.est_subd_estado', '=', 6)
                            ->where('estudiantes.est_examen_ingreso_estado', '=', 13)
                            ->get();
                            
            $subdominios = Subdominios::all();
            $arrayAux = [$subdominios, $estudiante];
            return view('ebid-views-administrador.estudiante.estudiante-home-usu')->with('arrayAux', $arrayAux);
        }
        catch(QueryException $err){
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
    
    // public function store(Request $request)
    // {
    //     try{
    //         $this->validate($request,[
    //             'nombre_estudiante' => 'required|min:2|max:50',
    //             'paterno_estudiante' => 'required|min:2|max:50',
    //             'materno_estudiante' => 'required|min:2|max:50',
    //             'fec_nacimiento_estudiante' => 'required',
    //             'numero_ci_estudiante' => 'required|min:5',
    //             'extension_ci_estudiante' => 'required',
    //             'numero_telefono_estudiante' => 'required|min:8|max:11',
    //             'correo_personal_estudiante' => 'required|min:8|max:50',
    //             'domicilio_estudiante' => 'required|min:5|max:100',
    //             'genero_estudiante' => 'required',
    //             'comprobante_estudiante' => 'required|image|mimes:png,jpg,jpeg|max:8192',
    //             'anio_estudiante' => 'required',
    //             'ua_estudiante' => 'required'
    //         ]);
        
    //         $persona = Personas::all() -> last();
    //         if($persona == null){
    //             $personaId = 1;
    //         }else{
    //             $personaId = $persona -> per_id;
    //             $personaId = $personaId + 1;
    //         }   

    //         $personaC = new Personas;
    //         $estudianteC = new Estudiantes;
    //         $mateC = new MateriaEstudiante;

    //         if($request->get('alfanumerico_ci_estudiante')==null)
    //         {
    //             $alfa = " ";
    //         }
    //         else{
    //             $alfa = $request->get('alfanumerico_ci_estudiante');
    //         }

    //         $personaC->per_id = $personaId;
    //         $personaC->per_nombres = (string) $request->get('nombre_estudiante');
    //         $personaC->per_paterno = (string) $request->get('paterno_estudiante');
    //         $personaC->per_materno = (string) $request->get('materno_estudiante');
    //         $personaC->per_num_documentacion = trim($request->get('numero_ci_estudiante').$alfa);
    //         $personaC->per_subd_extension = $request->get('extension_ci_estudiante');
    //         $personaC->per_fecha_nacimiento = $request->get('fec_nacimiento_estudiante');
    //         $personaC->per_telefono = (int) $request->get('numero_telefono_estudiante');
    //         $personaC->name = $request->get('nombre_estudiante').' '.$request->get('paterno_estudiante').' '. $request->get('materno_estudiante');
    //         $personaC->email = (string) $request->get('correo_personal_estudiante');
    //         $personaC->per_correo_personal = (string) $request->get('correo_personal_estudiante');
    //         $personaC->per_domicilio = (string) $request->get('domicilio_estudiante');
    //         $personaC->password = Hash::make($request->get('numero_ci_estudiante'));
    //         $personaC->per_subd_genero = $request->get('genero_estudiante');
    //         $personaC->per_ua_id = $request->get('ua_estudiante');
            
    //         $estudianteC->est_per_id = $personaId;

    //         $imagen = $request->file('comprobante_estudiante');
    //         $nombreImagen = 'Comprobante'.$request->get('numero_ci_estudiante').'_'.date("Y").'.'.$imagen->getClientOriginalExtension();
    //         $destinoImagen = public_path('assets\img\comprobantes-estudiantes');
    //         $imagen->move($destinoImagen, $nombreImagen);

    //         $estudianteC->est_comprobante = $nombreImagen;
    //         $estudianteC->est_sem_id =  $request->get('anio_estudiante');
    //         $estudianteC->est_subd_estado = 6;
    //         $personaC->save();
    //         $estudianteC->save();

    //         $pensum = Pensum::select('pensum.*')
    //                     ->where('pen_sem_id','=',  $request->get('anio_estudiante'))
    //                     ->where('pen_subd_estado', '=', 1)
    //                     ->get();
    //         $tamanio = (int) count($pensum);
            
    //         $estudianteId = DB::table('estudiantes')
    //                         ->join('personas', 'estudiantes.est_per_id', '=', 'personas.per_id')
    //                         ->select('estudiantes.est_id')
    //                         ->where('personas.per_num_documentacion', '=', $request->get('numero_ci_estudiante'))
    //                         ->get();

    //         for ($i = 0; $i < $tamanio; $i++)
    //         {
    //             $new = MateriaEstudiante::create([
    //                 'mate_mat_id' => $pensum[$i]->pen_mat_id,
    //                 'mate_esp_id' => 1,
    //                 'mate_sem_id' => $pensum[$i]->pen_sem_id,
    //                 'mate_est_id' => $estudianteId[0]->est_id,
    //                 'mate_subd_id' => 9
    //             ]);
    //         }
    //         return redirect()->route('estudiante.index')->with('status', 'Se creo un nuevo registro de estudiante.');
    //     } catch(Exception $e){
    //         return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
    //     }
    // }

}
