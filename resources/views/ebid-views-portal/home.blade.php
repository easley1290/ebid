@extends('ebid-views-portal.componentes.main')
@section('title', 'Inicio')

@section('inicio', 'active')
@section('nosotros', 'drop-down')
@section('oferta', 'drop-down')

@section('content')
<section id="hero" class="d-flex align-items-center justify-content-center hero-fondo-home">
  <div class="container" data-aos="fade-up">
      <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
          <div class="col-xl-6 col-lg-8">
          <h1>ESCUELA BOLIVIANA INTERCULTURAL DE DANZA</h1>
          @foreach ($aux[0] as $perfil)
            <h2>{{$perfil->ins_frase}}</h2>
          @endforeach
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
        <a href="{{ route('malla.index') }}" class="btn-miembro">LO QUE OFRECEMOS<i class="ri-arrow-right-s-line"></i></i></a>
      </div>
      <div class="col-lg-6 order-2 order-lg-1" data-aos="fade-right" data-aos-delay="100">
        <img src="{{ asset('assets/img/oferta2.jpg') }}" class="img-fluid" alt="">
      </div>
    </div>
  </div>
</section>

<section class="services">
  <div class="container" data-aos="fade-up">
    <div class="section-title alinear-centro">
      <p>TENEMOS MUCHO POR ENSEÑARTE</p>
    </div>
    <div class="row">
      <div class="col-lg-6 col-md-4" data-aos="zoom-in" data-aos-delay="100">
          <div class="danza-miniaturas"><img src="{{ asset('assets/img/d-moderna.jpg') }}" width="400"></div>
          <h4>Danza folklórica</h4>
      </div>
      <div class="col-lg-6 ">
          <div class="danza-miniaturas"><img src="{{ asset('assets/img/d-contemporanea.jpg') }}" width="400"></div>
          <h4>Danza moderna-contemporanea</h4>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-lg-6 col-md-6" data-aos="zoom-in" data-aos-delay="100">
          <div class="danza-miniaturas"><img src="{{ asset('assets/img/d-Ballet.jpg') }}" width="400"></div>
          <h4>Pedagogía de la Danza</h4>
      </div>
      <div class="col-lg-6 col-md-4" data-aos="zoom-in" data-aos-delay="100">
          <div class="danza-miniaturas"><img src="{{ asset('assets/img/d-Ballet.jpg') }}" width="400"></div>
          <h4>Coreografía y dirección</h4>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-3">
      </div>
      <div class="col-md-6">
          <div class="danza-miniaturas"><img src="{{ asset('assets/img/d-clasica.jpg') }}" width="400"></div>
          <h4>Danza clásica</h4>
      </div>
    </div>
  </div>
</section>
 <section class="testimonials">
  <div class="container" data-aos="zoom-in">
    <div class="owl-carousel testimonials-carousel alinear-centro">
      <div class="testimonial-item ">
        <!--<img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">-->
        <h3>Yuri Grigorovich</h3>
        <h4>Mensaje del Día internacional de la Danza 1984</h4>
        <p>
          <i class="bx bxs-quote-alt-left quote-icon-left"></i>
            Este arte puede y debe actuar como un medio de comunicación, de paz y amistad, 
            acercando a los seres humanos.
          <i class="bx bxs-quote-alt-right quote-icon-right"></i>
        </p>
      </div>

      <div class="testimonial-item">
        <h3>Maurice Béjart</h3>
        <h4>Mensaje del Día internacional de la Danza 1997</h4>
        <p>
          <i class="bx bxs-quote-alt-left quote-icon-left"></i>
          La danza , como el cine, cos ofrece imágenes rápidas, emotivas, móviles, plásticas, 
          abstractas o dinámicas que ponen movimiento en nuestro ser.
          <i class="bx bxs-quote-alt-right quote-icon-right"></i>
        </p>
      </div>

      <div class="testimonial-item">
        <h3>Alicia Alonso</h3>
        <h4>Mensaje del Día internacional de la Danza 2018</h4>
        <p>
          <i class="bx bxs-quote-alt-left quote-icon-left"></i>
          La danza ha sido, es y será... una expresión natural y espontánea que brota desde 
          lo más profundo de su espiritu y de su realidad corporal.
          <i class="bx bxs-quote-alt-right quote-icon-right"></i>
        </p>
      </div>

    </div>

  </div>
</section>

<!--<section class="portfolio">
  <div class="container" data-aos="fade-up">
    <div class="section-title alinear-centro">
      <p>NUESTRAS ULTIMAS FOTOGRAFIAS</p>
    </div>
    <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
      <div class="col-lg-4 col-md-6 portfolio-item">
        <div class="portfolio-wrap">
          <img src="{{ asset('assets/img/galeria-home/galeria-1.jpg') }}" class="img-fluid">
          <div class="portfolio-info">
            <h4>Enseñando a adultos</h4>
            <div class="portfolio-links">
              <a href="{{ asset('assets/img/galeria-home/galeria-1.jpg') }}" data-gall="portfolioGallery" class="venobox"></a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 portfolio-item">
        <div class="portfolio-wrap">
          <img src="{{  asset('assets/img/d-moderna.jpg') }}" class="img-fluid">
          <div class="portfolio-info">
            <h4>Uno de nuestros cursos</h4>
            <div class="portfolio-links">
              <a href="{{ asset('assets/img/d-moderna.jpg') }}" data-gall="portfolioGallery" class="venobox"></a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 portfolio-item">
        <div class="portfolio-wrap">
          <img src="{{ asset('assets/img/galeria-home/galeria-3.jpg') }}" class="img-fluid" alt="">
          <div class="portfolio-info">
            <h4>Enseñando danza moderna</h4>
            <div class="portfolio-links">
              <a href="{{ asset('assets/img/galeria-home/galeria-3.jpg') }} data-gall="portfolioGallery" class="venobox"></a>
            </div>
          </div>
        </div>
      </div>
  </div>
</section>-->

<section class="team">
  <div class="container" data-aos="fade-up">
    <div class="section-title alinear-centro">
      <h2>CONOCE EL EQUIPO</h2>
      <p>NUESTROS INSTRUCTORES DE BAILE</p>
    </div>
    <div class="row">
    @foreach($aux[2] as $docente)
      <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
        <div class="member" data-aos="fade-up" data-aos-delay="100">
          <div class="member-img" style=" height: 80%; display: flex;justify-content: center; align-items: center;">
            <img src="http://ebid.edu.bo/public{{$docente->per_foto_personal}}" class="img-fluid" alt="">
            <div class="social">
              <p style="font-size: 12px; color:black;">{{$docente->doc_descripcion}}</p>
              <!--a href=""><i class="icofont-facebook"></i></a-->
            </div>
          </div>
              <div class="member-info">
                <h4>{{$docente->name}}</h4>
                <h5>{{$docente->doc_titulo}}</h5>
              </div>
        </div>
      </div>
    @endforeach
    </div>
  </div>
</section>
@endsection

      