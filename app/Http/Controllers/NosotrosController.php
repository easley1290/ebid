<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Institucion;
use App\Models\Personas;

class NosotrosController extends Controller
{
    public function MisionVision()
    {
        try{
            $instituciones = Institucion::select('*')
            ->first();  
        return view('ebid-views-portal/nosotros/mision-vision')->with('instituciones', $instituciones);
        } 
        catch (Throwable $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
    }

    public function PlantelAdm()
    {
        try{
            $instituciones = Institucion::select('*')
            ->first(); 
            $admin = Personas::select('*')
            ->whereIn('per_rol',[10])
            ->where('per_subd_estado','=',1)
            ->join('administrativos', 'adm_per_id', '=', 'per_id')
            ->get();  
        return view('ebid-views-portal/nosotros/plantel-admin', compact('instituciones','admin'));
        } 
        catch (Throwable $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
    }

    public function PlantelDoc()
    {
        try{
            $instituciones = Institucion::select('*')
            ->first(); 
            $doc = Personas::select('*')
            ->where('per_rol', '=',6)
            ->where('per_subd_estado','=',1)
            ->join('docentes', 'doc_per_id', '=', 'per_id')
            ->get();  
        return view('ebid-views-portal/nosotros/plantel-doc',compact('instituciones','doc'));
        } 
        catch (Throwable $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
    }
}
