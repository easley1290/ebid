@extends('ebid-views-portal.componentes.main')

@section('title', 'Proceso de admision')
@section('nosotros', 'drop-down')
@section('oferta', 'drop-down active')


@section('content')
<section id="hero" class="d-flex align-items-center justify-content-center hero-fondo-home">
  <div class="container" data-aos="fade-up">
      <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
          <div class="col-xl-6 col-lg-8">
          <h1>PROCESO DE ADMISIÓN</h1>
          </div>
      </div>
  </div>
</section>
<section class="inicio">
  <div class="container" data-aos="fade-up">
    <div class="row">
      <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
        <img src="{{ asset('assets/img/oferta1.jpg') }}" class="img-fluid" alt="">
      </div>
      <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-right" data-aos-delay="100">
        <h2>APRENDE O PRACTICA TU ARTE...</h3>
        <h3>Nuestra enseñanza te llevará mas allá</h2>
        <p class="font-italic">
          Abierto a personas que realizan el arte de la danza, 
          desde artistas emergentes hasta artistas semiprofesionales.<br>
          Ingresa y al finalizar te daremos la oportunidad de llegar a elencos profesionales internacionales
          a traves de la titulacion en <span style="color: #e45512;">DANZA</span>
        </p>
        <h4 class="font-italic">No dejes que tus sueños se apaguen</h4>
        <a href="" class="btn-oferta">NUESTRA OFERTA PARA TI<i class="ri-arrow-right-s-line"></i></i></a>
      </div>
    </div>
  </div>
  <div class="container" data-aos="fade-up">
    <div class="row" style="margin-top: 50px;">
      <div class="col-lg-6 pt-4 pt-lg-0 order-1 order-lg-2 content" data-aos="fade-left" data-aos-delay="100">
        <h2>PREOCUPADO POR TU TIEMPO Y SALUD</h3>
        <h3>Nosotros nos adaptamos</h2>
        <p class="font-italic">
          Ofrecemos aprendizaje en linea con profesionales preparados para impartir esa modalidad.
          en esta modalidad podras aprender, como si estuvieses en nuestros espacios.
        </p>
        <h4 class="font-italic">No tengas miedo al exito</h4>
        <a href="" class="btn-miembro">LO QUE OFRECEMOS<i class="ri-arrow-right-s-line"></i></i></a>
      </div>
      <div class="col-lg-6 order-2 order-lg-1" data-aos="fade-right" data-aos-delay="100">
        <img src="{{ asset('assets/img/oferta2.jpg') }}" class="img-fluid" alt="">
      </div>
    </div>
  </div>
</section>
@endsection