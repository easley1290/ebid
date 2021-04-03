@extends('ebid-views-portal.componentes.main')
@section('title', 'Plantel Docente')
@section('content')
@section('nosotros', 'active drop-down')
@section('oferta', 'drop-down')

<section id="hero" class="d-flex align-items-center justify-content-center hero-fondo-home">
  <div class="container" data-aos="fade-up">
        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
            <div class="col-xl-10 col-lg-8">
                <h1>{{$instituciones ->ins_nombree}}</h1>
                <h2>{{$instituciones ->ins_frasee}}</h2>
                <h1> PLANTEL DOCENTES</h1>
                <h2>Conozca al equipo de instructores de la Escuela Boliviana de Danza Boliviana.</h2>
            </div>
        </div>
        &nbsp;
        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
            <div class="col-xl-6 col-lg-8">
                <h1></h1>
            </div>
        </div>
  </div>
</section>
<section class="team">
  <div class="container" data-aos="fade-up">
    <div class="section-title alinear-centro">
      <h2></h2>
      <P>CONOCE A NUESTRO EQUIPO DE DOCENTES</P>
    </div>

  
      @foreach($doc as $adm)
      <!--div class="col-lg-3 col-md-6 d-flex align-items-stretch">
        <div class="member" data-aos="fade-up" data-aos-delay="100">
          <div class="member-img" style=" height: 80%; 
                                          display: flex;
                                          justify-content: center;
                                          align-items: center;">
            <img src="http://ebid.edu.bo/public{{$adm->per_foto_personal}}" class="img-fluid" alt="" width="100%">
            <div class="social">
              <p style="font-size: 12px; color:black;">{{$adm->doc_descripcion}}</p>
              <a href=""><i class="icofont-facebook"></i></a>
            </div>
          </div>
          <div class="member-info">
            <h4>{{$adm->name}}</h4>
            <h5>{{$adm->doc_titulo}}</h5>
          </div>
        </div>
      </div-->

      <div class="col-md-12">
        <div class="container" data-aos="fade-up">
          <div class="row" style="margin-top: 50px;">
            <div class="col-lg-8 pt-4 pt-lg-0 order-1 order-lg-2 content" data-aos="fade-left" data-aos-delay="100">
              <h5 style="color: purple;"><b>{{$adm->doc_titulo}}</b></h5>
              <h5 style="color: black;"><b>{{$adm->name}}</b></h5>
              <p class="font-italic">{{$adm->doc_descripcion}}</p>
            </div>
            <div class="col-lg-4 order-2 order-lg-1" data-aos="fade-right" data-aos-delay="100">
              <img src="{{$adm->per_foto_personal}}" alt="" width="60%">
            </div>
          </div>
        </div>
      </div>
      @endforeach
 

  </div>
</section>
@endsection

