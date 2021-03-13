<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Personas;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class ContraseñaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personas = Personas::select('*')
                ->where('per_id','=',auth()->user()->id)
                ->get();
        
        return  view('ebid-views-administrador.perfil_personal.perfil_contraseña',
                //compact('personas','generos','tipo_docs','extensions'));
                compact('personas'));
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
        
        $this->validate($request,[
            'contraseña_nueva' => 'required',
            'contraseña_nueva1' => 'required'
        ]);
        

        $contraseña = Personas::select('*')
                    ->where('per_id','=',$id)
                    ->first();
            
        
        if(isset($request->per_contraseña_antigua))
        {
            if($request->input('per_contraseña_antigua') == $contraseña->per_contrasenia)
            {
                if($request->input('contraseña_nueva') == $request->input('contraseña_nueva1'))
                {
                    $persona_edit = Personas::find($id);
                    $persona_edit->per_contrasenia = $request->input('contraseña_nueva');
                    $persona_edit->save();
                    return redirect()->route('Contrasenia.index')->with('success', 'Contraseña Guardada');
                }
                else
                {
                    return redirect()->route('Contrasenia.index')->with('danger', 'Contraseña no coincide');
                }
            }
            else
            {
                return redirect()->route('Contrasenia.index')->with('danger', 'Contraseña incorrecta');
            }

        }
        if(!isset($request->per_contraseña_antigua))
        {
            if($request->input('contraseña_nueva') == $request->input('contraseña_nueva1'))
            {
                $persona_edit = Personas::find($id);
                $persona_edit->per_contrasenia = $request->input('contraseña_nueva');
                $persona_edit->save();
                return redirect()->route('PersonaInstitucional.index')->with('success', 'Contraseña Guardada');
            }
            else
            {
                return redirect()->route('PersonaInstitucional.index')->with('danger', 'Contraseña no coincide');;
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
