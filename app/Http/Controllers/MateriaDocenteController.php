<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MateriaDocente;
use App\Models\Docentes;
use App\Models\Personas;
use App\Models\Materias;
use App\Models\Subdominios;

class MateriaDocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $materiadocentes = MateriaDocente::all();
            $docentes = Docentes::all();
            $personas = Personas::all();
            $materias = Materias::all();
            $personas = Personas::all();
            $estados = Subdominios::select('subdominios.*')
            ->where('subd_dom_id','=',1)
            ->get();
            $aux = [$materiadocentes, $docentes, $personas, $materias, $estados];
            return view('ebid-views-administrador.materiaDocente.materiaDocente')->with('aux', $aux);
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
        try{
            $this->validate($request,[
                'matd_doc_id' => 'required',
                'matd_mat_id' => 'required',
                'matd_subd_estado' => 'required',
            ]);
            $materia_docente_nuevo = new MateriaDocente;

            $materia_docente_nuevo->matd_doc_id = $request->input('matd_doc_id');
            $materia_docente_nuevo->matd_mat_id = $request->input('matd_mat_id');
            $materia_docente_nuevo->matd_subd_estado = $request->input('matd_subd_estado');
            $materia_docente_nuevo->save();
            return redirect()->route('MateriaDocente.index')->with('status', 'Se ASIGNÓ un nuevo Docente con exito');
        } 
        catch (Throwable $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
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
                'matd_doc_id' => 'required',
                'matd_mat_id' => 'required',
                'matd_subd_estado' => 'required',
            ]);
            $materia_docente_edit = MateriaDocente::find($id);

            $materia_docente_edit->matd_doc_id = $request->input('matd_doc_id');
            $materia_docente_edit->matd_mat_id = $request->input('matd_mat_id');
            $materia_docente_edit->matd_subd_estado = $request->input('matd_subd_estado');
            $materia_docente_edit->save();
            return redirect()->route('MateriaDocente.index')->with('status', 'Se MODIFICÓ la asignación de un Docente con exito');
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
        try{
            $materia_docente_delete = MateriaDocente::find($id);
            $materia_docente_delete->delete();
            return redirect()->route('MateriaDocente.index')->with('status', 'Se ELIMINÓ una asignación Docente con exito');
        } 
        catch (Throwable $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
    }
}
