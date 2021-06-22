<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Models\User;
use App\Models\Personas;
use App\Models\Subdominios;

class PersonaInsController extends Controller
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
            return  view('ebid-views-administrador.perfil_personal.perfil_personal_ins',
                    //compact('personas','generos','tipo_docs','extensions'));
                    compact('personas'));
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
        /*$this->validate($request,[
            'per_codigo_institucional' => 'required',
            'per_correo_institucional' => 'required',
        ]);
        
        $persona_nuevo = new Personas;

        $persona_nuevo->per_ua_id =             'UA-EA0001';
        $persona_nuevo->per_nombres =           $request->nombres;
        $persona_nuevo->per_paterno =           $request->paterno;
        $persona_nuevo->per_materno =           $request->materno;
        $persona_nuevo->per_num_documentacion = $request->num_doc;
        $persona_nuevo->save();

        return redirect()->route('PersonaInstitucional.index');*/
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
                'per_codigo_institucional' => 'required',
                'per_correo_institucional' => 'required'
            ]);
            
            $persona_edit = Personas::find($id);
    
            $persona_edit->per_codigo_institucional = $request->input('per_codigo_institucional');
            $persona_edit->per_correo_institucional = $request->input('per_correo_institucional');
            //$persona_edit->per_foto_personal        = $request->hasFile('per_foto_personal');
    
    
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
            return redirect()->route('PersonaInstitucional.index');
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
        try{
            $persona_delete = Personas::find($id);
            $persona_delete->delete();
            return redirect()->route('PersonaInstitucional.index');
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
}
