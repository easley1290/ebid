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


class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->per_rol == 6){
            try{
                $id_usuario = auth()->user()->per_id;
                $docente = Docentes::select('docentes.*')
                ->where('doc_per_id','=',$id_usuario)
                ->get();
                $docente_id = $docente[0]['doc_id'];
                $materia_docente = MateriaDocente::select('materias_docente.*')
                ->where('matd_doc_id','=',$docente_id)
                ->get();
                $aux_cantidad = count($materia_docente);
                $contador_x = count($materia_docente) - 1;
                $aux_posicion = 0;
                $aux_array_est = [];
                $aux_array_nota = [];
                while($aux_cantidad != 0){
                    $materia_id = $materia_docente[$aux_posicion]['matd_mat_id'];
                    $materia1[$aux_posicion] = $materia_docente[$aux_posicion]['matd_mat_id'];
                    $materia_estudiante = MateriaEstudiante::select('materia_estudiante.*')
                    ->where('mate_mat_id','=',$materia_id)
                    ->get();
                    $aux_cantidad_est = count($materia_estudiante);
                    $contador_y = count($materia_estudiante) - 1;
                    $aux_posicion_1 = 0;
                    while($aux_cantidad_est != 0){
                        $aux_nota = $materia_estudiante[$aux_posicion_1]['mate_id'];
                        $nota = Notas::select('notas.*')
                        ->where('nota_mate_id','=',$aux_nota)
                        ->get();
                        $aux_array_nota[$aux_posicion][$aux_posicion_1] = $nota;
                        $aux_cantidad_est = $aux_cantidad_est - 1;
                        $aux_posicion_1 = $aux_posicion_1 + 1;
                    }
                    $aux_array_y[$aux_posicion] = $contador_y;

                    $aux_cantidad = $aux_cantidad - 1; 
                    $aux_posicion = $aux_posicion + 1;
                }
                $notas = Notas::all();
                $materias_est = MateriaEstudiante::all();
                $materias = Materias::all();
                $estudiantes = Estudiantes::all();
                $personas = Personas::all();
                $aux = [$notas, $materias_est, $materias, $estudiantes, $personas, $materia_docente, $aux_array_nota, $contador_x, $aux_array_y, $materia1];
                return view('ebid-views-administrador.nota.nota-docente')->with('aux', $aux);
            } 
            catch (Throwable $e){
                return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
            }
        }
        else{
            try{
                $notas = Notas::all();
                $materias_est = MateriaEstudiante::all();
                $materias = Materias::all();
                $estudiantes = Estudiantes::all();
                $personas = Personas::all();
                $aux = [$notas, $materias_est, $materias, $estudiantes, $personas];
                return view('ebid-views-administrador.nota.nota')->with('aux', $aux);
            } 
            catch (Throwable $e){
                return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
            }
        }
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
        try{
            $this->validate($request,[
                'nota_examen1' => 'required',
                'nota_examen2' => 'required',
                'nota_examen3' => 'required',
            ]);
            $nota_edit = Notas::find($id);

            $nota_edit->nota_examen1 = $request->input('nota_examen1');
            $nota_edit->nota_examen2 = $request->input('nota_examen2');
            $nota_edit->nota_examen3 = $request->input('nota_examen3');
            $nota_e1 = $request->input('nota_examen1');
            $nota_e2 = $request->input('nota_examen2');
            $nota_e3 = $request->input('nota_examen3');
            $nota_f = $nota_e1+$nota_e2+$nota_e3; /*modificar*/
            $nota_edit->nota_final = $nota_f;
            $nota_edit->save();
            return redirect()->route('Nota.index')->with('status', 'Se REALIZÓ la calificación con exito');
        } 
        catch (Throwable $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
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
