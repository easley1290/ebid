<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use File;

use App\Models\Estudiantes;
use App\Models\Subdominios;
use App\Models\Comprobantes;

class ComprobanteController extends Controller
{
    public function index()
    {
        // trae vista de lista de comprobantes de los estudiantes de estado 6, 7 y 8
        try{
            $comprobante = DB::table('personas')
                    ->select('personas.*', 'estudiantes.*', 'comprobantes.*')
                    ->join('estudiantes', 'estudiantes.est_per_id', '=', 'personas.per_id')
                    ->join('comprobantes', 'estudiantes.est_id', '=', 'comprobantes.com_est_id')
                    ->where('estudiantes.est_subd_estado', '=', 8)
                    ->orWhere('estudiantes.est_subd_estado', '=', 7)
                    ->orWhere('estudiantes.est_subd_estado', '=', 6)
                    ->get();

            return view('ebid-views-administrador.inscripcion.comprobante', [
                'comprobante'=> $comprobante
            ]);
        }
        catch(QueryException $err){
            if($err){
                $e = json_decode(json_encode($err), true);
                $numeroError = $e['errorInfo'][1];
                $nombreError = $e['errorInfo'][2];
                return redirect()->route('administracion.index')->with('status', 'Hubo un error inusual ('.$numeroError.' - '.$nombreError.')');
            }
            else{
                return redirect()->route('administracion.index')->with('status', 'Hubo un error inusual');
            }
        }
    }
    public function update(Request $request, $id)
    {
        // guarda modificaciones que se pudiesen haber dado en el registro del comprobante
        try{
            $this->validate($request,[
                'e_tipo_comprobante' => 'required'
            ]);
            $comprobanteE = Comprobantes::find($id);

            if($request->file('em_image_comprobante')){
                $imagen = $request->file('em_image_comprobante');
                $rutaImagenAntigua = public_path().$comprobanteE->com_url;
                $nombreImagen = 'ID'.$id."-".date('YmdHis_').$request->get('tipo_comprobante').'.'.$imagen->getClientOriginalExtension();
                $destinoImagen = $imagen->storeAs('public/Comprobante', $nombreImagen);
                $rutaImagen = '/storage/Comprobante/'.$nombreImagen;

                if(File::exists($rutaImagenAntigua)){
                    unlink($rutaImagenAntigua);
                }
            }
            else{
                $nombreImagen = $comprobanteE->com_url;

                $pos = strpos($nombreImagen, 'examen');
                if($pos != false){
                    $rutaImagenAntigua = public_path().$comprobanteE->com_url;
                    $rutaImagen=str_replace("examen", $request->get('e_tipo_comprobante'), $nombreImagen);

                    $rutaImagenNuevo = public_path().$rutaImagen;

                    rename($rutaImagenAntigua, $rutaImagenNuevo);
                }else{
                    $pos = strpos($nombreImagen, 'inscripcion');
                    if($pos != false){
                        $rutaImagenAntigua = public_path().$comprobanteE->com_url;
                        $rutaImagen=str_replace("inscripcion", $request->get('e_tipo_comprobante'), $nombreImagen);
                        $rutaImagenNuevo = public_path().$rutaImagen;
                        rename($rutaImagenAntigua, $rutaImagenNuevo);
                    }
                }
            }
            $comprobanteE->com_url = (string) $rutaImagen;
            $comprobanteE->com_tipo = $request->get('e_tipo_comprobante');
            $comprobanteE->com_numero = $request->get('e_numero_comprobante');
            $comprobanteE->com_estado = 0;
            $comprobanteE->save();

            return redirect()->route('comprobante.index')->with('status', 'Se modifico el registro del comprobante, como se modifico el registro el estado validacion volvio a "No validado"');
        }
        catch(QueryException $err){
            if($err){
                $e = json_decode(json_encode($err), true);
                $numeroError = $e['errorInfo'][1];
                $nombreError = $e['errorInfo'][2];
                return redirect()->route('administracion.index')->with('status', 'Hubo un error inusual ('.$numeroError.' - '.$nombreError.')');
            }
            else{
                return redirect()->route('administracion.index')->with('status', 'Hubo un error inusual');
            }
        }
    }
    public function destroy($id){
        // elimina el registro del comprobante seleccionado
        try{
            $comprobanteE = Comprobantes::find($id);
            
            unlink(public_path().$comprobanteE->com_url);
            $comprobanteE->delete();
            return redirect()->route('comprobante.index')->with('status', 'Se elimino el registro del comprobante');
        }
        catch(QueryException $err){
            if($err){
                $e = json_decode(json_encode($err), true);
                $numeroError = $e['errorInfo'][1];
                $nombreError = $e['errorInfo'][2];
                return redirect()->route('administracion.index')->with('status', 'Hubo un error inusual ('.$numeroError.' - '.$nombreError.')');
            }
            else{
                return redirect()->route('administracion.index')->with('status', 'Hubo un error inusual');
            }
        }
    }
}
