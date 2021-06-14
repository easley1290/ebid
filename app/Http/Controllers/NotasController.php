<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

use App\Models\Notas;
use App\Models\MateriaEstudiante;
use App\Models\MateriaDocente;
use App\Models\Materias;
use App\Models\Estudiantes;
use App\Models\Personas;
use App\Models\Docentes;
use App\Models\Subdominios;
use App\Models\Dominios;

class NotasController extends Controller
{
    public function index()
    {
        //mostrar vista de seleccion de materia para ver notas
        try{
            $idUsuario = auth()->user()->per_id;
            $docente = Docentes::select('docentes.*')
                    ->where('doc_per_id','=', $idUsuario)
                    ->first();
            
            if($docente != null){
                $materiaDocente = MateriaDocente::select('materias_docente.*')
                    ->where('matd_doc_id','=',$docente->doc_id)
                    ->get();
            
                $materias = Materias::select('materias.*')
                    ->get();
                return view('ebid-views-administrador.notas.notas-ver', [
                    'materiaDocente'=>$materiaDocente,
                    'materias'=>$materias
                ]);
            }
            else{
                $materias = Materias::select('materias.*')
                            ->get();
                return view('ebid-views-administrador.notas.notas-ver', [
                    'materiaDocente'=>[],
                    'materias'=>$materias
                ])->with('status', 'No posee materias asiganadas');
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

    public function busquedaMateriaEstudianteNotas(Request $request)
    {
        // funcion ajax de buscar las notas de los estudiantes por materia
        if($request->ajax()){
            $materiaEstudiante = Personas::select('personas.name', 'personas.per_num_documentacion', 'estudiantes.est_id', 'materia_estudiante.mate_id', 'notas.*')
                ->join('estudiantes', 'estudiantes.est_per_id', '=', 'personas.per_id')
                ->join('materia_estudiante', 'materia_estudiante.mate_est_id', '=', 'estudiantes.est_id')
                ->join('notas', 'notas.nota_mate_id', '=', 'materia_estudiante.mate_id')
                ->where('materia_estudiante.mate_mat_id', '=', $request->get('busqueda_materia_docente'))
                ->where('personas.per_rol', '=', 3)
                ->get();
            return response(json_encode($materiaEstudiante), 200)->header('Content-type', 'text/plain');
        }
    }

    public function update(Request $request, $id)
    {
        // recibiendo variable not_id
        // guardar notas de los estudiantes ************
        try{
            $notaE = Notas::find($id);
            $notaE->nota_final1 = $request->get('nota1');
           
            $notaE->nota_final2 = $request->get('nota2');
            $notaE->nota_final3 = $request->get('nota3');
            $notaE->nota_final4 = $request->get('nota4');
            
            $notaE->nota_indicador1 = 0;
            $notaE->nota_indicador2 = 0;
            $notaE->nota_indicador3 = 0;
            $notaE->nota_indicador4 = 0;
            $notaFinal = floatval($request->get('nota1')) + floatval($request->get('nota2')) + floatval($request->get('nota3')) + floatval($request->get('nota4'));
            $notaFinal = $notaFinal/4;
            $notaFinal = round($notaFinal, 2);
            $notaE->nota_final = $notaFinal;
            $notaE->save();
            return redirect()->route('ver-notas.index')->with('status', 'Se MODIFICO la nota con exito');
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

    public function destroy($id)
    {
        try{
            $notaD = Notas::find($id);
            $notaD->delete();
            return redirect()->route('ver-notas.index')->with('status', 'Se ELIMINO el registro de la nota con exito');
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

    public function cerrarAbrirParcialMod(Request $request)
    {
        //Modificar el parcial vigente
        try{
            $subdominio = Subdominios::select('*')
                    ->where('subd_nombre', '=', 'Parcial actual')
                    ->first();
            if($request->get('indicador_parcial') == "ABRIR"){
                $subdominio->subd_descripcion = $request->get('nombre_parcial');
                $subdominio->save();
                return redirect()->route('administracion.index')->with('status', 'Se abrio el parcial Nro.'.$request->get('nombre_parcial').' con exito');
            }else if ($request->get('indicador_parcial') == "CERRAR"){
                $numeroParcial = $request->get('nombre_parcial');
                switch($numeroParcial){
                    case 1:
                        $subdominio->subd_descripcion = "2";
                        $subdominio->save();
                        return redirect()->route('administracion.index')->with('status', 'Se cerro el parcial Nro.'.$request->get('nombre_parcial').' con exito');
                        break;
                    case 2:
                        $subdominio->subd_descripcion = "3";
                        $subdominio->save();
                        return redirect()->route('administracion.index')->with('status', 'Se cerro el parcial Nro.'.$request->get('nombre_parcial').' con exito');
                        break;
                    case 3:
                        $subdominio->subd_descripcion = "4";
                        $subdominio->save();
                        return redirect()->route('administracion.index')->with('status', 'Se cerro el parcial Nro.'.$request->get('nombre_parcial').' con exito');
                        break;
                    default:
                        break;
                }
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

    public function permisoModificarNotasVer()
    {
        try{
            $materias = Materias::select('*')
                    ->get();
            $estudiantes = Personas::select('personas.name', 'estudiantes.est_id')
                            ->join('estudiantes', 'estudiantes.est_per_id', '=', 'personas.per_id')
                            ->where('personas.per_rol', '=', 3)
                            ->get();
            //Abrir vista para brindar permisos de modificacion
            return view ('ebid-views-administrador.notas.permiso-modificar-nota', [
                'materias'=>$materias,
                'estudiantes'=>$estudiantes
            ]);
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

    public function permisoModificarNotasMod(Request $request)
    {
        //Modificar el indicador de las notas
        try{
            $this->validate($request,[
                'indicador_materia' => 'required',
                'nombre_parcial' => 'required',
                'nombre_estudiante' => 'required'
            ]);
            $nombreMateria = Materias::find($request->get('indicador_materia'));
            $materiaEstudiante = MateriaEstudiante::select('materia_estudiante.mate_id', )
                                ->where('materia_estudiante.mate_mat_id', '=', $request->get('indicador_materia'))
                                ->where('materia_estudiante.mate_est_id', '=', $request->get('nombre_estudiante'))
                                ->first();
            $parcial = $request->get('nombre_parcial');

            $notas = Notas::select('notas.*')
                    ->join('materia_estudiante', 'materia_estudiante.mate_id', '=', 'notas.nota_mate_id')
                    ->where('notas.nota_mate_id', '=', $materiaEstudiante->mate_id)
                    ->first();
            switch($parcial){
                case 1:
                    $notas->nota_indicador1 = "1";
                    $notas->save();
                    return redirect()->route('administracion.index')->with('status', 'Se brindo permisos de modificacion de notas del parcial Nro.'.$parcial.', de la materia '.$nombreMateria->mat_nombre);
                    break;
                case 2:
                    $notas->nota_indicador2 = "1";
                    $notas->save();
                    return redirect()->route('administracion.index')->with('status', 'Se brindo permisos de modificacion de notas del parcial Nro.'.$parcial.', de la materia '.$nombreMateria->mat_nombre);
                    break;
                case 3:
                    $notas->nota_indicador3 = "1";
                    $notas->save();
                    return redirect()->route('administracion.index')->with('status', 'Se brindo permisos de modificacion de notas del parcial Nro.'.$parcial.', de la materia '.$nombreMateria->mat_nombre);
                    break;
                case 4:
                    $notas->nota_indicador4 = "1";
                    $notas->save();
                    return redirect()->route('administracion.index')->with('status', 'Se brindo permisos de modificacion de notas del parcial Nro.'.$parcial.', de la materia '.$nombreMateria->mat_nombre);
                    break;
                default:
                    break;
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

    public function cerrarGestionAcademica(Request $request)
    {
        try
        {
            $subdominio = Subdominios::select('*')
                        ->where('subd_nombre', '=', 'Parcial actual')
                        ->first();
            $subdominio->subd_descripcion = "SEGUNDO TURNO";

            $notas = Notas::select('notas.*', 'materia_estudiante.*')
                    ->join('materia_estudiante', 'materia_estudiante.mate_id', '=', 'notas.nota_mate_id')
                    ->get();
            for($i=0; $i<count($notas); $i++){
                if(floatval($notas[$i]->nota_final) < 6.1){
                    $materiaEstudiante = MateriaEstudiante::find($notas[$i]->nota_mate_id);
                    $materiaEstudiante->mate_subd_id = 12;
                    $materiaEstudiante->save();
                }
            }
            $subdominio->save();
            return redirect()->route('administracion.index')->with('status', 'Se cerro el periodo academico y se abrío el periodo del Segundo Turno.');
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

    public function cerrarDosT(Request $request)
    {
        try{
            $subdominio = Subdominios::select('*')
                        ->where('subd_nombre', '=', 'Parcial actual')
                        ->first();
            $subdominio->subd_descripcion = 1;

            $notas = Notas::select('notas.*', 'materia_estudiante.*')
                    ->join('materia_estudiante', 'materia_estudiante.mate_id', '=', 'notas.nota_mate_id')
                    ->get();
            
            for($i=0; $i<count($notas); $i++){
                if(floatval($notas[$i]->nota_final) < 6.1){
                    $materiaEstudiante = MateriaEstudiante::find($notas[$i]->nota_mate_id);
                    $materiaEstudiante->mate_subd_id = 32;
                    $materiaEstudiante->save();
                    $estudiante = Estudiantes::find($notas[$i]->mate_est_id);
                    $estudiante->est_subd_estado = 7;
                    $estudiante->save();
                }
                else if(floatval($notas[$i]->nota_final) >= 6.1){
                    $materiaEstudiante = MateriaEstudiante::find($notas[$i]->nota_mate_id);
                    $materiaEstudiante->mate_subd_id = 11;
                    $materiaEstudiante->save();
                    $estudiante = Estudiantes::find($notas[$i]->mate_est_id);
                    $estudiante->est_subd_estado = 7;
                    $estudiante->save();
                }
            }
            $subdominio->save();
            return redirect()->route('administracion.index')->with('status', 'Se cerro el periodo academico y se abrío el periodo del Segundo Turno.');
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
}
