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
                return redirect()->route('administracion.index')->with('status', 'Hubo un error inusual ('.$numeroError.' - '.$nombreError.')');
            }
            else{
                return redirect()->route('administracion.index')->with('status', 'Hubo un error inusual');
            }
        }
    }
}
