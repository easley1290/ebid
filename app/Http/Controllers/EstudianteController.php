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

class EstudianteController extends Controller
{
    public function index()
    {
        // trae el listado de estudiantes preinscritos estado (7) el estado preinscrito es al terminar el año y al aprobar el examen
        try{
            $estudiante = DB::table('estudiantes')
                            ->select('personas.*', 'estudiantes.*')
                            ->join('personas', 'estudiantes.est_per_id', '=', 'personas.per_id')
                            ->where('personas.per_rol', '=', 3)
                            ->where('estudiantes.est_subd_estado', '=', 7)
                            ->where('estudiantes.est_examen_ingreso_estado', '=', 13)
                            ->get();
                            
            $subdominios = Subdominios::all();
            $arrayAux = [$subdominios, $estudiante];
            return view('ebid-views-administrador.estudiante.estudiante-home')->with('arrayAux', $arrayAux);
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

    public function busquedaEstudiante(Request $request)
    {
        //funcion de buscar estudiantes 
        if($request->ajax()){
            $nombre = ucwords(strtolower($request->get('busqueda_nombre')));

            $estudiante = DB::table('personas')
                        ->join('estudiantes', 'estudiantes.est_per_id', '=', 'personas.per_id')
                        ->select('personas.*', 'estudiantes.*')
                        ->where('personas.per_rol', '>=', '4')
                        ->where('personas.name', 'LIKE', '%'.$nombre.'%')
                        ->orWhere('personas.per_num_documentacion', 'LIKE', '%'.$nombre.'%')
                        ->get();
            
            return response(json_encode($estudiante), 200)->header('Content-type', 'text/plain');
        }
    }
}
