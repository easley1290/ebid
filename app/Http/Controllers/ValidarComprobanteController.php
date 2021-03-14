<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personas;
use App\Models\Estudiantes;
use App\Models\Subdominios;


class ValidarComprobanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estudiantes = Estudiantes::select('estudiantes.*','personas.*')
                ->join('personas', 'personas.per_id', '=', 'estudiantes.est_per_id')
                ->where('est_subd_estado','=',7)
                ->get();
        $estados = Subdominios::select('subdominios.*')
                ->where('subd_dom_id','=',3)
                ->get();

        return  view('ebid-views-administrador.inscripcion.validar_comprobante',
                compact('estudiantes','estados'));
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
            'est_subd_estado' => 'required',
        ]);

        $est_edit = Estudiantes::find($id);
        
        //$est_edit->est_per_id = auth()->user()->per_id;
        //$est_edit->est_subd_verificacion = '2';

        $est_edit->est_subd_estado = $request->input('est_subd_estado');
        $est_edit->save();

        return redirect()->route('ValidarComprobante.index');
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
