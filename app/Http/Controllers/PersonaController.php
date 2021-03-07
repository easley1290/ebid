<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Personas;
use App\Models\Subdominios;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personas = Personas::all();
        $genero = Subdominios::select('subdominios.*')
        ->where('subd_dom_id','=',2)
        ->get();
        $tipo_doc = Subdominios::select('subdominios.*')
        ->where('subd_dom_id','=',10)
        ->get();
        $extension = Subdominios::select('subdominios.*')
        ->where('subd_dom_id','=',11)
        ->get();
        return  view('ebid-views-administrador.perfil_personal.perfil_personal',
                compact('personas','genero','tipo_doc','extension'));
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
            'nombres' => 'required',
            'paterno' => 'required',
            'materno' => 'required',
            'tipo_doc' => 'required',
            'num_doc' => 'required',
            'extension' => 'required',
            'extension' => 'required',
            'fec_nac' => 'required',
            'correo' => 'required'
        ]);
        
        $persona_nuevo = new Personas;

        $persona_nuevo->per_ua_id =             'UA-EA0001';
        $persona_nuevo->per_nombres =           $request->nombres;
        $persona_nuevo->per_paterno =           $request->paterno;
        $persona_nuevo->per_materno =           $request->materno;
        $persona_nuevo->per_num_documentacion = $request->num_doc;
        $persona_nuevo->per_fecha_nacimiento =  $request->fec_nac;
        $persona_nuevo->per_telefono =          $request->telefono;
        $persona_nuevo->per_correo_personal =   $request->correo;
        $persona_nuevo->per_domicilio =         $request->domicilio;
        $persona_nuevo->per_subd_documentacion =$request->tipo_doc;
        $persona_nuevo->per_subd_extension =    $request->extension;
        $persona_nuevo->per_subd_genero =       $request->genero;
        $persona_nuevo->per_subd_estado =       '1';
        $persona_nuevo->save();

        return redirect()->route('Personas.index');
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
            'nombres' => 'required',
            'paterno' => 'required',
            'materno' => 'required',
            'tipo_doc' => 'required',
            'num_doc' => 'required',
            'extension' => 'required',
            'extension' => 'required',
            'fec_nac' => 'required',
            'correo' => 'required'
        ]);

        $persona_edit = Personas::find($id);

        $persona_edit->per_nombres =           $request->nombres;
        $persona_edit->per_paterno =           $request->paterno;
        $persona_edit->per_materno =           $request->materno;
        $persona_edit->per_num_documentacion = $request->num_doc;
        $persona_edit->per_fecha_nacimiento =  $request->fec_nac;
        $persona_edit->per_telefono =          $request->telefono;
        $persona_edit->per_correo_personal =   $request->correo;
        $persona_edit->per_domicilio =         $request->domicilio;
        $persona_edit->per_subd_documentacion =$request->tipo_doc;
        $persona_edit->per_subd_extension =    $request->extension;
        $persona_edit->per_subd_genero =       $request->genero;
        $persona_edit->per_subd_estado =       '1';

        $persona_edit->save();
        return redirect()->route('Personas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $persona_delete = Personas::find($id);

        $persona_delete->delete();
        return redirect()->route('Personas.index');
    }
}
