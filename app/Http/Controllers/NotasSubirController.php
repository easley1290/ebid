<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

use App\Models\Notas;
use App\Models\MateriaEstudiante;
use App\Models\MateriaDocente;
use App\Models\Materias;
use App\Models\Estudiantes;
use App\Models\Personas;
use App\Models\Docentes;
use App\Models\Subdominios;
use App\Models\Dominios;

class NotasSubirController extends Controller
{
    public function index()
    {
        //retorna vista para subir notas
        try{
            $idUsuario = auth()->user()->per_id;
            $docente = Docentes::select('docentes.*')
                    ->where('doc_per_id','=',$idUsuario)
                    ->first();
            
            if($docente != null){
                $materiaDocente = MateriaDocente::select('materias_docente.*')
                    ->where('matd_doc_id','=',$docente->doc_id)
                    ->get();
            
                $materias = Materias::select('materias.*')
                            ->get();

                $parcialActual = Subdominios::select('subd_descripcion')
                                ->where('subd_nombre', '=', 'Parcial actual')
                                ->first();

                return view('ebid-views-administrador.notas.notas-subir', [
                            'materiaDocente'=>$materiaDocente,
                            'materias'=>$materias,
                            'parcialActual'=>$parcialActual,
                            'docente'=>$docente
                        ]);
            }
            else{
                $materias = Materias::select('materias.*')
                            ->get();
                $parcialActual = Subdominios::select('subd_descripcion')
                                ->where('subd_nombre', '=', 'Parcial actual')
                                ->first();
                return view('ebid-views-administrador.notas.notas-subir', [
                    'materiaDocente'=>[],
                    'materias'=>$materias,
                    'parcialActual'=>$parcialActual
                ])->with('status', 'No posee materias asignadas.');
            }
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

    public function busquedaMateriaEstudiante(Request $request)
    {
        //buscar lista de estudiantes por materia
        if($request->ajax()){
            $subdominio = Subdominios::select('subd_descripcion')
                            ->where('subd_nombre', '=', 'Parcial actual')
                            ->first();

            if($subdominio->subd_descripcion == 'SEGUNDO TURNO'){
                $materiasEstudiante = Personas::select('personas.name', 'personas.per_num_documentacion', 'estudiantes.est_id', 'materia_estudiante.mate_id')
                                ->join('estudiantes', 'estudiantes.est_per_id', '=', 'personas.per_id')
                                ->join('materia_estudiante', 'materia_estudiante.mate_est_id', '=', 'estudiantes.est_id')
                                ->where('materia_estudiante.mate_mat_id', '=', $request->get('busqueda_materia_docente'))
                                ->where('personas.per_rol', '=', 3)
                                ->where('materia_estudiante.mate_subd_id', '=', 12)
                                ->where('materia_estudiante.mate_subir_nota', '=', 1)
                                ->get();

                return response(json_encode($materiasEstudiante), 200)->header('Content-type', 'text/plain');
            }
            else{
                $materiasEstudiante = Personas::select('personas.name', 'personas.per_num_documentacion', 'estudiantes.est_id', 'materia_estudiante.mate_id')
                                ->join('estudiantes', 'estudiantes.est_per_id', '=', 'personas.per_id')
                                ->join('materia_estudiante', 'materia_estudiante.mate_est_id', '=', 'estudiantes.est_id')
                                ->where('materia_estudiante.mate_mat_id', '=', $request->get('busqueda_materia_docente'))
                                ->where('personas.per_rol', '=', 3)
                                ->where('materia_estudiante.mate_subir_nota', '=', 1)
                                ->get();
                return response(json_encode($materiasEstudiante), 200)->header('Content-type', 'text/plain');
            }
        }
    }

    public function store(Request $request)
    {
        try{
            $indicadorParcialACerrar = Subdominios::select('subd_descripcion')
                                    ->where('subd_nombre', '=', 'Parcial actual')
                                    ->first();

            if(intval($indicadorParcialACerrar->subd_descripcion) == 1){
                $numeroEstudiantes=$request->get('contador');
                $anterior1 = '';
                $anterior2 = '';
                $anterior3 = '';
                for($i=0; $i<=$numeroEstudiantes; $i++){
                    $notaPractica = ($request->get('notaA'.$i))*0.7;
                    $notaTeoria = ($request->get('notaB'.$i))*0.3;
                    $notaParcial = (floatval($notaPractica)+floatval($notaTeoria));

                    $notaFinal = floatval($notaParcial)/4;
                    $verExistencia = Notas::select('*')
                                    ->where('nota_mate_id', '=', $request->get('materiaEstudiante'.$i))
                                    ->get();
                    $coun = count($verExistencia); 
                    if($coun!=0){
                        $notaPractica = ($request->get('notaA'.$i))*0.7;
                        $notaTeoria = ($request->get('notaB'.$i))*0.3;
                        $notaParcial = (floatval($notaPractica)+floatval($notaTeoria));
                        $dato=Notas::select('*')
                                ->where('nota_mate_id', '=', $request->get('materiaEstudiante'.$i))
                                ->first();
                        $datoAModificar = Notas::find($dato->nota_id);
                        

                        $anterior2 = explode("|", $datoAModificar->nota_final2);
                        $anterior3 = explode("|", $datoAModificar->nota_final3);
                        $anterior4 = explode("|", $datoAModificar->nota_final4);
                        $notaFinal = (floatval($anterior2[2]) + floatval($anterior3[2]) + floatval($anterior4[2]) + floatval($notaParcial))/4;

                        $datoAModificar->nota_final = $notaFinal;
                        $datoAModificar->nota_final1 = $notaPractica."|".$notaTeoria."|".$notaParcial;

                        $datoAModificar->nota_indicador1 = 0;
                        $datoAModificar->nota_indicador2 = 0;
                        $datoAModificar->nota_indicador3 = 0;
                        $datoAModificar->nota_indicador4 = 0;
                        $datoAModificar->nota_indicador2T = 0;

                        $datoAModificar->save();

                        $materiaEst = MateriaEstudiante::select('*')
                                ->where('mate_id', '=', $request->get('materiaEstudiante'.$i))
                                ->first();
                        $materiaEst->mate_subir_nota = 0;
                        $materiaEst->save();
                    }
                    else{
                        $notaParcial =  Notas::create([
                            'nota_mate_id' => $request->get('materiaEstudiante'.$i),
                            'nota_final1' => $notaPractica."|".$notaTeoria."|".$notaParcial,
                            'nota_final2' => "0|0|0",
                            'nota_final3' => "0|0|0",
                            'nota_final4' => "0|0|0",
                            'nota_dosT' => 0,
                            'nota_indicador1' => 0,
                            'nota_indicador2' => 0,
                            'nota_indicador3' => 0,
                            'nota_indicador4' => 0,
                            'nota_final' => $notaFinal
                        ]);
                    }
                    $materiaEst = MateriaEstudiante::select('*')
                                    ->where('mate_id', '=', $request->get('materiaEstudiante'.$i))
                                    ->first();
                    $materiaEst->mate_subir_nota = 0;
                    $materiaEst->save();
                }
                
            }
            if(strval($indicadorParcialACerrar->subd_descripcion) != '1'){
                $numeroEstudiantes=$request->get('contador');
                $anterior1 = '';
                $anterior2 = '';
                $anterior3 = '';
                for($i=0; $i<=$numeroEstudiantes; $i++){
                    $dato=Notas::select('*')
                                ->where('nota_mate_id', '=', $request->get('materiaEstudiante'.$i))
                                ->first();
                    
                    $datoAModificar = Notas::find($dato->nota_id);
                    switch(strval($indicadorParcialACerrar->subd_descripcion)){
                        case '2': 
                            $notaPractica = ($request->get('notaA'.$i))*0.7;
                            $notaTeoria = ($request->get('notaB'.$i))*0.3;
                            $notaParcial = (floatval($notaPractica)+floatval($notaTeoria));

                            $anterior1 = explode("|", $datoAModificar->nota_final1);
                            $anterior3 = explode("|", $datoAModificar->nota_final3);
                            $anterior4 = explode("|", $datoAModificar->nota_final4);
                            
                            $notaFinal = (floatval($anterior1[2]) + floatval($anterior3[2]) + floatval($anterior4[2]) + floatval($notaParcial))/4;

                            $datoAModificar->nota_final2 = $notaPractica."|".$notaTeoria."|".$notaParcial;
                            $datoAModificar->nota_final = $notaFinal;

                            $datoAModificar->nota_indicador1 = 0;
                            $datoAModificar->nota_indicador2 = 0;
                            $datoAModificar->nota_indicador3 = 0;
                            $datoAModificar->nota_indicador4 = 0;
                            $datoAModificar->nota_indicador2T = 0;

                            $datoAModificar->save();
                            $materiaEst = MateriaEstudiante::select('*')
                                    ->where('mate_id', '=', $request->get('materiaEstudiante'.$i))
                                    ->first();
                            $materiaEst->mate_subir_nota = 0;
                            $materiaEst->save();
                            break;
                        case '3':
                            $notaPractica = ($request->get('notaA'.$i))*0.7;
                            $notaTeoria = ($request->get('notaB'.$i))*0.3;
                            $notaParcial = (floatval($notaPractica)+floatval($notaTeoria));
                            $datoAModificar->nota_final3 = $notaPractica."|".$notaTeoria."|".$notaParcial;

                            $datoAModificar->nota_indicador1 = 0;
                            $datoAModificar->nota_indicador2 = 0;
                            $datoAModificar->nota_indicador3 = 0;
                            $datoAModificar->nota_indicador4 = 0;
                            $datoAModificar->nota_indicador2T = 0;

                            $anterior1 = explode("|", $datoAModificar->nota_final1);
                            $anterior2 = explode("|", $datoAModificar->nota_final2);
                            $anterior4 = explode("|", $datoAModificar->nota_final4);
                            $notaFinal = (floatval($anterior1[2]) + floatval($anterior2[2]) + floatval($anterior4[2]) + floatval($notaParcial))/4;

                            $datoAModificar->nota_final = $notaFinal;
                            $datoAModificar->save();

                            $materiaEst = MateriaEstudiante::select('*')
                                    ->where('mate_id', '=', $request->get('materiaEstudiante'.$i))
                                    ->first();
                            $materiaEst->mate_subir_nota = 0;
                            $materiaEst->save();
                            break;
                        case '4':
                            $notaPractica = ($request->get('notaA'.$i))*0.7;
                            $notaTeoria = ($request->get('notaB'.$i))*0.3;
                            $notaParcial = (floatval($notaPractica)+floatval($notaTeoria));
                            $datoAModificar->nota_final4 = $notaPractica."|".$notaTeoria."|".$notaParcial;

                            $datoAModificar->nota_indicador1 = 0;
                            $datoAModificar->nota_indicador2 = 0;
                            $datoAModificar->nota_indicador3 = 0;
                            $datoAModificar->nota_indicador4 = 0;
                            $datoAModificar->nota_indicador2T = 0;

                            $anterior1 = explode("|", $datoAModificar->nota_final1);
                            $anterior2 = explode("|", $datoAModificar->nota_final2);
                            $anterior3 = explode("|", $datoAModificar->nota_final3);
                            $notaFinal = (floatval($anterior1[2]) + floatval($anterior2[2]) + floatval($anterior3[2]) + floatval($notaParcial))/4;

                            $datoAModificar->nota_final = $notaFinal;
                            $datoAModificar->save();

                            $materiaEst = MateriaEstudiante::select('*')
                                    ->where('mate_id', '=', $request->get('materiaEstudiante'.$i))
                                    ->first();
                            $materiaEst->mate_subir_nota = 0;
                            $materiaEst->save();
                            break;
                        case 'SEGUNDO TURNO':
                            $notaPractica = ($request->get('notaA'.$i))*0.7;
                            $notaTeoria = ($request->get('notaB'.$i))*0.3;
                            $notaParcial = (floatval($notaPractica)+floatval($notaTeoria));
                            $datoAModificar->nota_dosT = $notaPractica."|".$notaTeoria."|".$notaParcial;

                            if($notaParcial >= 61){
                                $notaFinal = 61;
                                $datoAModificar->nota_final = $notaFinal;
                            }else{
                                $datoAModificar->nota_final = $notaFinal;
                            }
                            
                            $datoAModificar->save();
                            $materiaEst = MateriaEstudiante::select('*')
                                    ->where('mate_id', '=', $request->get('materiaEstudiante'.$i))
                                    ->first();
                            $materiaEst->mate_subir_nota = 0;
                            $materiaEst->save();
                            break;
                        default:
                            break;
                    }
                }
            }
            return redirect()->route('ver-notas.index')->with('status', 'Se subio las notas de su materia exitosamente, correspondiente al parcial Nro.'.$indicadorParcialACerrar->subd_descripcion);
        }
        catch(QueryException $err){
            if($err){

                $e = json_decode(json_encode($err), true);
                $numeroError = $e['errorInfo'][1];
                $nombreError = $e['errorInfo'][2];
                $subdominios = Subdominios::select('subd_descripcion')
                        ->where('subd_nombre', '=', 'Parcial actual')
                        ->first();
                return redirect()->route('administracion.index')->with('status', 'Hubo un error inusual ('.$numeroError.' - '.$nombreError.')');
            }
            else{
                return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
            }
        }
    }
}
