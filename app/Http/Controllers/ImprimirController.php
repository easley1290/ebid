<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;

use App\Models\Estudiantes;
use App\Models\Subdominios;
use App\Models\Semestre;
use App\Models\MateriaEstudiante;
use App\Models\Personas;
use App\Models\UnidadAcademica;
use App\Models\Pensum;
use Illuminate\Database\QueryException;


class ImprimirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = Carbon::now()->format('d/m/Y H:i');
        $pdf = \PDF::loadView('ebid-views-administrador.notas.notas-imprimir', compact('today'));
        return $pdf->stream('Notas '.$today.'.pdf');
    }
    public function ImprimirNotas(Request $request)
    {
        try{
            if($request){

                $idEstudiante = Estudiantes::select('*')
                                ->where('est_per_id', '=', $request->get('codigo_estudiante'))
                                ->first();
                $persona      = Personas::select('*')
                                ->where('per_id', '=', $request->get('codigo_estudiante'))
                                ->first();
                $materiaEstudiante = Personas::select('personas.name', 'personas.per_num_documentacion', 'estudiantes.est_id', 'materia_estudiante.mate_id', 'notas.*', 'materias.mat_id', 'materias.mat_nombre', 'materia_estudiante.mate_sem_id')
                                ->join('estudiantes', 'estudiantes.est_per_id', '=', 'personas.per_id')
                                ->join('materia_estudiante', 'materia_estudiante.mate_est_id', '=', 'estudiantes.est_id')
                                ->join('notas', 'notas.nota_mate_id', '=', 'materia_estudiante.mate_id')
                                ->join('materias', 'materias.mat_id', '=', 'materia_estudiante.mate_mat_id')
                                ->where('materia_estudiante.mate_est_id', '=', $idEstudiante->est_id)
                                ->where('materia_estudiante.mate_sem_id', '=', $request->get('imprimir_anio'))
                                ->where('personas.per_rol', '=', 3)
                                ->get();
                                //dd($materiaEstudiante);
                $today = Carbon::now()->format('d/m/Y');
                $hour = Carbon::now()->format('H:i');
                
                $pdf = \PDF::loadView('ebid-views-administrador.notas.notas-imprimir', 
                compact('today','hour','materiaEstudiante','persona'))
                ->setPaper('a4', 'landscape');
                return $pdf->stream('Seguimiento de Notas '.$today.'.pdf');
            }
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

    public function ImprimirPersonal()
    {
        try{
            $personas_adm = Personas::select('personas.name','personas.email','personas.per_telefono','personas.per_num_documentacion','personas.per_codigo_institucional','personas.per_rol','subdominios.subd_nombre')
                        ->join('Subdominios', 'personas.per_subd_documentacion', '=', 'subdominios.subd_id')
                        ->where('personas.per_subd_estado','=',1)
                        ->where('personas.per_rol', '=',[1,2])
                        ->get();
            $personas_adm_num = Personas::select('personas.name','personas.email','personas.per_telefono','personas.per_num_documentacion','personas.per_codigo_institucional','personas.per_rol','subdominios.subd_nombre')
                        ->join('Subdominios', 'personas.per_subd_documentacion', '=', 'subdominios.subd_id')
                        ->where('personas.per_subd_estado','=',1)
                        ->where('personas.per_rol', '=',[1,2])
                        ->count();
            
            $personas_doc = Personas::select('personas.name','personas.email','personas.per_telefono','personas.per_num_documentacion','personas.per_codigo_institucional','personas.per_rol','subdominios.subd_nombre')
                        ->join('Subdominios', 'personas.per_subd_documentacion', '=', 'subdominios.subd_id')
                        ->where('personas.per_subd_estado','=',1)
                        ->where('personas.per_rol', '=',[6])
                        ->get(); 
            $personas_doc_num = Personas::select('personas.name','personas.email','personas.per_telefono','personas.per_num_documentacion','personas.per_codigo_institucional','personas.per_rol','subdominios.subd_nombre')
                        ->join('Subdominios', 'personas.per_subd_documentacion', '=', 'subdominios.subd_id')
                        ->where('personas.per_subd_estado','=',1)
                        ->where('personas.per_rol', '=',[6])
                        ->count(); 
            

            $today = Carbon::now()->format('d/m/Y');
            $hour = Carbon::now()->format('H:i');
            
            $pdf = \PDF::loadView('ebid-views-administrador.imprimir.imprimir_personas', 
            compact('today','hour','personas_adm','personas_adm_num','personas_doc','personas_doc_num'))
            ->setPaper('a4', 'landscape');
            return $pdf->stream('Informe Personal '.$today.'.pdf');

            
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
    public function ImprimirEstudiantes()
    {
        try{
           
            $personas_est = Personas::select('personas.name','personas.email','personas.per_telefono','personas.per_correo_institucional','personas.per_codigo_institucional','personas.per_rol','roles.rol_descripcion')
                        ->join('roles', 'personas.per_rol', '=', 'roles.rol_id')
                        ->where('personas.per_subd_estado','=',1)
                        ->where('personas.per_rol', '=',[3,4,5])
                        ->get();
            $personas_est_num = Personas::select('personas.name','personas.email','personas.per_telefono','personas.per_correo_institucional','personas.per_codigo_institucional','personas.per_rol','roles.rol_descripcion')
                        ->join('roles', 'personas.per_rol', '=', 'roles.rol_id')
                        ->where('personas.per_subd_estado','=',1)
                        ->where('personas.per_rol', '=',[3,4,5])
                        ->count();
            
            $personas_usu = Personas::select('personas.name','personas.email','personas.per_telefono','personas.per_correo_institucional','personas.per_codigo_institucional','personas.per_rol','roles.rol_descripcion')
                        ->join('roles', 'personas.per_rol', '=', 'roles.rol_id')
                        ->where('personas.per_subd_estado','=',1)
                        ->where('personas.per_rol', '=',[7])
                        ->get(); 
            $personas_usu_num = Personas::select('personas.name','personas.email','personas.per_telefono','personas.per_correo_institucional','personas.per_codigo_institucional','personas.per_rol','roles.rol_descripcion')
                        ->join('roles', 'personas.per_rol', '=', 'roles.rol_id')
                        ->where('personas.per_subd_estado','=',1)
                        ->where('personas.per_rol', '=',[7])
                        ->count();  

            $today = Carbon::now()->format('d/m/Y');
            $hour = Carbon::now()->format('H:i');
            
            $pdf = \PDF::loadView('ebid-views-administrador.imprimir.imprimir_est', 
            compact('today','hour','personas_est','personas_est_num','personas_usu','personas_usu_num'))->
            setPaper('a4', 'landscape');
            return $pdf->stream('Informe Estudiantil '.$today.'.pdf');

            
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
    public function ImprimirDocentes()
    {
        $personas_doc = Personas::select('personas.name','personas.email','personas.per_telefono','personas.per_num_documentacion','personas.per_codigo_institucional','personas.per_rol','subdominios.subd_nombre')
                        ->join('Subdominios', 'personas.per_subd_documentacion', '=', 'subdominios.subd_id')
                        ->where('personas.per_subd_estado','=',1)
                        ->where('personas.per_rol', '=',[6])
                        ->get(); 
           
        $today = Carbon::now()->format('dd/mm/yyyy');
        $pdf = \PDF::loadView('ebid-views-administrador.imprimir.imprimir_personas', compact('today','personas_adm','personas_est','personas_doc','personas_usu'))->setPaper('a4', 'landscape');
        return $pdf->stream('Reporte Personal '.$today.'.pdf');
    }
    public function ImprimirAdministrativo()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
