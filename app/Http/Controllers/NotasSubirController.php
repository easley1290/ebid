<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notas;
use App\Models\MateriaEstudiante;
use App\Models\MateriaDocente;
use App\Models\Materias;
use App\Models\Estudiantes;
use App\Models\Personas;
use App\Models\Docentes;
use App\Models\Subdominios;
use App\Models\Dominios;

use Illuminate\Support\Facades\DB;

class NotasSubirController extends Controller
{
    public function index()
    {
        try{
            $idUsuario = auth()->user()->per_id;
            $docente = Docentes::select('docentes.*')
                    ->where('doc_per_id','=',66)
                    ->first();
            
            $materiaDocente = MateriaDocente::select('materias_docente.*')
                    ->where('matd_doc_id','=',$docente->doc_id)
                    ->get();
            
            $materias = Materias::select('materias.*')
                        ->get();
            $parcialActual = Subdominios::select('subd_descripcion')
                            ->where('subd_nombre', '=', 'Parcial a cerrar')
                            ->first();
            return view('ebid-views-administrador.notas.notas-subir', [
                        'materiaDocente'=>$materiaDocente,
                        'materias'=>$materias,
                        'parcialActual'=>$parcialActual]);
        }
        catch (Throwable $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
    }

    public function busquedaMateriaEstudiante(Request $request)
    {
        if($request->ajax()){
            $materiasEstudiante = Personas::select('personas.name', 'personas.per_num_documentacion', 'estudiantes.est_id', 'materia_estudiante.mate_id')
                                ->join('estudiantes', 'estudiantes.est_per_id', '=', 'personas.per_id')
                                ->join('materia_estudiante', 'materia_estudiante.mate_est_id', '=', 'estudiantes.est_id')
                                ->where('materia_estudiante.mate_mat_id', '=', $request->get('busqueda_materia_docente'))
                                ->where('personas.per_rol', '=', 3)
                                ->get();
            return response(json_encode($materiasEstudiante), 200)->header('Content-type', 'text/plain');
        }
    }

    public function store(Request $request)
    {
        try{
            $indicadorParcialACerrar = Subdominios::select('subd_descripcion')
                                    ->where('subd_nombre', '=', 'Parcial a cerrar')
                                    ->first();
        
            if(intval($indicadorParcialACerrar->subd_descripcion) == 1){
                $numeroEstudiantes=$request->get('contador');
                for($i=0; $i<=$numeroEstudiantes; $i++){
                    $notaFinal = floatval($request->get('nota'.$i))/4;
                    $notaParcial =  Notas::create([
                        'nota_mate_id' => $request->get('materiaEstudiante'.$i),
                        'nota_final1' => floatval($request->get('nota'.$i)),
                        'nota_final2' => 0,
                        'nota_final3' => 0,
                        'nota_final4' => 0,
                        'nota_indicador1' => 0,
                        'nota_indicador2' => 0,
                        'nota_indicador3' => 0,
                        'nota_indicador4' => 0,
                        'nota_final' => $notaFinal
                    ]);
                }
            }
            if(intval($indicadorParcialACerrar->subd_descripcion) >= 2){
                $numeroEstudiantes=$request->get('contador');
                for($i=0; $i<=$numeroEstudiantes; $i++){
                    $dato=Notas::select('*')
                                ->where('nota_mate_id', '=', $request->get('materiaEstudiante'.$i))
                                ->first();
                    
                    $datoAModificar = Notas::find($dato->nota_id);
                    switch(intval($indicadorParcialACerrar->subd_descripcion)){
                        case 2: 
                            $datoAModificar->nota_final2 = floatval($request->get('nota'.$i));
                            $datoAModificar->nota_final3 = 0;
                            $datoAModificar->nota_final4 = 0;
                            $datoAModificar->nota_indicador2 = 0;
                            $datoAModificar->nota_indicador3 = 0;
                            $datoAModificar->nota_indicador4 = 0;
                            $notaFinal = (floatval($datoAModificar->nota_final1) + floatval($request->get('nota'.$i)))/4;
                            $datoAModificar->nota_final = $notaFinal;
                            $datoAModificar->save();
                            break;
                        case 3:
                            $datoAModificar->nota_final3 = floatval($request->get('nota'.$i));
                            $datoAModificar->nota_final4 = 0;
                            $datoAModificar->nota_indicador3 = 0;
                            $datoAModificar->nota_indicador4 = 0;
                            $notaFinal = (floatval($datoAModificar->nota_final1) + floatval($datoAModificar->nota_final2) + floatval($request->get('nota'.$i)))/4;
                            $datoAModificar->nota_final = $notaFinal;
                            $datoAModificar->save();
                            break;
                        case 4:
                            $datoAModificar->nota_final4 = floatval($request->get('nota'.$i));
                            $datoAModificar->nota_indicador4 = 0;
                            $notaFinal = (floatval($datoAModificar->nota_final1) + floatval($datoAModificar->nota_final2) + floatval($datoAModificar->nota_final3) + floatval($request->get('nota'.$i)))/4;
                            $datoAModificar->nota_final = $notaFinal;
                            $datoAModificar->save();
                            break;
                        default:
                            break;
                    }
                }
            }
            return redirect()->route('ver-notas.index')->with('status', 'Se subio las notas de su materia exitosamente');
        }
        catch (Throwable $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
    }
}
