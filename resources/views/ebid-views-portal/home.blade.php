@extends('ebid-views-portal.componentes.main')
@section('title', 'Inicio')
@section('content')
<section id="hero" class="d-flex align-items-center justify-content-center hero-fondo-home">
  <div class="container" data-aos="fade-up">
      <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
          <div class="col-xl-6 col-lg-8">
          <h1>ENSEÑANZA DE DANZA EN <span>BOLIVIA</span></h1>
          <h2>Profesionalismo y arte </h2>
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

<section class="services">
  <div class="container" data-aos="fade-up">
    <div class="section-title alinear-centro">
      <p>TENEMOS MUCHO POR ENSEÑARTE</p>
    </div>
    <div class="row">
      <div class="col-lg-6 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
        <div class="icon-box">
          <div class="danza-miniaturas"><img src="{{ asset('assets/img/d-clasica.jpg') }}" width="500"></div>
          <h4>Danza clásica</h4>
          <p>es una forma de danza cuyos movimientos se basan en el control total 
          y absoluto del cuerpo, el cual se debe enseñar desde temprana edad.</p>
        </div>
      </div>

      <div class="col-lg-6 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="100">
        <div class="icon-box">
          <div class="danza-miniaturas"><img src="{{ asset('assets/img/d-contemporanea.jpg') }}" width="500"></div>
          <h4>Danza moderna-contemporanea</h4>
          <p>Aprendizaje que parte desde el centro corporal, hacia el manejo de las
          extremidades, la fuerza de la gravedad, los equilibrios y desequilibrios, 
          las contracciones, las suspensiones y las caídas</p>
        </div>
      </div>

      <div class="col-lg-6 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="100">
        <div class="icon-box">
          <div class="danza-miniaturas"><img src="{{ asset('assets/img/d-moderna.jpg') }}" width="500"></div>
          <h4>Danza folklórica</h4>
          <p>Sus movimientos son una expresión libre y fluida de estados, emociones, metáforas o ideas abstractas</p>
        </div>
      </div>

      <div class="col-lg-6 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="100">
        <div class="icon-box">
          <div class="danza-miniaturas"><img src="{{ asset('assets/img/d-Ballet.jpg') }}" width="500"></div>
          <h4>Coreografía y direccion</h4>
          <p>El ballet moderno o ballet contemporáneo es una forma de danza influenciada
          tanto por el ballet clásico como por la danza moderna. Si bien adopta la 
          técnica del ballet clásico, permite un mayor rango de movimiento.</p>
        </div>
      </div>
    </div>
  </div>
</section>
 <section class="testimonials">
  <div class="container" data-aos="zoom-in">
    <div class="owl-carousel testimonials-carousel alinear-centro">
      <div class="testimonial-item ">
        <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
        <h3>Saul Goodman</h3>
        <h4>Ceo &amp; Founder</h4>
        <p>
          <i class="bx bxs-quote-alt-left quote-icon-left"></i>
          Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
          <i class="bx bxs-quote-alt-right quote-icon-right"></i>
        </p>
      </div>

      <div class="testimonial-item">
        <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
        <h3>Sara Wilsson</h3>
        <h4>Designer</h4>
        <p>
          <i class="bx bxs-quote-alt-left quote-icon-left"></i>
          Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.
          <i class="bx bxs-quote-alt-right quote-icon-right"></i>
        </p>
      </div>

      <div class="testimonial-item">
        <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
        <h3>Jena Karlis</h3>
        <h4>Store Owner</h4>
        <p>
          <i class="bx bxs-quote-alt-left quote-icon-left"></i>
          Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.
          <i class="bx bxs-quote-alt-right quote-icon-right"></i>
        </p>
      </div>

      <div class="testimonial-item">
        <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
        <h3>Matt Brandon</h3>
        <h4>Freelancer</h4>
        <p>
          <i class="bx bxs-quote-alt-left quote-icon-left"></i>
          Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.
          <i class="bx bxs-quote-alt-right quote-icon-right"></i>
        </p>
      </div>

      <div class="testimonial-item">
        <img src="assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
        <h3>John Larson</h3>
        <h4>Entrepreneur</h4>
        <p>
          <i class="bx bxs-quote-alt-left quote-icon-left"></i>
          Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.
          <i class="bx bxs-quote-alt-right quote-icon-right"></i>
        </p>
      </div>

    </div>

  </div>
</section>

<section class="portfolio">
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
              <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 portfolio-item">
        <div class="portfolio-wrap">
          <img src="{{ asset('assets/img/galeria-home/galeria-2.png') }}" class="img-fluid">
          <div class="portfolio-info">
            <h4>Uno de nuestros cursos</h4>
            <div class="portfolio-links">
              <a href="{{ asset('assets/img/galeria-home/galeria-2.png') }}" data-gall="portfolioGallery" class="venobox"></a>
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
</section>

<section class="team">
  <div class="container" data-aos="fade-up">
    <div class="section-title alinear-centro">
      <h2>CONOCE EL EQUIPO</h2>
      <p>NUESTROS INSTRUCTORES DE BAILE</p>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
        <div class="member" data-aos="fade-up" data-aos-delay="100">
          <div class="member-img">
            <img src="assets/img/team/team-1.jpg" class="img-fluid" alt="">
            <div class="social">
              <p style="font-size: 15px;">Director creativo de presentaciones.</p>
              <a href=""><i class="icofont-facebook"></i></a>
            </div>
          </div>
          <div class="member-info">
            <h4>Walter White</h4>
            <h4>DIRECCION GENERAL Y PROFESOR DE BALLET</h4>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
        <div class="member" data-aos="fade-up" data-aos-delay="200">
          <div class="member-img">
            <img src="assets/img/team/team-2.jpg" class="img-fluid" alt="">
            <div class="social">
              <p style="font-size: 15px;">Coreografa y bailarina profesional.</p>
              <a href=""><i class="icofont-facebook"></i></a>
            </div>
          </div>
          <div class="member-info">
            <h4>Sarah Jhonson</h4>
            <h4>DIRECCION ARTISTICA Y PROGRAMA DE CONTEMPORANEO</h4>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
        <div class="member" data-aos="fade-up" data-aos-delay="300">
          <div class="member-img">
            <img src="assets/img/team/team-3.jpg" class="img-fluid" alt="">
            <div class="social">
              <p style="font-size: 15px;">Bailarin profesional, se graduo en las escuela de danza de La Habana.</p>
              <a href=""><i class="icofont-facebook"></i></a>
            </div>
          </div>
          <div class="member-info">
            <h4>William Anderson</h4>
            <h4>DIRECCION ARTISTICA Y PROGRAMA DE MODERNO</h4>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
        <div class="member" data-aos="fade-up" data-aos-delay="400">
          <div class="member-img">
            <img src="assets/img/team/team-4.jpg" class="img-fluid" alt="">
            <div class="social">
              <p style="font-size: 15px;">Profesora de ballet, expresión corporal y teatro. Bailarina clásica profesional titulada por la Escuela del Ballet Oficial de Bolivia,</p>
              <a href=""><i class="icofont-facebook"></i></a>
            </div>
          </div>
          <div class="member-info">
            <h4>Amanda Jepson</h4>
            <h4>PROFESORA DE BALLET</h4>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
@endsection

