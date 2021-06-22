<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Models\Subdominios;

class AdministracionController extends Controller
{
    
    public function index()
    {
        try{
            //devuelve el index del ebid-views-admin
            $subdominios = Subdominios::select('subd_descripcion')
                    ->where('subd_nombre', '=', 'Parcial actual')
                    ->first();
            return view('ebid-views-administrador.home', [
                'subdominios'=>$subdominios
            ]);
        }
        catch(QueryException $err){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual.');
        }
    }
}
