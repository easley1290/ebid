<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Models\CategoriaDocente;
use App\Models\Subdominios;

class CategoriaDocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $categorias = CategoriaDocente::all();
            $estados = Subdominios::select('subdominios.*')
            ->where('subd_dom_id','=',1)
            ->get();
            $aux = [$categorias, $estados];
            return view('ebid-views-administrador.categoriaDocente.categoriaDocente')->with('aux', $aux);
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
                'cat_id' => 'required',
                'cat_nombre' => 'required',
                'cat_descripcion' => 'required',
                'cat_subd_estado' => 'required',
            ]);
            $cat_nuevo = new CategoriaDocente;

            $cat_nuevo->cat_id = $request->input('cat_id');
            $cat_nuevo->cat_nombre = $request->input('cat_nombre');
            $cat_nuevo->cat_descripcion = $request->input('cat_descripcion');
            $cat_nuevo->cat_subd_estado = $request->input('cat_subd_estado');
            $cat_nuevo->save();
            return redirect()->route('CategoriaDocente.index')->with('status', 'Se CREÓ el Rol con exito');
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
                'cat_id' => 'required',
                'cat_nombre' => 'required',
                'cat_descripcion' => 'required',
                'cat_subd_estado' => 'required',
            ]);
            $cat_edit = CategoriaDocente::find($id);

            $cat_edit->cat_id = $request->input('cat_id');
            $cat_edit->cat_nombre = $request->input('cat_nombre');
            $cat_edit->cat_descripcion = $request->input('cat_descripcion');
            $cat_edit->cat_subd_estado = $request->input('cat_subd_estado');
            $cat_edit->save();
            return redirect()->route('CategoriaDocente.index')->with('status', 'Se MODIFICÓ el Rol con exito');
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
            $cat_delete = CategoriaDocente::find($id);
            $cat_delete->delete();
            return redirect()->route('CategoriaDocente.index')->with('status', 'Se ELIMINÓ el Rol con exito');
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
