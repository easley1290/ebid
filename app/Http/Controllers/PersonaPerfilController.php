<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Models\User;
use App\Models\Personas;
use App\Models\Subdominios;

class PersonaPerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $personas = Personas::find($id);
            $generos = Subdominios::select('subdominios.*')
            ->where('subd_dom_id','=',2)
            ->get();
            $tipo_docs = Subdominios::select('subdominios.*')
            ->where('subd_dom_id','=',13)
            ->get();
            $extensions = Subdominios::select('subdominios.*')
            ->where('subd_dom_id','=',9)
            ->get();
            return  view('ebid-views-administrador.perfil_personal.perfil_datos',
                    compact('personas','generos','tipo_docs','extensions'));
        } 
        catch(QueryException $err){
            if($err){
                $e = json_decode(json_encode($err), true);
                $numeroError = $e['errorInfo'][1];
                $nombreError = $e['errorInfo'][2];
                return redirect()->route('administracion.index')->with('status', 'Hubo un error inusual ('.$numeroError.' - '.$nombreError.')');
            }
            else{
                return redirect()->route('administracion.index')->with('status', 'Hubo un error inusual');
            }
        }
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
                'per_domicilio' => 'required',
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

            if ($request->hasFile('per_foto_personal')) 
            {
                $ldate = date('YmdHis_');

                $file = $request->file('per_foto_personal');
                $name=$file->getClientOriginalName();
                $originalname = $ldate.$file->getClientOriginalName();
                $place = $file->storeAs('public/Foto', $originalname);
                $path = '/storage/Foto/'.$originalname;
                $persona_edit->per_foto_personal      = $path;
            }
        
            $persona_edit->save();
            return redirect()->route('PersonaPerfil.show',auth()->user()->per_id);
        }
        catch(QueryException $err){
            if($err){
                $e = json_decode(json_encode($err), true);
                $numeroError = $e['errorInfo'][1];
                $nombreError = $e['errorInfo'][2];
                return redirect()->route('administracion.index')->with('status', 'Hubo un error inusual ('.$numeroError.' - '.$nombreError.')');
            }
            else{
                return redirect()->route('administracion.index')->with('status', 'Hubo un error inusual');
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
        //
    }
}
