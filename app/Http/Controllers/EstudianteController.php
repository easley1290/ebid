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
use Illuminate\Support\Facades\DB;

class EstudianteController extends Controller
{
    
    public function index()
    {
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
        } catch (Exception $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
    }

    public function busquedaEstudiante(Request $request)
    {
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
