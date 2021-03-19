<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Docentes;
use App\Models\Personas;
use App\Models\CategoriaDocente;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $docentes = Docentes::all();
            $personas = Personas::all();
            $categorias = CategoriaDocente::all();
            $aux = [$docentes, $personas, $categorias];
            return view('ebid-views-administrador.docente.docente')->with('aux', $aux);
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
                'doc_id' => 'required',
                'doc_per_id' => 'required',
                'doc_cat_id' => 'required',
                'doc_salario' => 'required',
                'doc_cargo' => 'required',
                'doc_descripcion' => 'required',
            ]);
            $docente_nuevo = new Docentes;

            $docente_nuevo->doc_id = $request->input('doc_id');
            $docente_nuevo->doc_per_id = $request->input('doc_per_id');
            $docente_nuevo->doc_cat_id = $request->input('doc_cat_id');
            $docente_nuevo->doc_salario = $request->input('doc_salario');
            $docente_nuevo->doc_cargo = $request->input('doc_cargo');
            $docente_nuevo->doc_descripcion = $request->input('doc_descripcion');
            $docente_nuevo->save();
            return redirect()->route('Docente.index')->with('status', 'Se AGREGÓ un nuevo Docente con exito');
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
                'doc_id' => 'required',
                'doc_per_id' => 'required',
                'doc_cat_id' => 'required',
                'doc_salario' => 'required',
                'doc_cargo' => 'required',
                'doc_descripcion' => 'required',
            ]);
            $docente_edit = Docentes::find($id);

            $docente_edit->doc_id = $request->input('doc_id');
            $docente_edit->doc_per_id = $request->input('doc_per_id');
            $docente_edit->doc_cat_id = $request->input('doc_cat_id');
            $docente_edit->doc_salario = $request->input('doc_salario');
            $docente_edit->doc_cargo = $request->input('doc_cargo');
            $docente_edit->doc_descripcion = $request->input('doc_descripcion');
            $docente_edit->save();
            return redirect()->route('Docente.index')->with('status', 'Se MODIFICÓ el Docente con exito');
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
            $docente_delete = Docentes::find($id);
            $docente_delete->delete();
            return redirect()->route('Docente.index')->with('status', 'Se ELIMINÓ el Docente con exito');
        } 
        catch (Throwable $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
    }
}
