<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dominios;


class DominioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $dominios = Dominios::all();
            return view('ebid-views-administrador.dominio.dominio')->with('dominios', $dominios);
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
                'dom_nombre' => 'required',
                'dom_descripcion' => 'required',
            ]);
            $dominio_nuevo = new Dominios;

            $dominio_nuevo->dom_nombre = $request->input('dom_nombre');
            $dominio_nuevo->dom_descripcion = $request->input('dom_descripcion');
            $dominio_nuevo->save();
            return redirect()->route('Dominio.index')->with('status', 'Se CREÓ el Dominio con exito');
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
                'dom_nombre' => 'required',
                'dom_descripcion' => 'required',
            ]);
            $dominio_edit = Dominios::find($id);

            $dominio_edit->dom_nombre = $request->input('dom_nombre');
            $dominio_edit->dom_descripcion = $request->input('dom_descripcion');
            $dominio_edit->save();
            return redirect()->route('Dominio.index')->with('status', 'Se MODIFICÓ el Dominio con exito');
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
            $dominio_delete = Dominios::find($id);
            $dominio_delete->delete();
            return redirect()->route('Dominio.index')->with('status', 'Se ELIMINÓ el Dominio con exito');
        } 
        catch (Throwable $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
    }
}
