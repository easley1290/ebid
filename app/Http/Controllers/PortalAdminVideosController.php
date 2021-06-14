<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Models\UnidadAcademica;
use App\Models\Subdominios;
use App\Models\Videos;

class PortalAdminVideosController extends Controller
{
    public function index()
    {
        try{
            $unidadAcademica = UnidadAcademica::all();
            $videos = Videos::all();
            $subdominios = Subdominios::all();
            $arrayAux = [$unidadAcademica, $subdominios, $videos];
            return view('ebid-views-administrador.portal-web.videos')->with('arrayAux', $arrayAux);
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
                'c_nombre_video' => 'required|min:8|max:50',
                'c_url_video' => 'required|min:8|max:200',
                'c_ua_video' => 'required'
            ]);

            $videoC = new Videos;

            $videoC->vid_titulo = (string) $request->get('c_nombre_video');
            $videoC->vid_url = (string) 'https://www.youtube.com/embed/'.$request->get('c_url_video');
            $videoC->vid_ua_id = (string) $request->get('c_ua_video');
            $videoC->vid_subd_estado = (int) $request->get('c_estado_video');
            $videoC->save();
            return redirect()->route('videos.index')->with('status', 'Se CREÓ un nuevo registro para un nuevo video.');
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
                'e_nombre_video' => 'required|min:10|max:100'
            ]);
            
            $videoE = Videos::find((int)$id);
            if($request->get('e_url_video') == null){
                $videoE->vid_titulo = (string) $request->get('e_nombre_video');
                $videoE->vid_ua_id = (string) $request->get('e_ua_video');
                $videoE->vid_subd_estado = (int) $request->get('e_estado_video');
                $videoE->save();
            } else{
                $videoE->vid_url = (string) 'https://www.youtube.com/embed/'.$request->get('e_url_video');
                $videoE->vid_titulo = (string) $request->get('e_nombre_video');
                $videoE->vid_ua_id = (string) $request->get('e_ua_video');
                $videoE->vid_subd_estado = (int) $request->get('e_estado_video');
                $videoE->save();
            }
            return redirect()->route('videos.index')->with('status', 'Se MODIFICÓ el registro del video.');
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
            $videoD = Videos::find((int)$id);
            $videoD->delete();
            return redirect()->route('videos.index')->with('status', 'Se ELIMINÓ el registro del video con éxito.');
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
