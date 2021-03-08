<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subdominios;
use App\Models\Dominios;


class SubdominioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subdominios = Subdominios::all();
        $dominios = Dominios::all();
        $auxiliar = [$subdominios, $dominios];
        return view('ebid-views-administrador.subdominio.subdominio')->with('auxiliar', $auxiliar);
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
            'subd_nombre' => 'required',
            'subd_descripcion' => 'required',
            'subd_dom_id' => 'required',
        ]);
        $subdominio_nuevo = new Subdominios;

        $subdominio_nuevo->subd_nombre = $request->input('subd_nombre');
        $subdominio_nuevo->subd_descripcion = $request->input('subd_descripcion');
        $subdominio_nuevo->subd_dom_id = $request->input('subd_dom_id');
        $subdominio_nuevo->save();
        return redirect('/Subdominio')->with('success', 'Dato guardado');

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
        $this->validate($request,[
            'subd_nombre' => 'required',
            'subd_descrip' => 'required',
            'dom_id' => 'required',
        ]);
        $subdominio_edit = Subdominios::find($id);

        $subdominio_edit->subd_nombre = $request->input('subd_nombre');
        $subdominio_edit->subd_descripcion = $request->input('subd_descrip');
        $subdominio_edit->subd_dom_id = $request->input('dom_id');
        $subdominio_edit->save();
        return redirect('/Subdominio')->with('success', 'Dato actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dominio_delete = Subdominios::find($id);

        $dominio_delete->delete();
        return redirect('/Subdominio')->with('success', 'Dato eliminado');
    
    }

}
