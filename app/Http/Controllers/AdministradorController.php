<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personas;
use App\Models\Administrativos;
use App\Models\Subdominios;
use App\Models\Roles;
use Illuminate\Support\Facades\DB;

class AdministradorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $administrativos = Administrativos::all();
            $personas = Personas::all();
            $estados = Subdominios::select('subdominios.*')
            ->where('subd_dom_id','=',1)
            ->get();
            $roles = Roles::select('roles.*')
            ->where('rol_id','<',3)
            ->get(); 
            $personas_habilitadas = Personas::select('*')
            ->where('per_rol','=',7)
            ->get();
            $aux = [$administrativos, $personas, $estados, $roles, $personas_habilitadas];
            return view('ebid-views-administrador.administrador.administrador')->with('aux', $aux);
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
                'adm_id' => 'required',
                'adm_per_id' => 'required',
                'adm_cargo' => 'required',
                'adm_area_pertenece' => 'required',
                'adm_subd_estado' => 'required',
                'adm_rol' => 'required',
            ]);
            $administrativo_nuevo = new Administrativos;            
            $administrativo_nuevo->adm_id = $request->input('adm_id');
            $administrativo_nuevo->adm_per_id = $request->input('adm_per_id');
            $administrativo_nuevo->adm_cargo = $request->input('adm_cargo');
            $administrativo_nuevo->adm_area_pertenece = $request->input('adm_area_pertenece');
            $administrativo_nuevo->adm_subd_estado = $request->input('adm_subd_estado');
            $administrativo_nuevo->adm_descripcion = $request->input('adm_descripcion');
            $administrativo_nuevo->save();

            $personas = Personas::find($request->input('adm_per_id'));
            /*->where('per_id','=',$request->input('adm_per_id'))
            ->get();*/
            $personas->per_rol = $request->input('adm_rol');
            $personas->save();
            
            return redirect()->route('Administrador.index')->with('status', 'Se AGREGÓ un nuevo Administrativo con exito');
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
                'adm_id' => 'required',
                'adm_cargo' => 'required',
                'adm_area_pertenece' => 'required',
                'adm_subd_estado' => 'required',
                'adm_descripcion' => 'required',
                'adm_rol' => 'required',
            ]);
            $administrativo_nuevo = Administrativos::find($id);            
            $administrativo_nuevo->adm_id = $request->input('adm_id');
            $administrativo_nuevo->adm_cargo = $request->input('adm_cargo');
            $administrativo_nuevo->adm_area_pertenece = $request->input('adm_area_pertenece');
            $administrativo_nuevo->adm_subd_estado = $request->input('adm_subd_estado');
            $administrativo_nuevo->adm_descripcion = $request->input('adm_descripcion');
            $administrativo_nuevo->save();

            $administrativo_edit = Administrativos::find($id); 
            $persona = $administrativo_edit->adm_per_id;
            $personas = Personas::find($persona);
            /*->where('per_id','=',$request->input('adm_per_id'))
            ->get();*/
            $personas->per_rol = $request->input('adm_rol');
            $personas->save();
            
            return redirect()->route('Administrador.index')->with('status', 'Se MODIFICÓ un nuevo Administrativo con exito');
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

            $administrativo_delete = Administrativos::find($id); 
            $persona = $administrativo_delete->adm_per_id;
            $administrativo_delete->delete();

            $personas = Personas::find($persona);
            /*->where('per_id','=',$request->input('adm_per_id'))
            ->get();*/
            $personas->per_rol = '7';
            $personas->save();
            
            return redirect()->route('Administrador.index')->with('status', 'Se ELIMINÓ un nuevo Administrativo con exito');
        } 
        catch (Throwable $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
    }
}
