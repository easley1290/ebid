<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carreras;
use App\Models\UnidadAcademica;
use App\Models\Subdominios;

class CarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carreras = Carreras::all();
        $uas = UnidadAcademica::all();
        $estados = Subdominios::select('subdominios.*')
        ->where('subd_dom_id','=',1)
        ->get();
        $aux = [$carreras, $uas, $estados];
        return view('ebid-views-administrador.carrera.carrera')->with('aux', $aux);
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
            'car_id' => 'required',
            'car_ua_id' => 'required',
            'car_nombre' => 'required',
            'car_descripcion' => 'required',
            'car_fecha_creacion' => 'required',
            'car_subd_estado' => 'required',
        ]);
        $carrera_nueva = new Carreras;
        $carrera_nueva->car_id = $request->input('car_id');
        $carrera_nueva->car_ua_id = $request->input('car_ua_id');
        $carrera_nueva->car_nombre = $request->input('car_nombre');
        $carrera_nueva->car_descripcion = $request->input('car_descripcion');
        $carrera_nueva->car_fecha_creacion = $request->input('car_fecha_creacion');
        $carrera_nueva->car_subd_estado = $request->input('car_subd_estado');
        $carrera_nueva->save();
        return redirect('/Carrera')->with('success', 'Dato guardado');

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
            'car_id' => 'required',
            'car_ua_id' => 'required',
            'car_nombre' => 'required',
            'car_descripcion' => 'required',
            'car_fecha_creacion' => 'required',
            'car_subd_estado' => 'required',
        ]);
        $carrera_edit = Carreras::find($id);
        $carrera_edit->car_id = $request->input('car_id');
        $carrera_edit->car_ua_id = $request->input('car_ua_id');
        $carrera_edit->car_nombre = $request->input('car_nombre');
        $carrera_edit->car_descripcion = $request->input('car_descripcion');
        $carrera_edit->car_fecha_creacion = $request->input('car_fecha_creacion');
        $carrera_edit->car_subd_estado = $request->input('car_subd_estado');
        $carrera_edit->save();
        return redirect('/Carrera')->with('success', 'Dato guardado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carrera_delete = Carreras::find($id);
        $carrera_delete->delete();
        return redirect('/Carrera')->with('success', 'Dato eliminado');
    }
}
