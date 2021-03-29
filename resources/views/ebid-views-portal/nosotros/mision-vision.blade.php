@extends('ebid-views-portal.componentes.main')
@section('title', 'MisionVision')
@section('nosotros', 'drop-down')
@section('oferta', 'drop-down')
@section('content')
<section id="hero" class="d-flex align-items-center justify-content-center hero-fondo-home">
  <div class="container" data-aos="fade-up">
        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
            <div class="col-xl-10 col-lg-8">
                <h1>{{$instituciones ->ins_nombree}}</h1>
                <h2>{{$instituciones ->ins_frasee}}</h2>
                <h1>MISIÓN Y VISIÓN</h1>
                <h2>Conozca la Misión, visión y los objetivos que nos planteamos como institución.</h2>
            </div>
        </div>
        &nbsp;
        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
            <div class="col-xl-6 col-lg-8">
                <h1> </h1>
            </div>
        </div>
  </div>
</section>
<section class="inicio">
  <div class="container" data-aos="fade-up">
    <div class="row">
      <div class="col-md-6">
        <img src="{{ asset('assets/img/m-v.jpg') }}" class="img-fluid" alt="">
      </div>
      <div class="col-md-6">
        <h2>NUESTRA MISIÓN</h2>
        <p class="font-italic">{{$instituciones ->ins_mision}}</p>
        &nbsp;
        <h2>NUESTRA VISIÓN</h2>
        <p class="font-italic">{{$instituciones ->ins_vision}}</p>
        &nbsp;
        <h2>NUESTRO OBJETIVO</h2>
        <p class="font-italic">{{$instituciones ->ins_obj}}</p>
        &nbsp;
        <h2>QUEREMOS</h2>
        <li class="font-italic">{{$instituciones ->ins_obj_esp1}}</li>
        <li class="font-italic">{{$instituciones ->ins_obj_esp2}}</li>
        <li class="font-italic">{{$instituciones ->ins_obj_esp3}}</li>
        <li class="font-italic">{{$instituciones ->ins_obj_esp4}}</li>
        <li class="font-italic">{{$instituciones ->ins_obj_esp5}}</li>
      </div>
    </div>
  </div>
  &nbsp;
  
</section>
@endsection

