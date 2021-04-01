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
                $notas = Notas::all();
                $materias_est = MateriaEstudiante::all();
                $materias = Materias::all();
                $estudiantes = Estudiantes::all();
                $personas = Personas::all();
                $aux = [$notas, $materias_est, $materias, $estudiantes, $personas, $materia_docente];
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
