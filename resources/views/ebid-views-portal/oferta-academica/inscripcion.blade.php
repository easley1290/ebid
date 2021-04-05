@extends('ebid-views-portal.componentes.main')
@section('title', 'Inscripcion')
@section('nosotros', 'drop-down')
@section('oferta', 'drop-down active')

@section('content')
<section id="hero" class="d-flex align-items-center justify-content-center hero-fondo-home">
  <div class="container" data-aos="fade-up">
      <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
          <div class="col-xl-6 col-lg-8">
          <h1>INSCRIPCIÓN</h1>
          </div>
      </div>
  </div>
</section>
<section class="inicio">
  <div class="container" data-aos="fade-up">
    <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
          <div class="col-md-6">
            <img src="{{ asset('assets/img/antiguo.png') }}" class="img-fluid" alt="">
            <h2>Estudiante antiguo o miembro de la Institución</h2><br>
            <a href="@if (Auth::check()) /administracion @else login_ @endif" class="btn-miembro">INGRESAR AL SISTEMA<i class="ri-arrow-right-s-line"></i></i></a>
          </div>
          <div class="col-md-6">          
            <img src="{{ asset('assets/img/nuevo.png') }}" class="img-fluid" alt="">
            <h2>Estudiante nuevo</h2><br>          
            <a href="register_" class="btn-miembro">REGISTRARME<i class="ri-arrow-right-s-line"></i></i></a>
          </div>
      </div>
  </div>
</section>
@endsection