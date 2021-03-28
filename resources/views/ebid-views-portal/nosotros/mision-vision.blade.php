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
      <div class="col-lg-7 order-2 order-lg-1" data-aos="fade-left" data-aos-delay="100">
        <img src="{{ asset('assets/img/d-clasica1.jpg') }}" class="img-fluid" alt="">
      </div>
      <div class="col-lg-5 pt-4 pt-lg-0 order-1 order-lg-2 content" data-aos="fade-right" data-aos-delay="100">
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
        <p class="font-italic">{{$instituciones ->ins_obj_esp1}}</p>
        <p class="font-italic">{{$instituciones ->ins_obj_esp2}}</p>
        <p class="font-italic">{{$instituciones ->ins_obj_esp3}}</p>
        <p class="font-italic">{{$instituciones ->ins_obj_esp4}}</p>
        <p class="font-italic">{{$instituciones ->ins_obj_esp5}}</p>
      </div>
    </div>
  </div>
  &nbsp;
  
</section>
@endsection

