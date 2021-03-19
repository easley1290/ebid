<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notas;
use App\Models\MateriaEstudiante;
use App\Models\Materias;
use App\Models\Estudiantes;
use App\Models\Personas;

class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
                'nota_mate_id' => 'required',
                'nota_practica1' => 'required',
                'nota_examen1' => 'required',
                'nota_practica2' => 'required',
                'nota_examen2' => 'required',
                'nota_practica3' => 'required',
                'nota_examen3' => 'required',
            ]);
            $nota_edit = Notas::find($id);

            $nota_edit->nota_mate_id = $request->input('nota_mate_id');
            $nota_edit->nota_practica1 = $request->input('nota_practica1');
            $nota_edit->nota_examen1 = $request->input('nota_examen1');
            $nota_edit->nota_practica2 = $request->input('nota_practica2');
            $nota_edit->nota_examen2 = $request->input('nota_examen2');
            $nota_edit->nota_practica3 = $request->input('nota_practica3');
            $nota_edit->nota_examen3 = $request->input('nota_examen3');
            $nota_p1 = $request->input('nota_practica1');
            $nota_e1 = $request->input('nota_examen1');
            $nota_p2 = $request->input('nota_practica2');
            $nota_e2 = $request->input('nota_examen2');
            $nota_p3 = $request->input('nota_practica3');
            $nota_e3 = $request->input('nota_examen3');
            $nota_f = $nota_p1+$nota_p2+$nota_p3+$nota_e1+$nota_e2+$nota_e3;
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
