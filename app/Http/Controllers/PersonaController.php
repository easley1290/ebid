<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

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
        try{
            $personas = Personas::all();
            $generos = Subdominios::select('subdominios.*')
            ->where('subd_dom_id','=',2)
            ->get();
            $tipo_docs = Subdominios::select('subdominios.*')
            ->where('subd_dom_id','=',13)
            ->get();
            $extensions = Subdominios::select('subdominios.*')
            ->where('subd_dom_id','=',9)
            ->get();
            return  view('ebid-views-administrador.perfil_personal.perfil_personal',
                    compact('personas','generos','tipo_docs','extensions'));
        } 
        catch(QueryException $err){
            if($err){
                $e = json_decode(json_encode($err), true);
                $numeroError = $e['errorInfo'][1];
                $nombreError = $e['errorInfo'][2];
                return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual ('.$numeroError.' - '.$nombreError.')');
            }
            else{
                return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
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
            $persona_nuevo->name = $request->input('nombres').' '.$request->input('paterno').' '.$request->input('materno');
            $persona_nuevo->email =                 $request->correo;
            $persona_nuevo->per_domicilio =         $request->domicilio;
            $persona_nuevo->per_subd_documentacion =$request->tipo_doc;
            $persona_nuevo->per_subd_extension =    $request->extension;
            $persona_nuevo->per_subd_genero =       $request->genero;
            $persona_nuevo->per_subd_estado =       '1';
            $persona_nuevo->password =              Hash::make('12345678');


            $persona_nuevo->per_rol = '7';
            $persona_nuevo->save();

            return redirect()->route('Persona.index')->with('status', 'Se CREÓ la persona con exito');
        }
        catch(QueryException $err){
            if($err){
                $e = json_decode(json_encode($err), true);
                $numeroError = $e['errorInfo'][1];
                $nombreError = $e['errorInfo'][2];
                return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual ('.$numeroError.' - '.$nombreError.')');
            }
            else{
                return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
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
        ///
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
                'per_nombres' => 'required',
                'per_paterno' => 'required',
                'per_materno' => 'required',
                'per_subd_genero' => 'required',
                'per_fecha_nacimiento' => 'required',
                'per_subd_documentacion' => 'required',
                'per_num_documentacion' => 'required',
                'per_subd_extension' => 'required',
                'per_telefono' => 'required',
                'per_correo_personal' => 'required',
            ]);

            $persona_edit = Personas::find($id);

            $persona_edit->per_nombres = $request->input('per_nombres');
            $persona_edit->per_paterno = $request->input('per_paterno');
            $persona_edit->per_materno = $request->input('per_materno');
            $persona_edit->per_num_documentacion = $request->input('per_num_documentacion');
            $persona_edit->per_fecha_nacimiento = $request->input('per_fecha_nacimiento');
            $persona_edit->per_telefono = $request->input('per_telefono');
            $persona_edit->name = $request->input('per_nombres').' '.$request->input('per_paterno').' '.$request->input('per_materno');
            $persona_edit->email = $request->input('per_correo_personal');
            $persona_edit->per_domicilio = $request->input('per_domicilio');
            $persona_edit->per_subd_documentacion = $request->input('per_subd_documentacion');
            $persona_edit->per_subd_extension = $request->input('per_subd_extension');
            $persona_edit->per_subd_genero = $request->input('per_subd_genero');
            $persona_edit->per_subd_estado = '1';

            $persona_edit->save();
            return redirect()->route('Persona.index')->with('status', 'Se MODIFICÓ la persona con exito');
        }
        catch(QueryException $err){
            if($err){
                $e = json_decode(json_encode($err), true);
                $numeroError = $e['errorInfo'][1];
                $nombreError = $e['errorInfo'][2];
                return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual ('.$numeroError.' - '.$nombreError.')');
            }
            else{
                return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
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
            $persona_delete = Personas::find($id);

            $persona_delete->delete();
            return redirect()->route('Persona.index');
        }
        catch(QueryException $err){
            if($err){
                $e = json_decode(json_encode($err), true);
                $numeroError = $e['errorInfo'][1];
                $nombreError = $e['errorInfo'][2];
                return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual ('.$numeroError.' - '.$nombreError.')');
            }
            else{
                return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
            }
        }
    }
}
