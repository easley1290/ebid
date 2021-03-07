<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subdominio;
use App\Models\Dominio;


class SubdominioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subdominios = Subdominio::all();
        $dominios = Dominio::all();
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
            'subd_descrip' => 'required',
            'dom_id' => 'required',
        ]);
        $subdominio_nuevo = new Subdominio;

        $subdominio_nuevo->subd_nombre = $request->input('subd_nombre');
        $subdominio_nuevo->subd_descrip = $request->input('subd_descrip');
        $subdominio_nuevo->dom_id = $request->input('dom_id');
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
        $subdominio_edit = Subdominio::find($id);

        $subdominio_edit->subd_nombre = $request->input('subd_nombre');
        $subdominio_edit->subd_descrip = $request->input('subd_descrip');
        $subdominio_edit->dom_id = $request->input('dom_id');
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
        $dominio_delete = Subdominio::find($id);

        $dominio_delete->delete();
        return redirect('/Subdominio')->with('success', 'Dato eliminado');
    
    }

}
