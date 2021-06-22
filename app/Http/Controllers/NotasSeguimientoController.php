<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Database\QueryException;

use App\Models\Personas;
use App\Models\Semestre;
use App\Models\Estudiantes;

class NotasSeguimientoController extends Controller
{
    public function index()
    {
        try{
            $estudiantes=Personas::select('estudiantes.est_id', 'personas.name', 'personas.per_id')
                        ->join('estudiantes', 'estudiantes.est_per_id', '=', 'personas.per_id')
                        ->get();
            $semestres=Semestre::all();
            return view('ebid-views-administrador.notas.notas-seguimiento', [
                'estudiantes'=>$estudiantes,
                'semestres'=>$semestres
            ]);
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
    public function busquedaEstudianteMateria(Request $request)
    {
        if($request->ajax()){
            $idEstudiante = Estudiantes::select('*')
                            ->where('est_per_id', '=', $request->get('codigo_estudiante'))
                            ->first();
            $materiaEstudiante = Personas::select('personas.name', 'personas.per_num_documentacion', 'estudiantes.est_id', 'materia_estudiante.mate_id', 'notas.*', 'materias.mat_id', 'materias.mat_nombre')
                                ->join('estudiantes', 'estudiantes.est_per_id', '=', 'personas.per_id')
                                ->join('materia_estudiante', 'materia_estudiante.mate_est_id', '=', 'estudiantes.est_id')
                                ->join('notas', 'notas.nota_mate_id', '=', 'materia_estudiante.mate_id')
                                ->join('materias', 'materias.mat_id', '=', 'materia_estudiante.mate_mat_id')
                                ->where('materia_estudiante.mate_est_id', '=', $idEstudiante->est_id)
                                ->where('materia_estudiante.mate_sem_id', '=', $request->get('busqueda_anio'))
                                ->where('personas.per_rol', '=', 3)
                                ->get();
            return response(json_encode($materiaEstudiante), 200)->header('Content-type', 'text/plain');
        }
    }
    public function imprimirEstudianteMateria(Request $request)
    {
        if($request){

            $idEstudiante = Estudiantes::select('*')
                            ->where('est_per_id', '=', $request->get('codigo_estudiante'))
                            ->first();
            $materiaEstudiante = Personas::select('personas.name', 'personas.per_num_documentacion', 'estudiantes.*', 'materia_estudiante.*', 'notas.*', 'materias.mat_id', 'materias.mat_nombre')
                                ->join('estudiantes', 'estudiantes.est_per_id', '=', 'personas.per_id')
                                ->join('materia_estudiante', 'materia_estudiante.mate_est_id', '=', 'estudiantes.est_id')
                                ->join('notas', 'notas.nota_mate_id', '=', 'materia_estudiante.mate_id')
                                ->join('materias', 'materias.mat_id', '=', 'materia_estudiante.mate_mat_id')
                                ->where('materia_estudiante.mate_est_id', '=', $idEstudiante->est_id)
                                ->where('materia_estudiante.mate_sem_id', '=', $request->get('busqueda_anio'))
                                ->where('personas.per_rol', '=', 3)
                                ->get();
            
            $today = Carbon::now()->format('d/m/Y H:i');
            $pdf = \PDF::loadView('ebid-views-administrador.notas.notas-imprimir', compact('today','materiaEstudiante'))->setPaper('a4', 'landscape');
            return $pdf->stream('Seguimiento de Notas '.$today.'.pdf');
        }

    }
}
