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
            if($request->get('tipo_comp')==='examen'){
                $comprobanteE->com_estado = 1;
                $estudianteE = Estudiantes::find($comprobanteE->com_est_id);
                $estudianteE->est_examen_ingreso_estado = 15;
                $estudianteE->est_subd_estado = 8;
                $comprobanteE->save();
                $estudianteE->save();
                return redirect()->route('calendario-ingreso.index')->with('status', 'Comprobante de examen del postulante '.$request->get('name').' validado, PROGRAME SU FECHA DE EXAMEN');
            }
            elseif ($request->get('tipo_comp')==='inscripcion') {
                
                $comprobanteE->com_estado = 1;
                $estudianteE = Estudiantes::find($comprobanteE->com_est_id);
                $estudianteE->est_examen_ingreso_estado = 13;
                $estudianteE->est_subd_estado = 6;
                
                
                $persona = Personas::find($estudianteE->est_per_id);
                $persona->per_rol = 3;
                
                $pensum = Pensum::select('pensum.*')
                        ->where('pen_sem_id','=', $estudianteE->est_sem_id)
                        ->where('pen_subd_estado', '=', 1)
                        ->get();
                $tamanioPensum = (int) count($pensum);
                for ($i = 0; $i < $tamanioPensum; $i++)
                {
                    $new = MateriaEstudiante::create([
                        'mate_mat_id' => $pensum[$i]->pen_mat_id,
                        'mate_esp_id' => $pensum[$i]->pen_esp_id,
                        'mate_sem_id' => $pensum[$i]->pen_sem_id,
                        'mate_est_id' => $estudianteE->est_id,
                        'mate_subd_id' => 9
                    ]);
                }
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
