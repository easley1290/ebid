<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiantes;
use App\Models\Subdominios;
use App\Models\Semestre;
use App\Models\MateriaEstudiante;
use App\Models\Personas;
use App\Models\UnidadAcademica;
use App\Models\Pensum;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class EstudianteController extends Controller
{
    
    public function index()
    {
        try{
            $estudiante = DB::table('estudiantes')
                            ->select('personas.name', 'personas.per_num_documentacion', 'personas.per_telefono', 'personas.per_codigo_institucional')
                            ->join('personas', 'estudiantes.est_per_id', '=', 'personas.per_id')
                            ->get();
            $subdominios = Subdominios::all();
            $arrayAux = [$subdominios, $estudiante];
            return view('ebid-views-administrador.estudiante.estudiante-home')->with('arrayAux', $arrayAux);
        } catch (Exception $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
    }
    public function indexNuevo()
    {
        try{
            $estudiante = Estudiantes::all();
            $extension = Subdominios::select('subdominios.*')
                        ->where('subd_dom_id','=',9)
                        ->get();
            $genero = Subdominios::select('subdominios.*')
                        ->where('subd_dom_id','=',2)
                        ->get();
            $semestre = Semestre::all();
            $unidadAcademica = UnidadAcademica::all();
            $arrayAux = [$extension, $estudiante, $genero, $semestre, $unidadAcademica];
            return view('ebid-views-administrador.estudiante.anadir-nuevo')->with('arrayAux', $arrayAux);
        } catch (Exception $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
    }

    public function busquedaEstudiante(Request $request)
    {
        try{
            if($request->ajax()){
                $estudiante = Personas::select('personas.*')
                            ->where('per_num_documentacion', '=', $request->get('busqueda_estudiante'))
                            ->where('per_subd_estado', '=', 2)
                            ->get();
                return response(json_encode($estudiante), 200)->header('Content-type', 'text/plain');
            }
        } catch (Exception $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
    }

    public function storeNuevo(Request $request)
    {
        try{
            $this->validate($request,[
                'nombre_estudiante' => 'required|min:2|max:50',
                'paterno_estudiante' => 'required|min:2|max:50',
                'materno_estudiante' => 'required|min:2|max:50',
                'fec_nacimiento_estudiante' => 'required',
                'numero_ci_estudiante' => 'required|min:5',
                'extension_ci_estudiante' => 'required',
                'numero_telefono_estudiante' => 'required|min:8|max:11',
                'correo_personal_estudiante' => 'required|min:8|max:50',
                'domicilio_estudiante' => 'required|min:5|max:100',
                'genero_estudiante' => 'required',
                'comprobante_estudiante' => 'required|image|mimes:png,jpg,jpeg|max:8192',
                'anio_estudiante' => 'required',
                'ua_estudiante' => 'required'
            ]);
            
            
            $persona = Personas::all() -> last();
            if($persona == null){
                $personaId = 1;
            }else{
                $personaId = $persona -> per_id;
                $personaId = $personaId + 1;
            }   

            $personaC = new Personas;
            $estudianteC = new Estudiantes;
            $mateC = new MateriaEstudiante;

            if($request->get('alfanumerico_ci_estudiante')==null)
            {
                $alfa = " ";
            }else{
                $alfa = $request->get('alfanumerico_ci_estudiante');
            }

            $personaC->per_id = $personaId;
            $personaC->per_nombres = (string) $request->get('nombre_estudiante');
            $personaC->per_paterno = (string) $request->get('paterno_estudiante');
            $personaC->per_materno = (string) $request->get('materno_estudiante');
            $personaC->per_num_documentacion = trim($request->get('numero_ci_estudiante').$alfa);
            $personaC->per_subd_extension = $request->get('extension_ci_estudiante');
            $personaC->per_fecha_nacimiento = $request->get('fec_nacimiento_estudiante');
            $personaC->per_telefono = (int) $request->get('numero_telefono_estudiante');
            $personaC->name = $request->get('nombre_estudiante').' '.$request->get('paterno_estudiante').' '. $request->get('materno_estudiante');
            $personaC->email = (string) $request->get('correo_personal_estudiante');
            $personaC->per_correo_personal = (string) $request->get('correo_personal_estudiante');
            $personaC->per_domicilio = (string) $request->get('domicilio_estudiante');
            $personaC->password = Hash::make($request->get('numero_ci_estudiante'));
            $personaC->per_subd_genero = $request->get('genero_estudiante');
            $personaC->per_ua_id = $request->get('ua_estudiante');
            
            $estudianteC->est_per_id = $personaId;

            $imagen = $request->file('comprobante_estudiante');
            $nombreImagen = 'Comprobante'.$request->get('numero_ci_estudiante').'_'.date("Y").'.'.$imagen->getClientOriginalExtension();
            $destinoImagen = public_path('assets\img\comprobantes-estudiantes');
            $imagen->move($destinoImagen, $nombreImagen);

            $estudianteC->est_comprobante = $nombreImagen;
            $estudianteC->est_sem_id =  $request->get('anio_estudiante');
            $estudianteC->est_subd_estado = 6;
            $personaC->save();
            $estudianteC->save();

            $pensum = Pensum::select('pensum.*')
                        ->where('pen_sem_id','=',  $request->get('anio_estudiante'))
                        ->where('pen_subd_estado', '=', 1)
                        ->get();
            $tamanio = (int) count($pensum);
            
            $estudianteId = DB::table('estudiantes')
                            ->join('personas', 'estudiantes.est_per_id', '=', 'personas.per_id')
                            ->select('estudiantes.est_id')
                            ->where('personas.per_num_documentacion', '=', $request->get('numero_ci_estudiante'))
                            ->get();

            for ($i = 0; $i < $tamanio; $i++)
            {
                $new = MateriaEstudiante::create([
                    'mate_mat_id' => $pensum[$i]->pen_mat_id,
                    'mate_esp_id' => 1,
                    'mate_sem_id' => $pensum[$i]->pen_sem_id,
                    'mate_est_id' => $estudianteId[0]->est_id,
                    'mate_subd_id' => 9
                ]);
            }
            return redirect()->route('estudiante.index')->with('status', 'Se creo un nuevo registro de estudiante.');
        } catch(Exception $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
    }
    public function updateNuevo(Request $request, $id){
        try{
            $this->validate($request,[
                'e_nombre_estudiante' => 'required|min:2|max:50',
                'e_paterno_estudiante' => 'required|min:2|max:50',
                'e_materno_estudiante' => 'required|min:2|max:50',
                'e_fec_nacimiento_estudiante' => 'required',
                'e_numero_ci_estudiante' => 'required|min:5',
                'e_extension_ci_estudiante' => 'required',
                'e_numero_telefono_estudiante' => 'required|min:8|max:11',
                'e_correo_personal_estudiante' => 'required|min:8|max:50',
                'e_domicilio_estudiante' => 'required|min:5|max:100',
                'e_genero_estudiante' => 'required',
                'e_comprobante_estudiante' => 'required|image|mimes:png,jpg,jpeg|max:8192',
                'e_anio_estudiante' => 'required',
                'e_ua_estudiante' => 'required'
            ]);
            
            $personaE = Personas::find($id);
            $estudianteC = new Estudiantes;
            $mateC = new MateriaEstudiante;

            if($request->get('e_alfanumerico_ci_estudiante')==null){
                $alfa = " ";
            }else{
                $alfa = $request->get('e_alfanumerico_ci_estudiante');
            }

            $personaE->per_nombres = (string) $request->get('e_nombre_estudiante');
            $personaE->per_paterno = (string) $request->get('e_paterno_estudiante');
            $personaE->per_materno = (string) $request->get('e_materno_estudiante');
            $personaE->per_num_documentacion = trim($request->get('e_numero_ci_estudiante').$alfa);
            $personaE->per_subd_extension = $request->get('e_extension_ci_estudiante');
            $personaE->per_fecha_nacimiento = $request->get('e_fec_nacimiento_estudiante');
            $personaE->per_telefono = (int) $request->get('e_numero_telefono_estudiante');
            $personaE->name = trim($request->get('e_nombre_estudiante')).' '.trim($request->get('e_paterno_estudiante')).' '.trim($request->get('e_materno_estudiante'));
            $personaE->email = (string) $request->get('correo_personal_estudiante');
            $personaE->per_domicilio = (string) $request->get('e_domicilio_estudiante');
            $personaE->per_subd_genero = $request->get('e_genero_estudiante');
            $personaE->per_ua_id = $request->get('e_ua_estudiante');
            $personaE->per_subd_estado = 1;

            $estudianteC->est_per_id = $personaE->per_id;

            $imagen = $request->file('e_comprobante_estudiante');
            $nombreImagen = 'Comprobante'.$request->get('e_numero_ci_estudiante').$alfa.'_'.date("Y").'.'.$imagen->getClientOriginalExtension();
            $destinoImagen = public_path('assets\img\comprobantes-estudiantes');
            $imagen->move($destinoImagen, $nombreImagen);

            $estudianteC->est_comprobante = $nombreImagen;
            $estudianteC->est_sem_id =  $request->get('e_anio_estudiante');
            $estudianteC->est_subd_estado = 6;
            $personaE->save();
            $estudianteC->save();

            $pensum = Pensum::select('pensum.*')
                        ->where('pen_sem_id','=',  $request->get('e_anio_estudiante'))
                        ->where('pen_subd_estado', '=', 1)
                        ->get();
            $tamanio = (int) count($pensum);
            
            $estudianteId = DB::table('estudiantes')
                            ->join('personas', 'estudiantes.est_per_id', '=', 'personas.per_id')
                            ->select('estudiantes.est_id')
                            ->where('personas.per_num_documentacion', '=', $request->get('e_numero_ci_estudiante').$alfa)
                            ->get();

            for ($i = 0; $i < $tamanio; $i++)
            {
                $new = MateriaEstudiante::create([
                    'mate_mat_id' => $pensum[$i]->pen_mat_id,
                    'mate_esp_id' => 1,
                    'mate_sem_id' => $pensum[$i]->pen_sem_id,
                    'mate_est_id' => $estudianteId[0]->est_id,
                    'mate_subd_id' => 9
                ]);
            }
            return redirect()->route('estudiante.index')->with('status', 'Se creo un nuevo registro de estudiante.');
        } catch(\Illuminate\Database\QueryException $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
    }
    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
