<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\UnidadAcademica;
use App\Models\Subdominios;
use App\Models\Noticias;

class PortalAdminNoticeController extends Controller
{
    public function index()
    {
        try{
            $unidadAcademica = UnidadAcademica::all();
            $noticias = Noticias::all();
            $subdominios = Subdominios::all();
            $arrayAux = [$unidadAcademica, $subdominios, $noticias];
            return view('ebid-views-administrador.portal-web.noticias')->with('arrayAux', $arrayAux);
        } catch (Throwable $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
    }
    public function store(Request $request){
        try{
            $this->validate($request,[
                'c_nombre_noticia' => 'required|min:10|max:100',
                'c_imagen_noticia' => 'required|image|mimes:png,jpg, jpeg|max:8192',
                'c_historia_noticia' => 'required|min:8|max:500',
                'c_ua_noticia' => 'required'
            ]);

            $noticias = Noticias::all() -> last();
            if($noticias == null){
                $noticiaId = 1;
            }else{
                $noticiaId = $noticias -> not_id;
                $noticiaId = $noticiaId + 1;
            }   
            
            

            $noticiaC = new Noticias;

            $imagen = $request->file('c_imagen_noticia');
            $nombreImagen = 'Noticia'.$noticiaId.'_'.time().'.'.$imagen->getClientOriginalExtension();
            $destinoImagen = public_path('assets\img\noticias');
            $imagen->move($destinoImagen, $nombreImagen);

            $noticiaC->not_titulo = (string) $request->get('c_nombre_noticia');
            $noticiaC->not_imagen = (string) $nombreImagen;
            $noticiaC->not_historia = (string) $request->get('c_historia_noticia');
            $noticiaC->not_ua_id = (string) $request->get('c_ua_noticia');
            $noticiaC->not_subd_estado = (int) $request->get('c_estado_noticia');
            $noticiaC->save();
            return redirect()->route('noticias.index')->with('status', 'Se CREÓ la noticia con exito');
        } catch(Throwable $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
    }
    public function update(Request $request, $id){
        try{
            $this->validate($request,[
                'e_nombre_noticia' => 'required|min:10|max:100',
                'e_historia_noticia' => 'required|min:8|max:500',
                'e_ua_noticia' => 'required'
            ]);
            
            $noticiasE = Noticias::find((int)$id);
            
            if($request->file('em_imagen_noticia')){
                $imagen = $request->file('em_imagen_noticia');
                $rutaImagenAntigua = public_path().'\\assets\img\noticias\\'.$noticiasE->not_imagen;
                $nombreImagen = 'Noticia'.$noticiasE->not_id.'_'.time().'.'.$imagen->getClientOriginalExtension();
                $destinoImagen = public_path('assets\img\noticias');
                $imagen->move($destinoImagen, $nombreImagen);

                unlink($rutaImagenAntigua);
            }else{
                $nombreImagen = $noticiasE->not_imagen;
            }

            $noticiasE->not_titulo = (string) $request->get('e_nombre_noticia');
            $noticiasE->not_imagen = (string) $nombreImagen;
            $noticiasE->not_historia = (string) $request->get('e_historia_noticia');
            $noticiasE->not_ua_id = (string) $request->get('e_ua_noticia');
            $noticiasE->not_subd_estado = (int) $request->get('e_estado_noticia');
            $noticiasE->save();
            return redirect()->route('noticias.index')->with('status', 'Se MODIFICÓ la noticia con exito');
        } catch(Throwable $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
    }

    public function destroy($id)
    {
        try{
            $noticiasD = Noticias::find((int)$id);
            unlink(public_path().'\\assets\img\noticias\\'.$noticiasD->not_imagen);
            $noticiasD->delete();
            return redirect()->route('noticias.index')->with('status', 'Se ELIMINÓ la noticia con exito');
        } catch(Throwable $e){
            return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
        }
    }
}
