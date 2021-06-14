<?php

namespace App\Http\Controllers\PortalWeb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\QueryException;

use App\Models\Institucion;
use App\Models\UnidadAcademica;
use App\Models\Noticias;
use App\Models\Galeria;
use App\Models\Videos;

class PWContactoController extends Controller
{
    public function indexContactos()
    {
        try{
            $institucion = Institucion::all()->first();
            $uacad = UnidadAcademica::select('*')
                    ->where('ua_ins_id', '=', $institucion->ins_id)
                    ->get();
            return view('ebid-views-portal.contactos', [
                    'institucion' => $institucion,
                    'uacad' => $uacad]);
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
    public function indexNoticias()
    {
        try{
            $institucion = Institucion::all()->first();
            $uacad = UnidadAcademica::select('*')
                    ->where('ua_ins_id', '=', $institucion->ins_id)
                    ->get();
                    
            $noticias = Noticias::select('*')
                        ->where('not_subd_estado', '=', 1)
                        ->simplePaginate(10);

            $tamanio = count($noticias);
            if($tamanio == 0){
                $noticias = null;
            }
            return view('ebid-views-portal.noticia', [
                'institucion' => $institucion,
                'uacad' => $uacad,
                'noticias' => $noticias]);
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

    public function indexGaleria()
    {
        try{
            $institucion = Institucion::all()->first();
            $uacad = UnidadAcademica::select('*')
                    ->where('ua_ins_id', '=', $institucion->ins_id)
                    ->get();
            $galeria = Galeria::select('*')
                        ->where('gal_subd_estado', '=', 1)
                        ->simplePaginate(10);

            $tamanio = count($galeria);
            if($tamanio == 0){
                $galeria = null;
            }
            return view('ebid-views-portal.galeria', [
                'institucion' => $institucion,
                'uacad' => $uacad,
                'galeria' => $galeria]);
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

    public function indexVideo()
    {
        try{
            $institucion = Institucion::all()->first();
            $uacad = UnidadAcademica::select('*')
                    ->where('ua_ins_id', '=', $institucion->ins_id)
                    ->get();
            $video = Videos::select('*')
                        ->where('vid_subd_estado', '=', 1)
                        ->simplePaginate(2);

            $tamanio = count($video);
            if($tamanio == 0){
                $video = null;
            }
            return view('ebid-views-portal.video', [
                'institucion' => $institucion,
                'uacad' => $uacad,
                'video' => $video]);
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
}
