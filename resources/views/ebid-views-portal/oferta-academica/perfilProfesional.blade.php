@extends('ebid-views-portal.componentes.main')

@section('title', 'Perfil profesional')
@section('nosotros', 'drop-down')
@section('oferta', 'drop-down active')


@section('content')
<section id="hero" class="d-flex align-items-center justify-content-center hero-fondo-home">
  <div class="container" data-aos="fade-up">
      <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
          <div class="col-xl-6 col-lg-8">
          <h1>PERFIL PROFESIONAL</h1>
          </div>
      </div>
  </div>
</section>
<section class="inicio">
  <div class="container" data-aos="fade-up">
    <div class="row">
      
      <div class="col-lg-7 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-right" data-aos-delay="100">
        <h2>En el marco del Diseño Curricular Base de la Formación en Artes:</h2>
        @foreach ($perfiles as $perfil)
        <p class="font-italic">
          {{ $perfil->ins_perfil_profesional }} 
          <span style="color: #e45512;">{{$perfil->ins_frase}}</span>
        </p>
        @endforeach
        <h4 class="font-italic">No dejes que tus sueños se apaguen</h4>
        <!--<a href="" class="btn-oferta">NUESTRA OFERTA PARA TI<i class="ri-arrow-right-s-line"></i></i></a>-->
      </div>
      <div class="col-lg-5 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
        <img src="{{ asset('assets/img/oferta1.jpg') }}" class="img-fluid" alt="">
      </div>
    </div>
  </div>
  <div class="container" data-aos="fade-up">
    <div class="row" style="margin-top: 50px;">
      <div class="col-lg-7 pt-4 pt-lg-0 order-1 order-lg-2 content" data-aos="fade-left" data-aos-delay="100">
        <h2>La o el Egresado/a del nivel Licenciatura será capaz de: </h2>
            <li type="disc" class="ml-4" style="font-size: 16px;">Aplicar en la vida cotidiana personal y comunal los valores humanos adquiridos a través de su formación artística.</li>
            <li type="disc" class="ml-4" style="font-size: 16px;">Reconocer, analizar y construir las estructuras del lenguaje artístico.</li>
            <li type="disc" class="ml-4" style="font-size: 16px;">Aplicar las técnicas avanzadas en el desarrollo de su formación artística. </li>
            <li type="disc" class="ml-4" style="font-size: 16px;">Será capaz de desarrollar su capacidad creativa.</li>
            <li type="disc" class="ml-4" style="font-size: 16px;">Impulsar el desarrollo artístico en comunidad.</li>
            <li type="disc" class="ml-4" style="font-size: 16px;">Dominar el área de especialidad.</li>
      </div>
      <div class="col-lg-5 order-2 order-lg-1" data-aos="fade-right" data-aos-delay="100">
        <img src="{{ asset('assets/img/p-prof.jpg') }}" class="img-fluid" alt="">
      </div>
    </div>
  </div><br><br>
  <div class="container" data-aos="fade-up">
    <div class="row">
      <div class="col-lg-12 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-right" data-aos-delay="100">
        <h2>La o el Profesional de Danza interpreta una cultura y su identidad como artista:</h2>
        @foreach ($perfiles as $perfil)
        <p class="font-italic">
           <ul>• Con conocimientos técnicos, prácticos y teóricos de la interpretación y ejecución 
                de la danza en cualquiera de sus géneros y estilos.</ul>
           <ul>• Puede seguir estudios superiores.</ul>
           <ul>• Desarrollarse como solista o miembro de compañías de danzas nacionales e 
                internacionales.</ul>
            <ul>• Utiliza creativamente el lenguaje corporal en la interpretación de la obra 
                dancística.</ul>
            <ul>• Investiga y analiza las manifestaciones de la danza en la sociedad.</ul>
            <ul>• Crea una composición coreográfica para la construcción de una obra.</ul> 
            <ul>• Interpreta danzas teatrales en comedias musicales y otras.</ul>
            <ul>• Interpreta ballet clásico tradicional o de repertorio.</ul>
            <ul>• Interpreta las danzas folklóricas bolivianas y latinoamericanas.</ul>
            <ul>• Interpreta danza moderna o de espectáculo.</ul>
            <ul>• Dirige un espectáculo dancístico.</ul>
            <ul>• Desarrolla procesos pedagógicos en la interpretación de la danza.</ul>
            <ul>• Participa en la creación de montajes escénicos teatrales y musicales.</ul>
            <ul>• Participa en el diseño, gestión y realización de proyectos de espectáculos de 
            danza.</ul>
        </p>
        @endforeach
        <!--<a href="" class="btn-oferta">NUESTRA OFERTA PARA TI<i class="ri-arrow-right-s-line"></i></i></a>-->
      </div>
    </div>
  </div>
</section>
@endsection