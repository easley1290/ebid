<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnidadAcademica;
use App\Models\Subdominios;

class PortalAdminContactController extends Controller
{
    public function index()
    {
        try{
            $unidadAcademica = UnidadAcademica::all();
            $subdominios = Subdominios::all();
            $arrayAux = [$unidadAcademica, $subdominios];
            return view('ebid-views-administrador.portal-web.contactos')->with('arrayAux', $arrayAux);
        } catch (Throwable $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
    }
    public function update(Request $request, $id)
    {
        try{
            $this->validate($request,[
                'direccion_ua' => 'required|min:10|max:150',
                'telefono_ua' => 'required|min:7|max:8',
                'celular_ua' => 'required|min:8|max:8',
                'correo_electronico_ua' => 'required|min:5|max:50|email'
            ]);
            $contactE = UnidadAcademica::where('ua_id', $id)->firstOrFail();
            
            $contactE->ua_direccion = (string) $request->get('direccion_ua');
            $contactE->ua_telefono = (string) $request->get('telefono_ua');
            $contactE->ua_celular = (string) $request->get('celular_ua');
            $contactE->ua_correo_electronico = (string) $request->get('correo_electronico_ua');
            $contactE->save();
            return redirect()->route('contactos.index')->with('status', 'Se MODIFICÓ la informacion de contactos con exito');
        } catch(Throwable $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
    }
}
