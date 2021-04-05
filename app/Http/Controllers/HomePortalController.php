<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Institucion;
use App\Models\Personas;
use Mail;
use App\Mail\Contactanos;

class HomePortalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
