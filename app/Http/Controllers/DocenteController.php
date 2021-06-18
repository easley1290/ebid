<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Models\Docentes;
use App\Models\Personas;
use App\Models\CategoriaDocente;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $docentes = Docentes::all();
            $personas = Personas::all();
            $categorias = CategoriaDocente::all();
            $personas_habilitadas = Personas::select('*')
                                ->where('per_rol','=',7)
                                ->orWhere('per_rol','=',6)
                                ->get();
            $aux = [$docentes, $personas, $categorias, $personas_habilitadas];
            return view('ebid-views-administrador.docente.docente')->with('aux', $aux);
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
                'doc_id' => 'required',
                'doc_per_id' => 'required',
                'doc_cat_id' => 'required',
                'doc_titulo' => 'required',
            ]);
            $docente_nuevo = new Docentes;

            $docente_nuevo->doc_id = $request->input('doc_id');
            $docente_nuevo->doc_per_id = $request->input('doc_per_id');
            $docente_nuevo->doc_cat_id = $request->input('doc_cat_id');
            $docente_nuevo->doc_titulo = $request->input('doc_titulo');
            $docente_nuevo->doc_descripcion = $request->input('doc_descripcion');
            $docente_nuevo->save();

            $personas = Personas::find($request->input('doc_per_id'));
            /*->where('per_id','=',$request->input('adm_per_id'))
            ->get();*/
            $personas->per_rol = 6;
            $personas->save();

            return redirect()->route('Docente.index')->with('status', 'Se AGREGÓ un nuevo Docente con exito');
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
                'doc_id' => 'required',
                'doc_cat_id' => 'required',
                'doc_titulo' => 'required',

            ]);
            $docente_edit = Docentes::find($id);

            $docente_edit->doc_id = $request->input('doc_id');
            $docente_edit->doc_cat_id = $request->input('doc_cat_id');
            $docente_edit->doc_titulo = $request->input('doc_titulo');
            $docente_edit->doc_descripcion = $request->input('doc_descripcion');
            $docente_edit->save();
            return redirect()->route('Docente.index')->with('status', 'Se MODIFICÓ el Docente con exito');
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
            $docente_delete = Docentes::find($id);
            $persona = $docente_delete->doc_per_id;
            $docente_delete->delete();

            $docente_existe = Docentes::select('*')->where('doc_per_id', $persona)->exists();
            if($docente_existe==True){
                //dato existente
            }
            else {
                $personas = Personas::find($persona);
                /*->where('per_id','=',$request->input('adm_per_id'))
                ->get();*/
                $personas->per_rol = 7;
                $personas->save();
            }

            return redirect()->route('Docente.index')->with('status', 'Se ELIMINÓ el Docente con exito');
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
