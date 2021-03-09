<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnidadAcademica;
use App\Models\Institucion;
use App\Models\Subdominios;

class UnidadAcademicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unidadAcademicas = UnidadAcademica::all();
        $institucions = Institucion::all();
        $estados = Subdominios::select('subdominios.*')
        ->where('subd_dom_id','=',1)
        ->get();
        $aux = [$unidadAcademicas, $institucions, $estados];
        return view('ebid-views-administrador.unidadAcademica.unidadAcademica')->with('aux', $aux);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'ua_id' => 'required',
            'ua_ins_id' => 'required',
            'ua_nombre' => 'required',
            'ua_direccion' => 'required',
            'ua_telefono' => 'required',
            'ua_celular' => 'required',
            'ua_correo_electronico' => 'required',
            'ua_subd_estado' => 'required',
        ]);
        $ua_nuevo = new UnidadAcademica;

        $ua_nuevo->ua_id = $request->input('ua_id');
        $ua_nuevo->ua_ins_id = $request->input('ua_ins_id');
        $ua_nuevo->ua_nombre = $request->input('ua_nombre');
        $ua_nuevo->ua_direccion = $request->input('ua_direccion');
        $ua_nuevo->ua_telefono = $request->input('ua_telefono');
        $ua_nuevo->ua_celular = $request->input('ua_celular');
        $ua_nuevo->ua_correo_electronico = $request->input('ua_correo_electronico');
        $ua_nuevo->ua_subd_estado = $request->input('ua_subd_estado');
        $ua_nuevo->save();
        return redirect('/UnidadAcademica')->with('success', 'Dato guardado');
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
            'ua_id' => 'required',
            'ua_ins_id' => 'required',
            'ua_nombre' => 'required',
            'ua_direccion' => 'required',
            'ua_telefono' => 'required',
            'ua_celular' => 'required',
            'ua_correo_electronico' => 'required',
            'ua_subd_estado' => 'required',
        ]);
        $ua_nuevo = UnidadAcademica::find($id);

        $ua_nuevo->ua_id = $request->input('ua_id');
        $ua_nuevo->ua_ins_id = $request->input('ua_ins_id');
        $ua_nuevo->ua_nombre = $request->input('ua_nombre');
        $ua_nuevo->ua_direccion = $request->input('ua_direccion');
        $ua_nuevo->ua_telefono = $request->input('ua_telefono');
        $ua_nuevo->ua_celular = $request->input('ua_celular');
        $ua_nuevo->ua_correo_electronico = $request->input('ua_correo_electronico');
        $ua_nuevo->ua_subd_estado = $request->input('ua_subd_estado');
        $ua_nuevo->save();
        return redirect('/UnidadAcademica')->with('success', 'Dato guardado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ua_delete = UnidadAcademica::find($id);

        $ua_delete->delete();
        return redirect('/UnidadAcademica')->with('success', 'Dato eliminado');
    }
}
