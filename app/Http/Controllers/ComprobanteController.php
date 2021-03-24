<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiantes;
use App\Models\Subdominios;
use App\Models\Comprobantes;

class ComprobanteController extends Controller
{
    public function index()
    {
        $estudiantes = Estudiantes::select('estudiantes.*','personas.*')
                ->join('personas', 'personas.per_id', '=', 'estudiantes.est_per_id')
                ->get();
                
        return view('ebid-views-administrador.inscripcion.validar_comprobante')->with('estudiantes', $estudiantes);
    }
    public function create(){
        $estudiantes = Estudiantes::select('estudiantes.*','personas.*')
                ->join('personas', 'personas.per_id', '=', 'estudiantes.est_per_id')
                ->get();
                
        return view('ebid-views-administrador.inscripcion.subir_comprobante')->with('estudiantes', $estudiantes);
    }

    public function update(Request $request, $id)
    {
        try{
            $this->validate($request,[
                'comprobante' => 'required|image|mimes:png,jpg,jpeg|max:8192',
                'tipo_comprobante' => 'required'
            ]);
            
            $comprobante = Comprobantes::all() -> last();
            if($comprobante == null){
                $comprobanteId = 1;
            }else{
                $comprobanteId = $comprobante -> com_id;
                $comprobanteId = $comprobanteId + 1;
            }   

            $comprobanteC = new Comprobantes;

            $imagen = $request->file('comprobante');
            $nombreImagen = 'Comprobante - ID'.$id.'_'.time().$request->get('tipo_comprobante').'.'.$imagen->getClientOriginalExtension();
            $destinoImagen = public_path('assets\img\comprobantes');
            $imagen->move($destinoImagen, $nombreImagen);

            $comprobanteC->com_url = (string) $nombreImagen;
            $comprobanteC->com_tipo = $request->get('tipo_comprobante');
            $comprobanteC->com_est_id = (int)$id;
            $comprobanteC->com_estado = 0;
            $comprobanteC->save();

            return redirect()->route('comprobante.index')->with('status', 'Se subio el comprobante con exito');
        } catch(Throwable $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
    }
}
