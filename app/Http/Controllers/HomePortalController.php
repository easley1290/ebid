<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Institucion;
use App\Models\Personas;
use Mail;
use App\Mail\Contactanos;
use Illuminate\Database\QueryException;

class HomePortalController extends Controller
{
    public function index()
    {
        // retorna index del portal web
        try{
            $perfiles = Institucion::select('institucion.*')
                ->where('ins_id','=',1)
                ->get();
            $instituciones = Institucion::select('*')
                ->first(); 
            $doc = Personas::select('*')
                ->where('per_rol', '=', 6)
                ->where('per_subd_estado','=',1)
                ->join('docentes', 'doc_per_id', '=', 'per_id')
                ->get(); 
            $aux = [$perfiles, $instituciones, $doc];
            return view('ebid-views-portal.home')->with('aux', $aux);
        }
        catch(QueryException $err){
            if($err){
                $e = json_decode(json_encode($err), true);
                $numeroError = $e['errorInfo'][1];
                $nombreError = $e['errorInfo'][2];
                return view('error', [
                    'numero'=> $numeroError,
                    'nombre'=> $nombreError
                ]);
            }
            else{
                return view('error', [
                    'numero'=> '',
                    'nombre'=> ''
                ]);
            }
        }
    }

    public function store(Request $request)
    {
        // Formulario de contactanos del portal web
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'subject' => 'required',
            'phone' => 'required'
        ]);

        $details = [
            'fecha'=> date('d-m-Y', time()),
            'hora'=> date('h:i:s a', time()),
            'nombre' => $request->get('name'),
            'correo' => $request->get('email'),
            'asunto' => $request->get('subject'),
            'mensaje' => $request->get('message'),
            'celular' => $request->get('phone')
        ];

        Mail::to('soporte@ebid.edu.bo')
            ->send(new Contactanos($details));

        return response(json_encode('OK'), 200)->header('Content-type', 'text/plain');
    }
}
