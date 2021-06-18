<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subdominios;

class AdministracionController extends Controller
{
    
    public function index()
    {
        //devuelve el index del ebid-views-admin
        $subdominios = Subdominios::select('subd_descripcion')
                        ->where('subd_nombre', '=', 'Parcial actual')
                        ->first();
        return view('ebid-views-administrador.home', [
            'subdominios'=>$subdominios
        ]);
    }
}
