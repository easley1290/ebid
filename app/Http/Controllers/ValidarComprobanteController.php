<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personas;
use App\Models\Estudiantes;
use App\Models\Subdominios;
use App\Models\Comprobantes;
use App\Models\Pensum;
use App\Models\MateriaEstudiante;
use Illuminate\Support\Facades\DB;

class ValidarComprobanteController extends Controller
{
    public function update(Request $request, $id)
    {
        try{

            $comprobanteE = Comprobantes::find($id);
            
            if($request->get('tipo_comp') ==='examen'){
                $comprobanteE->com_estado = 1;
                $estudianteE = Estudiantes::find($comprobanteE->com_est_id);
                $estudianteE->est_examen_ingreso_estado = 15;
                $estudianteE->est_subd_estado = 8;
                $comprobanteE->save();
                $estudianteE->save();

                return redirect()->route('comprobante.index')->with('status', 'Comprobante de examen del postulante '.$request->get('name').' validado, PROGRAME SU FECHA DE EXAMEN');
            }
            else {
                
                $comprobanteE->com_estado = 1;
                $estudianteE = Estudiantes::find($comprobanteE->com_est_id);
                $estudianteE->est_examen_ingreso_estado = 13;
                $estudianteE->est_subd_estado = 7;         
                
                $persona = Personas::find($estudianteE->est_per_id);
                $persona->per_rol = 3;

                $persona->save();
                $comprobanteE->save();
                $estudianteE->save();
                return redirect()->route('comprobante.index')->with('status', 'Comprobante de inscripcion validado, estudiante inscrito');
            }
            
        } catch(Throwable $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
        
    }
}
