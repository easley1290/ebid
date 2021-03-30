@extends('ebid-views-portal.componentes.main')
@section('title', 'PlantelDoc')
@section('content')
@section('nosotros', 'drop-down')
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
      <P>CONOCE A NUESTRO EQUIPO DE INSTRUCTORES</P>
    </div>
    <div class="row">
      @foreach($doc as $adm)
      <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
        <div class="member" data-aos="fade-up" data-aos-delay="100">
          <div class="member-img" style=" height: 80%; 
                                          display: flex;
                                          justify-content: center;
                                          align-items: center;">
            <img src="{{$adm->per_foto_personal}}" class="img-fluid" alt="" width="100%">
            <div class="social">
              <p style="font-size: 18px;">{{$adm->name}}</p>
              <!--a href=""><i class="icofont-facebook"></i></a-->
            </div>
          </div>
          <div class="member-info">
            <h4>{{$adm->name}}</h4>
            <h4>{{$adm->email}}</h4>
          </div>
        </div>
      </div>
      @endforeach
    </div>

  </div>
</section>
@endsection

