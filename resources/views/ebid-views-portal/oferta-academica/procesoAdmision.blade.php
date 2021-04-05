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
        <h2>ESTUDIANTES INGRESANTES</h3>
        <h3>EXAMEN DE ADMISION  2021</h2>
        <p class="font-italic">
        En el presente año por temas de pandemia covid-19, se procederá a la evaluación directa de los y las estudiantes postulantes a la Licenciatura en Danza de la Escuela Boliviana Intercultural de la Danza “EBID”.
        La evaluación se realizará de manera presencial en instalaciones de la “EBID” previa revisión de la documentación de inscripción que habilitan a dicha instancia.     
        La evaluación consta de las siguientes materias:
        <li>FUNDAMENTOS DE LA DANZA CLÁSICA.</li>
        <li>FUNDAMENTOS DE LA DANZA CONTEMPORÁNEA.</li>
        <li>FUNDAMENTOS DE LA DANZA FOLCLÓRICA.</li>
        <li>PARÁMETROS MUSICALES.</li>
        <li>DEFENSA CARTA MOTIVACIONAL.</li>
        </p>
      </div>
    </div>
  </div>
  <div class="container" data-aos="fade-up">
    <div class="row" style="margin-top: 50px;">
      <div class="col-lg-12 pt-4 pt-lg-0 order-1 order-lg-2 content" data-aos="fade-left" data-aos-delay="100">
        <h2>REQUERIMIENTOS</h2>
        <p class="font-italic">
        Los y las estudiantes deberán asistir a clase con los elementos necesarios para cada actividad 
        (por ejemplo, para Danza clásica: zapatillas de media punta y ropa holgada / para Danza Contemporánea: 
        medias o pie descalzo/ para Danza Folclórica: zapatillas de media punta o zapatos deportivos livianos/ 
        para Materia Teórica: un cuaderno de notas)
        </p>
      </div>
    </div>
  </div>
  <div class="container" data-aos="fade-up">
    <div class="row" style="margin-top: 50px;">
      <div class="col-lg-12 pt-4 pt-lg-0 order-1 order-lg-2 content" data-aos="fade-left" data-aos-delay="100">
        <h2>PASOS PARA EL REGISTRO</h2>
        <p class="font-italic">
        Deberas registrarte en el siguiente enlace y llenar los datos correspondientes, una vez llenado el formulario 
        se le enviara la contraseña a su correo personal con la que podra ingresar al sistema.
        <a href="register_" class="btn-miembro">REGISTRATE AQUÍ<i class="ri-arrow-right-s-line"></i></i></a>
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <img src="{{ asset('assets/img/ejemplo_est.png') }}" class="img-fluid" alt="">
            </div>
            <div class="col-md-6">
              Una vez en el sistema podra visualizar una vista similar a la imagen y seguir los siguientes pasos los cuales se ecuentran
              en el siguiente enlace
              <li>Ingresar a inscripción estudiante</li> 
            </div>
          </div>
        </div>
        </p>
      </div>
    </div>
  </div>
</section>
@endsection