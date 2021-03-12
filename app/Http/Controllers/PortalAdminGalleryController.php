<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UnidadAcademica;
use App\Models\Subdominios;
use App\Models\Galeria;

class PortalAdminGalleryController extends Controller
{
    
    public function index()
    {
        try{
            $unidadAcademica = UnidadAcademica::all();
            $galeria = Galeria::all();
            $subdominios = Subdominios::all();
            $arrayAux = [$unidadAcademica, $subdominios, $galeria];
            return view('ebid-views-administrador.portal-web.galeria')->with('arrayAux', $arrayAux);
        } catch (Throwable $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
    }


    public function store(Request $request)
    {
        try{
            $this->validate($request,[
                'c_nombre_galeria' => 'required|min:8|max:30',
                'c_imagen_galeria' => 'required|image|mimes:png,jpg, jpeg|max:8192',
                'c_ua_galeria' => 'required'
            ]);

            $galeria = Galeria::all() -> last();
            if($galeria == null){
                $galeriaId = 1;
            }else{
                $galeriaId = $galeria -> gal_id;
                $galeriaId = $galeriaId + 1;
            }
            
            $galeriaC = new Galeria;

            $imagen = $request->file('c_imagen_galeria');
            $nombreImagen = 'Galeria'.$galeriaId.'_'.time().'.'.$imagen->getClientOriginalExtension();
            $destinoImagen = public_path('assets\img\galeria');
            $imagen->move($destinoImagen, $nombreImagen);

            $galeriaC->gal_titulo = (string) $request->get('c_nombre_galeria');
            $galeriaC->gal_direccion = (string) $nombreImagen;
            $galeriaC->gal_ua_id = (string) $request->get('c_ua_galeria');
            $galeriaC->gal_subd_estado = (int) $request->get('c_estado_galeria');
            $galeriaC->save();
            return redirect()->route('galeria.index')->with('status', 'Se CREÓ un nuevo registro para la galeria.');
        } catch(Throwable $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
    }


    public function update(Request $request, $id)
    {
        try{
            $this->validate($request,[
                'e_nombre_galeria' => 'required|min:10|max:100',
                'e_ua_galeria' => 'required'
            ]);
            
            $galeriaE = Galeria::find((int)$id);
            
            if($request->file('em_imagen_galeria')){
                $imagen = $request->file('em_imagen_galeria');
                $rutaImagenAntigua = public_path().'\\assets\img\galeria\\'.$galeriaE->gal_direccion;
                $nombreImagen = 'Galeria'.$galeriaE->gal_id.'_'.time().'.'.$imagen->getClientOriginalExtension();
                $destinoImagen = public_path('assets\img\galeria');
                $imagen->move($destinoImagen, $nombreImagen);
                unlink($rutaImagenAntigua);
            }else{
                $nombreImagen = $galeriaE->gal_direccion;
            }

            $galeriaE->gal_titulo = (string) $request->get('e_nombre_galeria');
            $galeriaE->gal_direccion = (string) $nombreImagen;
            $galeriaE->gal_ua_id = (string) $request->get('e_ua_galeria');
            $galeriaE->gal_subd_estado = (int) $request->get('e_estado_galeria');
            $galeriaE->save();
            return redirect()->route('galeria.index')->with('status', 'Se MODIFICÓ el registro para la galeria.');
        } catch(Throwable $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
    }

 
    public function destroy($id)
    {
        try{
            $galeriaD = Galeria::find((int)$id);
            unlink(public_path().'\\assets\img\galeria\\'.$galeriaD->gal_direccion);
            $galeriaD->delete();
            return redirect()->route('galeria.index')->with('status', 'Se ELIMINÓ el registro de la galeria con éxito.');
        } catch(Throwable $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
    }
}
