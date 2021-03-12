<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pensum;
use App\Models\Carreras;
use App\Models\Semestre;
use App\Models\Materias;
use App\Models\Subdominios;


class PensumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pensum = Pensum::all();
        $carreras = Carreras::all();
        $semestre = Semestre::all();
        $materias = Materias::all();
        $estados = Subdominios::select('subdominios.*')
        ->where('subd_dom_id','=',1)
        ->get();
        $aux = [$pensum, $estados, $carreras, $materias, $semestre];
        return view('ebid-views-administrador.pensum.pensum')->with('aux', $aux);
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
            'pen_car_id' => 'required',
            'pen_mat_id' => 'required',
            'pen_sem_id' => 'required',
            'pen_subd_estado' => 'required',
        ]);
        $pensum_nueva = new Pensum;
        $pensum_nueva->pen_car_id = $request->input('pen_car_id');
        $pensum_nueva->pen_mat_id = $request->input('pen_mat_id');
        $pensum_nueva->pen_sem_id = $request->input('pen_sem_id');
        $pensum_nueva->pen_subd_estado = $request->input('pen_subd_estado');
        $pensum_nueva->save();
        return redirect('/Pensum')->with('success', 'Dato guardado');
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
            'pen_car_id' => 'required',
            'pen_mat_id' => 'required',
            'pen_sem_id' => 'required',
            'pen_subd_estado' => 'required',
        ]);
        $pensum_edit = Pensum::find($id);
        $pensum_edit->pen_car_id = $request->input('pen_car_id');
        $pensum_edit->pen_mat_id = $request->input('pen_mat_id');
        $pensum_edit->pen_sem_id = $request->input('pen_sem_id');
        $pensum_edit->pen_subd_estado = $request->input('pen_subd_estado');
        $pensum_edit->save();
        
        return redirect('/Pensum')->with('success', 'Dato guardado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pensum_delete = Pensum::find($id);
        $pensum_delete->delete();
        return redirect('/Pensum')->with('success', 'Dato guardado');
    }
}
