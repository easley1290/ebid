<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Exception;

use App\Models\Estudiantes;
use App\Models\Subdominios;
use App\Models\Semestre;
use App\Models\MateriaEstudiante;
use App\Models\Personas;
use App\Models\UnidadAcademica;
use App\Models\Pensum;

class CalendarioExamenIngresoController extends Controller
{
    public function index()
    {
        /*------------------se obtiene en lista los alumnos en estado preexamen (8)---------------- */
        try{
            $estudiantes = DB::table('estudiantes')
                            ->join('personas', 'personas.per_id','=', 'estudiantes.est_per_id')
                            ->join('comprobantes', 'comprobantes.com_est_id','=', 'estudiantes.est_id')
                            ->where('estudiantes.est_subd_estado', '=', 8)
                            ->where('comprobantes.com_estado', '=', 1)
                            ->where('comprobantes.com_tipo', '=', 'examen')
                            ->get();

            return view('ebid-views-administrador.inscripcion.calendario-ingreso',['estudiantes' => $estudiantes]);
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
    
    public function store(Request $request)
    {
        /*----guarda datos del examen de ingreso en el calendario----*/
        $datosEvento = request()->except(['_token', '_method']);
        $estudianteC = Estudiantes::find($datosEvento['est_id']);
        $estudianteC->est_examen_ingreso_fecha = $datosEvento['est_examen_ingreso_fecha'];
        $estudianteC->est_examen_ingreso_color = $datosEvento['est_examen_ingreso_color'];
        $estudianteC->est_examen_ingreso_estado = $datosEvento['est_examen_ingreso_estado'];
        $estudianteC->save();

        $estudianteH = DB::table('estudiantes')
                        ->join('personas', 'personas.per_id','=', 'estudiantes.est_per_id')
                        ->where('personas.per_id', '=', $estudianteC->est_per_id)
                        ->get();
        return response()->json($estudianteH);
    }

    public function show($id)
    {
        // muestra datos del examen de ingreso de todos los estudiantes con estado pre examen (8)
        $datos['eventos'] = DB::table('estudiantes')
                        ->join('personas', 'personas.per_id','=', 'estudiantes.est_per_id')
                        ->where('estudiantes.est_subd_estado', '=', 8)
                        ->where('estudiantes.est_examen_ingreso_fecha', '!=', "")
                        ->get();

        foreach($datos['eventos'] as $resultado){
            $title = $resultado->name;
            $start = $resultado->est_examen_ingreso_fecha;
            $id = $resultado->est_id;
            $color = $resultado->est_examen_ingreso_color;
            $textColor = '#000000';
            $eventos[] = array('id' => $id, 'title' => $title, 'start' => $start, 'color' => $color, 'textColor' => $textColor);
        }
        return response()->json($eventos);
    }
}
