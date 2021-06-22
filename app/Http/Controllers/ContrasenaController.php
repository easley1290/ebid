<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Personas;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\QueryException;

class ContrasenaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $personas = Personas::select('*')
                ->where('per_id','=',auth()->user()->id)
                ->get();
            return  view('ebid-views-administrador.perfil_personal.perfil_contrasena',
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
                'contrasena_nueva' => 'required',
                'contrasena_nueva1' => 'required'
            ]);
            
    
            $contrasena = Personas::select('*')
                        ->where('per_id','=',$id)
                        ->first();
            $texto_hashed= $contrasena->password;
            $texto_normal= $request->input('per_contrasena_antigua');
        
            if(isset($request->per_contrasena_antigua))
            {
                if(Hash::check($texto_normal,$texto_hashed))
                {
                    if($request->input('contrasena_nueva') == $request->input('contrasena_nueva1'))
                    {
                        $persona_edit = Personas::find($id);
                        $persona_edit->password = Hash::make($request->input('contrasena_nueva'));
                        $persona_edit->save();
                        return redirect()->route('Contrasena.index')->with('success', 'Contraseña Guardada');
                    }
                    else
                    {
                        return redirect()->route('Contrasena.index')->with('danger', 'Las contraseñas no coinciden');
                    }
                }
                else
                {
                    return redirect()->route('Contrasena.index')->with('danger', 'La contraseña antigua no corresponde');
                }
    
            }
            else
            {
                if($request->input('contrasena_nueva') == $request->input('contrasena_nueva1'))
                {
                    $persona_edit = Personas::find($id);
                    $persona_edit->password = Hash::make($request->input('contrasena_nueva'));
                    $persona_edit->save();
                    return redirect()->route('PersonaInstitucional.index')->with('success', 'Contraseña Guardada');
                }
                else
                {
                    return redirect()->route('PersonaInstitucional.index')->with('danger', 'Las contraseñas no coinciden');;
                }
            }
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
