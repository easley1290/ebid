@extends('ebid-views-portal.componentes.main')

@section('title', 'Malla curricular')
@section('nosotros', 'drop-down')
@section('oferta', 'drop-down active')

@section('content')
<section id="hero" class="d-flex align-items-center justify-content-center hero-fondo-home">
  <div class="container" data-aos="fade-up">
      <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
          <div class="col-xl-6 col-lg-8">
          <h1>MALLA CURRICULAR</h1>
          </div>
      </div>
  </div>
</section>
<section class="inicio">
<div class="container" data-aos="fade-up">
    <div class="row">
      <div class="col-lg-8 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
        <img src="{{ asset('assets/img/danza.jpg') }}" class="img-fluid" alt="">
      </div>
      <div class="col-lg-4 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-right" data-aos-delay="100">
        <h2>CARRERA DE DANZA</h2>
        @foreach ($institucions as $institucion)
        <p class="font-italic">
            {{$institucion->ins_obj}}
        </p>
        @endforeach
        <a href="" class="btn-oferta">INSCRIPCION<i class="ri-arrow-right-s-line"></i></i></a>
      </div>
    </div>
</div>
</section>
<div class="container">
    <div class="row">
        <img src="{{ asset('assets/img/MALLA CURRICULAR.jpg') }}" class="img-fluid" alt="">
    </div>
</div>
@endsection