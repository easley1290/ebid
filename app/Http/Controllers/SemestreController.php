<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Models\Semestre;
use App\Models\Subdominios;


class SemestreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $semestres = Semestre::all();
            $estados = Subdominios::select('subdominios.*')
            ->where('subd_dom_id','=',1)
            ->get();
            $aux = [$semestres, $estados];
            return view('ebid-views-administrador.semestre.semestre')->with('aux', $aux);
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
                'sem_nombre' => 'required',
                'sem_descripcion' => 'required',
                'sem_subd_estado' => 'required',
            ]);
            $semestre_nuevo = new Semestre;
            $semestre_nuevo->sem_nombre = $request->input('sem_nombre');
            $semestre_nuevo->sem_descripcion = $request->input('sem_descripcion');
            $semestre_nuevo->sem_subd_estado = $request->input('sem_subd_estado');
            $semestre_nuevo->save();
            return redirect()->route('Semestre.index')->with('status', 'Se CREÓ el semestre con exito');
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
                'sem_nombre' => 'required',
                'sem_descripcion' => 'required',
                'sem_subd_estado' => 'required',
            ]);
            $semestre_edit = Semestre::find($id);
            $semestre_edit->sem_nombre = $request->input('sem_nombre');
            $semestre_edit->sem_descripcion = $request->input('sem_descripcion');
            $semestre_edit->sem_subd_estado = $request->input('sem_subd_estado');
            $semestre_edit->save();
            return redirect()->route('Semestre.index')->with('status', 'Se MODIFICÓ el semestre con exito');
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
            $semestre_delete = Semestre::find($id);
            $semestre_delete->delete();
            return redirect()->route('Semestre.index')->with('status', 'Se ELIMINÓ el semestre con exito');
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
