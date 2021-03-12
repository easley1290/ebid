<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Institucion;

class PortalAdminQSController extends Controller
{
    public function index()
    {
        try{
            $institucion = Institucion::all();
            return view('ebid-views-administrador.portal-web.quienes-somos')->with('institucion', $institucion[0]);
        } catch (Throwable $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
    }

    public function update(Request $request, $id)
    {
        try{
            $this->validate($request,[
                'nombre_institucion' => 'required|min:10',
                'frase_institucion' => 'required',
                'mision_institucion' => 'required',
                'vision_institucion' => 'required',
                'objetivo_institucion' => 'required'
            ]);
            $qsE = Institucion::where('ins_id', $id)->firstOrFail();
            $qsE->ins_nombre = (string) $request->get('nombre_institucion');
            $qsE->ins_frase = (string) $request->get('frase_institucion');
            $qsE->ins_mision = (string) $request->get('mision_institucion');
            $qsE->ins_vision = (string) $request->get('vision_institucion');
            $qsE->ins_obj = (string) $request->get('objetivo_institucion');
            $qsE->ins_obj_esp1 = (string) $request->get('primer_obj_esp');
            if($request->get('segundo_obj_esp')==null){
                $qsE->ins_obj_esp2 = null;
            }
            else{
                $qsE->ins_obj_esp2 = (string) $request->get('segundo_obj_esp');
            }
            if($request->get('tercer_obj_esp')==null){
                $qsE->ins_obj_esp3 = null;
            }
            else{
                $qsE->ins_obj_esp3 = (string) $request->get('tercer_obj_esp');
            }
            $qsE->save();
            return redirect()->route('quienessomos.index')->with('status', 'Se MODIFICÓ la informacion con exito');
        } catch(Exception $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
    }
}
