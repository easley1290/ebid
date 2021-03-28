<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personas;
use App\Models\Estudiantes;
use App\Models\Subdominios;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PostulantesController extends Controller
{
    public function index()
    {
         /*-----------Se llama a la vista del listado de postulantes con estado pre examen(8) y per_rol = 1---------------------------*/
        try{
            $postulante = DB::table('personas')
                            ->join('estudiantes', 'estudiantes.est_per_id', '=', 'personas.per_id')
                            ->select('personas.*', 'estudiantes.*')
                            ->where('estudiantes.est_subd_estado', '=', 8)
                            ->where('personas.per_subd_estado', '=', 1)
                            ->where('personas.per_rol', '=', 1)
                            ->get();

            $subdominiosExamen = Subdominios::select('subdominios.*')
                        ->where('subdominios.subd_dom_id', '=', 7)
                        ->get();

            $subdominiosEst = Subdominios::select('subdominios.*')
                        ->where('subdominios.subd_dom_id', '=', 3)
                        ->get();
           
            $extension = Subdominios::select('subdominios.*')
                        ->where('subdominios.subd_dom_id', '=', 9)
                        ->get();

            $arrayAux = [$postulante, $subdominiosExamen, $subdominiosEst, $extension];
            return view('ebid-views-administrador.inscripcion.lista-postulante')->with('arrayAux', $arrayAux);
        }catch(Exception $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
    }
    public function create(){
        /*-----------Se llama a la vista del resgitro del postulante---------------------------*/
        try{
            $extension = Subdominios::select('subdominios.*')
                        ->where('subd_dom_id','=',9)
                        ->get();
            return view ('ebid-views-administrador.inscripcion.pre-inscripcion')->with('extension', $extension);
        }catch(Exception $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
    }
    public function store(Request $request)
    {
        /*-----------Se registra al estudiante nuevo como postulante y una id de subdomnio 8 = Pre examen-------------*/
        try{
            $this->validate($request,[
                'nombres_estudiante' => 'required|min:2|max:50',
                'paterno_estudiante' => 'required|min:2|max:50',
                'materno_estudiante' => 'required|min:2|max:50',
                'numero_ci_estudiante' => 'required|min:5',
                'extension_ci_estudiante' => 'required',
                'numero_telefono_estudiante' => 'required|min:8|max:11',
                'email' => 'required|min:8|max:50',
                'password' => 'required|min:8|max:100',
            ]);

            $personaC = new Personas;

            if($request->get('per_alfanumerico')==null)
            {
                $alfa = " ";
            }else{
                $alfa = $request->get('per_alfanumerico');
            }

            $personaC->per_nombres = (string) ucwords(strtolower($request->get('nombres_estudiante')));
            $personaC->per_paterno = (string) ucwords(strtolower($request->get('paterno_estudiante')));
            $personaC->per_materno = (string) ucwords(strtolower($request->get('materno_estudiante')));
            $personaC->per_num_documentacion = trim($request->get('numero_ci_estudiante').$alfa);
            $personaC->per_subd_extension = $request->get('extension_ci_estudiante');
            $personaC->per_telefono = (int) $request->get('numero_telefono_estudiante');
            $personaC->name = $request->get('nombres_estudiante').' '.$request->get('paterno_estudiante').' '. $request->get('materno_estudiante');
            $personaC->email = (string) $request->get('email');
            $personaC->per_correo_personal = (string) $request->get('email');
            $personaC->password = Hash::make($request->get('numero_ci_estudiante'));
            $personaC->per_ua_id = 'UA-EA0001';
            $personaC->per_subd_estado = 1;
            $personaC->per_rol = '1';
            $personaC->save();

            $estudianteC = new Estudiantes;
            $persona = Personas::select('personas.per_id')
                        ->where('personas.per_num_documentacion', '=', $request->get('numero_ci_estudiante').$alfa)
                        ->get();
                    
            $estudianteC->est_per_id = $persona[0]->per_id;
            $estudianteC->est_subd_estado = 8;
            $estudianteC->save();
            
            return redirect()->route('postulante.index')->with('status', 'Se creo un nuevo registro del postulante.');
            
        } catch(Exception $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
    }
    public function update(Request $request, $id)
    {
        try{
            $this->validate($request,[
                'nombres_estudiante' => 'required|min:2|max:50',
                'paterno_estudiante' => 'required|min:2|max:50',
                'materno_estudiante' => 'required|min:2|max:50',
                'numero_ci_estudiante' => 'required|min:5',
                'extension_ci_estudiante' => 'required',
                'numero_telefono_estudiante' => 'required|min:8|max:11',
                'email' => 'required|min:8|max:50'
            ]);

            $personaE = Personas::where('per_id', $id)->firstOrFail();

            $personaE->per_nombres = (string) $request->get('nombres_estudiante');
            $personaE->per_paterno = (string) $request->get('paterno_estudiante');
            $personaE->per_materno = (string) $request->get('materno_estudiante');
            $personaE->per_num_documentacion = trim($request->get('numero_ci_estudiante'));
            $personaE->per_subd_extension = $request->get('extension_ci_estudiante');
            $personaE->per_telefono = (int) $request->get('numero_telefono_estudiante');
            $personaE->name = $request->get('nombres_estudiante').' '.$request->get('paterno_estudiante').' '. $request->get('materno_estudiante');
            $personaE->email = (string) $request->get('email');
            $personaE->per_correo_personal = (string) $request->get('email');
            $personaE->save();

            return redirect()->route('postulante.index')->with('status', 'Se modifico el registro del postulante '.$request->get('nombres_estudiante').' '.$request->get('paterno_estudiante').' '. $request->get('materno_estudiante'));
        } catch(Exception $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
    }

    public function destroy($id)
    {
        try{
            $personaD = Personas::find($id);
            $personaD->delete();
            return redirect()->route('postulante.index')->with('status', 'Se elimino el registro del postulante');
        } catch(Throwable $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
    }
}
