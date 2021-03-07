<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dominio;


class DominioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dominios = Dominio::all();
        return view("ebid-views-administrador.dominio.dominio")->with('dominios', $dominios);
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
        $this->validate($request,[
            'dom_nombre' => 'required'
        ]);
        $dominio_nuevo = new Dominio;

        $dominio_nuevo->dom_nombre = $request->input('dom_nombre');
        $dominio_nuevo->dom_descrip = $request->input('dom_descrip');
        $dominio_nuevo->save();
        return redirect('/Dominio')->with('success', 'Dato guardado');

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
        $this->validate($request,[
            'dom_nombre' => 'required',
            'dom_descrip' => 'required',
        ]);
        $dominio_edit = Dominio::find($id);

        $dominio_edit->dom_nombre = $request->input('dom_nombre');
        $dominio_edit->dom_descrip = $request->input('dom_descrip');
        $dominio_edit->save();
        return redirect('/Dominio')->with('success', 'Dato actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dominio_delete = Dominio::find($id);

        $dominio_delete->delete();
        return redirect('/Dominio')->with('success', 'Dato eliminado');
    }
}
