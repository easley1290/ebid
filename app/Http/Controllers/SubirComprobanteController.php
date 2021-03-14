<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personas;
use App\Models\Estudiantes;
use App\Models\Subdominios;

class SubirComprobanteController extends Controller
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
                ->get();
        $estado = Subdominios::select('subdominios.*')
                ->where('subd_dom_id','=',3)
                ->get();
                

        return  view('ebid-views-administrador.inscripcion.subir_comprobante',
                compact('estudiantes','estado'));
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
        $est_nuevo = new Estudiantes;
        //$est_nuevo->est_id = '1';
        $est_nuevo->est_per_id = auth()->user()->per_id;
        
        if ($request->hasFile('comprobante')) 
        {
            $ldate = date('YmdHis_');

            $file = $request->file('comprobante');
            $name=$file->getClientOriginalName();
            $originalname = $ldate.$file->getClientOriginalName();
            $place = $file->storeAs('public/Comprobante', $originalname);
            $path = '/storage/Comprobante/'.$originalname;

            $est_nuevo->est_comprobante = $path;
        }

        $est_nuevo->est_subd_verificacion = '2';
        $est_nuevo->est_subd_estado = '7';
        $est_nuevo->save();

        return redirect()->route('Comprobante.index');
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

        $est_edit = Estudiantes::find($id);
        
        //$est_edit->est_per_id = auth()->user()->per_id;

        if ($request->hasFile('comprobante')) 
        {
            $ldate = date('YmdHis_');

            $file = $request->file('comprobante');
            $name=$file->getClientOriginalName();
            $originalname = $ldate.$file->getClientOriginalName();
            $place = $file->storeAs('public/Comprobante', $originalname);
            $path = '/storage/Comprobante/'.$originalname;

            $est_edit->est_comprobante = $path;
        }
        
        //$est_edit->est_subd_verificacion = '2';
        //$est_edit->est_subd_estado = '7';
        $est_edit->save();

        return redirect()->route('Comprobante.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Estudiantes::destroy($id);
        return redirect()->route('Comprobante.index');
    }
}
