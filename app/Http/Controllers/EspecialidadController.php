<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Especialidades;
use App\Models\Subdominios;

class EspecialidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $especialidades = Especialidades::all();
            $estados = Subdominios::select('subdominios.*')
            ->where('subd_dom_id','=',1)
            ->get();
            $aux = [$especialidades, $estados];
            return view('ebid-views-administrador.especialidad.especialidad')->with('aux', $aux);
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
                'esp_nombre' => 'required',
                'esp_descripcion' => 'required',
                'esp_subd_estado' => 'required',
            ]);
            $especialidad_nuevo = new Especialidades;
            $especialidad_nuevo->esp_nombre = $request->input('esp_nombre');
            $especialidad_nuevo->esp_descripcion = $request->input('esp_descripcion');
            $especialidad_nuevo->esp_subd_estado = $request->input('esp_subd_estado');
            $especialidad_nuevo->save();
            return redirect()->route('Especialidad.index')->with('status', 'Se CREÓ la Especialidad con exito');
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
                'esp_nombre' => 'required',
                'esp_descripcion' => 'required',
                'esp_subd_estado' => 'required',
            ]);
            $especialidad_edit = Especialidades::find($id);
            $especialidad_edit->esp_nombre = $request->input('esp_nombre');
            $especialidad_edit->esp_descripcion = $request->input('esp_descripcion');
            $especialidad_edit->esp_subd_estado = $request->input('esp_subd_estado');
            $especialidad_edit->save();
            return redirect()->route('Especialidad.index')->with('status', 'Se MODIFICÓ la Especialidad con exito');
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
            $especialidad_delete = Especialidades::find($id);
            $especialidad_delete->delete();
            return redirect()->route('Especialidad.index')->with('status', 'Se ELIMINÓ la Especialidad con exito');
        } 
        catch (Throwable $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
    }
}
