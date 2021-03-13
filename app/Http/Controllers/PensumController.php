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
        try{
            $pensum = Pensum::all();
            $carreras = Carreras::all();
            $semestre = Semestre::all();
            $materias = Materias::all();
            $estados = Subdominios::select('subdominios.*')
            ->where('subd_dom_id','=',1)
            ->get();
            $pensum_cd_1 = Pensum::select('pensum.*')
            ->where('pen_car_id','=',"E-CD-01")
            ->where('pen_sem_id','=',1)
            ->get();
            $pensum_cd_2 = Pensum::select('pensum.*')
            ->where('pen_car_id','=',"E-CD-01")
            ->where('pen_sem_id','=',2)
            ->get();
            $pensum_cd_3 = Pensum::select('pensum.*')
            ->where('pen_car_id','=',"E-CD-01")
            ->where('pen_sem_id','=',3)
            ->get();
            $pensum_cd_4 = Pensum::select('pensum.*')
            ->where('pen_car_id','=',"E-CD-01")
            ->where('pen_sem_id','=',4)
            ->get();
            $pensum_dc_1 = Pensum::select('pensum.*')
            ->where('pen_car_id','=',"E-DC-01")
            ->where('pen_sem_id','=',1)
            ->get();
            $pensum_dc_2 = Pensum::select('pensum.*')
            ->where('pen_car_id','=',"E-DC-01")
            ->where('pen_sem_id','=',2)
            ->get();
            $pensum_dc_3 = Pensum::select('pensum.*')
            ->where('pen_car_id','=',"E-DC-01")
            ->where('pen_sem_id','=',3)
            ->get();
            $pensum_dc_4 = Pensum::select('pensum.*')
            ->where('pen_car_id','=',"E-DC-01")
            ->where('pen_sem_id','=',4)
            ->get();
            $pensum_df_1 = Pensum::select('pensum.*')
            ->where('pen_car_id','=',"E-DF-01")
            ->where('pen_sem_id','=',1)
            ->get();
            $pensum_df_2 = Pensum::select('pensum.*')
            ->where('pen_car_id','=',"E-DF-01")
            ->where('pen_sem_id','=',2)
            ->get();
            $pensum_df_3 = Pensum::select('pensum.*')
            ->where('pen_car_id','=',"E-DF-01")
            ->where('pen_sem_id','=',3)
            ->get();
            $pensum_df_4 = Pensum::select('pensum.*')
            ->where('pen_car_id','=',"E-DF-01")
            ->where('pen_sem_id','=',4)
            ->get();
            $pensum_dmc_1 = Pensum::select('pensum.*')
            ->where('pen_car_id','=',"E-DMC-01")
            ->where('pen_sem_id','=',1)
            ->get();
            $pensum_dmc_2 = Pensum::select('pensum.*')
            ->where('pen_car_id','=',"E-DMC-01")
            ->where('pen_sem_id','=',2)
            ->get();
            $pensum_dmc_3 = Pensum::select('pensum.*')
            ->where('pen_car_id','=',"E-DMC-01")
            ->where('pen_sem_id','=',3)
            ->get();
            $pensum_dmc_4 = Pensum::select('pensum.*')
            ->where('pen_car_id','=',"E-DMC-01")
            ->where('pen_sem_id','=',4)
            ->get();
            $pensum_pd_1 = Pensum::select('pensum.*')
            ->where('pen_car_id','=',"E-PD-01")
            ->where('pen_sem_id','=',1)
            ->get();
            $pensum_pd_2 = Pensum::select('pensum.*')
            ->where('pen_car_id','=',"E-PD-01")
            ->where('pen_sem_id','=',2)
            ->get();
            $pensum_pd_3 = Pensum::select('pensum.*')
            ->where('pen_car_id','=',"E-PD-01")
            ->where('pen_sem_id','=',3)
            ->get();
            $pensum_pd_4 = Pensum::select('pensum.*')
            ->where('pen_car_id','=',"E-PD-01")
            ->where('pen_sem_id','=',4)
            ->get();
            $aux = [$pensum, $estados, $carreras, $materias, $semestre, $pensum_cd_1, $pensum_cd_2, $pensum_cd_3, $pensum_cd_4, $pensum_dc_1, $pensum_dc_2, $pensum_dc_3, $pensum_dc_4, $pensum_df_1, $pensum_df_2, $pensum_df_3, $pensum_df_4, $pensum_dmc_1, $pensum_dmc_2, $pensum_dmc_3, $pensum_dmc_4, $pensum_pd_1, $pensum_pd_2, $pensum_pd_3, $pensum_pd_4];
            return view('ebid-views-administrador.pensum.pensum')->with('aux', $aux);
        } 
        catch (Throwable $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
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
            return redirect()->route('Pensum.index')->with('status', 'Se AGREGÓ una materia al pensum con exito');
        } 
        catch (Throwable $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
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
            return redirect()->route('Pensum.index')->with('status', 'Se MODIFICÓ una materia del pensum con exito');
        } 
        catch (Throwable $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
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
            $pensum_delete = Pensum::find($id);
            $pensum_delete->delete();
            return redirect()->route('Pensum.index')->with('status', 'Se ELIMINÓ una materia del pensum con exito');
        } 
        catch (Throwable $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
    }
}
