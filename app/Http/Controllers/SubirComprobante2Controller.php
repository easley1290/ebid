<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiantes;
use App\Models\Subdominios;
use App\Models\Comprobantes;
use App\Models\Pensum;
use App\Models\Semestre;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class SubirComprobante2Controller extends Controller
{
    public function index()
    {
        $estudiantes = Estudiantes::select('estudiantes.*', 'personas.*')
                        ->join('personas', 'personas.per_id', '=', 'estudiantes.est_per_id')
                        ->get();
        $semestres = Semestre::all();
                
        return view('ebid-views-administrador.inscripcion.subir_comprobanteNA', ['estudiantes' => $estudiantes, 'semestre' => $semestres]);
    }

    public function update(Request $request, $id)
    {
        try{
            $this->validate($request,[
                'comprobante' => 'required|image|mimes:png,jpg,jpeg|max:8192',
                'numero_comprobante' => 'required'
            ]);

            $comprobante = Comprobantes::all() -> last();
            if($comprobante == null){
                $comprobanteId = 1;
            }
            else{
                $comprobanteId = $comprobante -> com_id;
                $comprobanteId = $comprobanteId + 1;
            }   
            if($request->get('tipo_comprobante1')=="inscripcion"){
                $tipo_comp = "inscripcion ".$request->get('tipo_comprobante2');
            }
            else{
                $tipo_comp = "examen";
            }

            $comprobanteC = new Comprobantes;

            $imagen = $request->file('comprobante');
            $nombreImagen = 'ID'.$id."-".date('YmdHis_').$tipo_comp.'.'.$imagen->getClientOriginalExtension();
            $destinoImagen = $imagen->storeAs('public/Comprobante', $nombreImagen);
            $rutaImagen = '/storage/Comprobante/'.$nombreImagen;

            $comprobanteC->com_url = (string) $rutaImagen;
            $comprobanteC->com_tipo = $tipo_comp;
            $comprobanteC->com_est_id = (int)$id;
            $comprobanteC->com_numero = $request->get('numero_comprobante');
            $comprobanteC->com_estado = 0;
            $comprobanteC->save();

            return redirect()->route('subir-comprobante.index')->with('status', 'Se subio el comprobante con exito');
        } catch(Throwable $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
    }
}
