@extends('ebid-views-portal.componentes.main')
@section('title', 'Inicio')
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
        Las o los Egresados/as de Danza serán conscientes de la realidad boliviana, reflexivos/as
        y comprometidos/as con su área, conocedores/as de las técnicas más depuradas de la 
        expresión artística, preparados/as en la historia y su relación dentro del contexto 
        universal, capaces de realizar presentaciones de alto nivel interpretativo, capaces de llevar 
        adelante procesos prácticos en el escenario y comprometidos/as con la realidad Boliviana, 
        críticos/as y generadores/as de nuevas políticas culturales en beneficio de nuestro Estado 
        Plurinacional. 
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
        <img src="{{ asset('assets/img/oferta2.jpg') }}" class="img-fluid" alt="">
      </div>
    </div>
  </div><br><br>
  <div class="container" data-aos="fade-up">
    <div class="row">
      <div class="col-lg-12 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-right" data-aos-delay="100">
        <h2>La o el Profesional de Danza interpreta una cultura y su identidad como artista:</h2>
        @foreach ($perfiles as $perfil)
        <p class="font-italic">
            • Con conocimientos técnicos, prácticos y teóricos de la interpretación y ejecución 
                de la danza en cualquiera de sus géneros y estilos.
            • Puede seguir estudios superiores.
            • Desarrollarse como solista o miembro de compañías de danzas nacionales e 
                internacionales.
            • Utiliza creativamente el lenguaje corporal en la interpretación de la obra 
                dancística.
            • Investiga y analiza las manifestaciones de la danza en la sociedad.
            • Crea una composición coreográfica para la construcción de una obra. 
            • Interpreta danzas teatrales en comedias musicales y otras.
            • Interpreta ballet clásico tradicional o de repertorio.
            • Interpreta las danzas folklóricas bolivianas y latinoamericanas.
            • Interpreta danza moderna o de espectáculo.
            • Dirige un espectáculo dancístico.
            • Desarrolla procesos pedagógicos en la interpretación de la danza.
            • Participa en la creación de montajes escénicos teatrales y musicales.
            • Participa en el diseño, gestión y realización de proyectos de espectáculos de 
            danza.
        <span style="color: #e45512;">{{$perfil->ins_frase}}</span>
        </p>
        @endforeach
        <!--<a href="" class="btn-oferta">NUESTRA OFERTA PARA TI<i class="ri-arrow-right-s-line"></i></i></a>-->
      </div>
    </div>
  </div>
</section>
@endsection