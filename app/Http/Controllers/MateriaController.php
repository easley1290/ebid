<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Models\Materias;
use App\Models\Subdominios;


class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $materias = Materias::all();
            $estados = Subdominios::select('subdominios.*')
            ->where('subd_dom_id','=',1)
            ->get();
            $aux = [$materias, $estados];
            return view('ebid-views-administrador.materia.materia')->with('aux', $aux);
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
                'mat_id' => 'required',
                'mat_nombre' => 'required',
                'mat_descripcion' => 'required',
                'mat_subd_estado' => 'required',
            ]);
            $materia_nuevo = new Materias;

            $materia_nuevo->mat_id = $request->input('mat_id');
            $materia_nuevo->mat_nombre = $request->input('mat_nombre');
            $materia_nuevo->mat_descripcion = $request->input('mat_descripcion');
            $materia_nuevo->mat_subd_estado = $request->input('mat_subd_estado');
            $materia_nuevo->save();
            return redirect()->route('Materia.index')->with('status', 'Se CREÓ la Materia con exito');
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
                'mat_id' => 'required',
                'mat_nombre' => 'required',
                'mat_descripcion' => 'required',
                'mat_subd_estado' => 'required',
            ]);
            $materia_edit = Materias::find($id);
            
            $materia_edit->mat_id = $request->input('mat_id');
            $materia_edit->mat_nombre = $request->input('mat_nombre');
            $materia_edit->mat_descripcion = $request->input('mat_descripcion');
            $materia_edit->mat_subd_estado = $request->input('mat_subd_estado');
            $materia_edit->save();
            return redirect()->route('Materia.index')->with('status', 'Se MODIFICÓ la Materia con exito');
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $materia_delete = Materias::find($id);
            $materia_delete->delete();
            return redirect()->route('Materia.index')->with('status', 'Se ELIMINÓ la Materia con exito');
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
}
