<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Models\UnidadAcademica;
use App\Models\Institucion;
use App\Models\Subdominios;

class UnidadAcademicaController extends Controller
{
    public function index()
    {
        try{
            $unidadAcademicas = UnidadAcademica::all();
            $institucions = Institucion::all();
            $estados = Subdominios::select('subdominios.*')
            ->where('subd_dom_id','=',1)
            ->get();
            $aux = [$unidadAcademicas, $institucions, $estados];
            return view('ebid-views-administrador.unidadAcademica.unidadAcademica')->with('aux', $aux);
        } 
        catch(QueryException $err, Exception $e){
            if($err){
                $e = json_decode(json_encode($err), true);
                $numeroError = $e['errorInfo'][1];
                $nombreError = $e['errorInfo'][2];
                return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual ('.$numeroError.' - '.$nombreError.')');
            }
            else{
                return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
            }
        }
    }

    public function store(Request $request)
    {
        try{
            $this->validate($request,[
                'ua_id' => 'required',
                'ua_ins_id' => 'required',
                'ua_nombre' => 'required',
                'ua_direccion' => 'required',
                'ua_telefono' => 'required',
                'ua_celular' => 'required',
                'ua_correo_electronico' => 'required',
                'ua_subd_estado' => 'required',
            ]);
            $ua_nuevo = new UnidadAcademica;

            $ua_nuevo->ua_id = $request->input('ua_id');
            $ua_nuevo->ua_ins_id = $request->input('ua_ins_id');
            $ua_nuevo->ua_nombre = $request->input('ua_nombre');
            $ua_nuevo->ua_direccion = $request->input('ua_direccion');
            $ua_nuevo->ua_telefono = $request->input('ua_telefono');
            $ua_nuevo->ua_celular = $request->input('ua_celular'); 
            $ua_nuevo->ua_correo_electronico = $request->input('ua_correo_electronico');
            $ua_nuevo->ua_subd_estado = $request->input('ua_subd_estado');
            $ua_nuevo->save();
            return redirect()->route('UnidadAcademica.index')->with('status', 'Se CREÓ la Unidad Académica con exito');
        } 
        catch(QueryException $err, Exception $e){
            if($err){
                $e = json_decode(json_encode($err), true);
                $numeroError = $e['errorInfo'][1];
                $nombreError = $e['errorInfo'][2];
                return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual ('.$numeroError.' - '.$nombreError.')');
            }
            else{
                return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
            }
        }
    }

    public function update(Request $request, $id)
    {
        try{
            $this->validate($request,[
                'ua_id' => 'required',
                'ua_ins_id' => 'required',
                'ua_nombre' => 'required',
                'ua_direccion' => 'required',
                'ua_telefono' => 'required',
                'ua_celular' => 'required',
                'ua_correo_electronico' => 'required',
                'ua_subd_estado' => 'required',
            ]);
            $ua_nuevo = UnidadAcademica::find($id);

            $ua_nuevo->ua_id = $request->input('ua_id');
            $ua_nuevo->ua_ins_id = $request->input('ua_ins_id');
            $ua_nuevo->ua_nombre = $request->input('ua_nombre');
            $ua_nuevo->ua_direccion = $request->input('ua_direccion');
            $ua_nuevo->ua_telefono = $request->input('ua_telefono');
            $ua_nuevo->ua_celular = $request->input('ua_celular');
            $ua_nuevo->ua_correo_electronico = $request->input('ua_correo_electronico');
            $ua_nuevo->ua_subd_estado = $request->input('ua_subd_estado');
            $ua_nuevo->save();
            return redirect()->route('UnidadAcademica.index')->with('status', 'Se MODIFICÓ la Unidad Académica con exito');
        } 
        catch(QueryException $err, Exception $e){
            if($err){
                $e = json_decode(json_encode($err), true);
                $numeroError = $e['errorInfo'][1];
                $nombreError = $e['errorInfo'][2];
                return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual ('.$numeroError.' - '.$nombreError.')');
            }
            else{
                return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
            }
        }
    }

    public function destroy($id)
    {
        try{
            $ua_delete = UnidadAcademica::find($id);
            $ua_delete->delete();
            return redirect()->route('UnidadAcademica.index')->with('status', 'Se ELIMINÓ la Unidad Académica con exito');
        } 
        catch(QueryException $err, Exception $e){
            if($err){
                $e = json_decode(json_encode($err), true);
                $numeroError = $e['errorInfo'][1];
                $nombreError = $e['errorInfo'][2];
                return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual ('.$numeroError.' - '.$nombreError.')');
            }
            else{
                return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
            }
        }
    }
}
