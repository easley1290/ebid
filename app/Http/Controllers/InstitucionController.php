<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Institucion;

class InstitucionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instituciones = Institucion::all();
        return view("ebid-views-administrador.institucion.institucion")->with('instituciones', $instituciones);
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
            'ins_nombre' => 'required',
            'ins_mision' => 'required',
            'ins_vision' => 'required',
            'ins_obj' => 'required',
            'ins_obj_esp1' => 'required',
            'ins_obj_esp2' => 'required',
            'ins_obj_esp3' => 'required',
        ]);
        $institucion_nuevo = new Institucion;

        $institucion_nuevo->ins_nombre = $request->input('ins_nombre');
        $institucion_nuevo->ins_mision = $request->input('ins_mision');
        $institucion_nuevo->ins_vision = $request->input('ins_vision');
        $institucion_nuevo->ins_obj = $request->input('ins_obj');
        $institucion_nuevo->ins_obj_esp1 = $request->input('ins_obj_esp1');
        $institucion_nuevo->ins_obj_esp2 = $request->input('ins_obj_esp2');
        $institucion_nuevo->ins_obj_esp3 = $request->input('ins_obj_esp3');
        $institucion_nuevo->save();
        return redirect('/Institucion')->with('success', 'Dato guardado');

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
            'ins_nombre' => 'required',
            'ins_mision' => 'required',
            'ins_vision' => 'required',
            'ins_obj' => 'required',
            'ins_obj_esp1' => 'required',
            'ins_obj_esp2' => 'required',
            'ins_obj_esp3' => 'required',
        ]);
        $institucion_edit = Institucion::find($id);

        $institucion_edit->ins_nombre = $request->input('ins_nombre');
        $institucion_edit->ins_mision = $request->input('ins_mision');
        $institucion_edit->ins_vision = $request->input('ins_vision');
        $institucion_edit->ins_obj = $request->input('ins_obj');
        $institucion_edit->ins_obj_esp1 = $request->input('ins_obj_esp1');
        $institucion_edit->ins_obj_esp2 = $request->input('ins_obj_esp2');
        $institucion_edit->ins_obj_esp3 = $request->input('ins_obj_esp3');
        $institucion_edit->save();
        return redirect('/Institucion')->with('success', 'Dato guardado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $institucion_delete = Institucion::find($id);

        $institucion_delete->delete();
        return redirect('/Institucion')->with('success', 'Dato eliminado');
    }
}
