<?php

namespace App\Http\Controllers\PortalWeb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Institucion;
use App\Models\UnidadAcademica;
use App\Models\Noticias;
use App\Models\Galeria;
use App\Models\Videos;

use Illuminate\Support\Facades\Mail;

class PWContactoController extends Controller
{
    public function indexContactos()
    {
        $institucion = Institucion::all()->first();
        $uacad = UnidadAcademica::select('*')
                ->where('ua_ins_id', '=', $institucion->ins_id)
                ->get();
        return view('ebid-views-portal.contactos', [
            'institucion' => $institucion,
            'uacad' => $uacad]);
    }
    public function indexNoticias()
    {
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

    public function indexGaleria()
    {
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

    public function indexVideo()
    {
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
        dd('asdas');
        Mail::to('easley.gc@gmail.com')->send("blah");
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
