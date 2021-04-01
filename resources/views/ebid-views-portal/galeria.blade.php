@extends('ebid-views-portal.componentes.main')
@section('title', 'Galeria')
@section('nosotros', 'drop-down')
@section('oferta', 'drop-down')
@section('galeria', 'active')

@section('content')
<section id="hero" class="d-flex align-items-center justify-content-center hero-fondo-home">
  <div class="container" data-aos="fade-up">
      <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
          <div class="col-xl-6 col-lg-8">
            <h1>GALERIA</h1>
            <h2>Vea nuestras fotografias y vive una experiencia visual de nuestras actividades</h2>
          </div>
      </div>
  </div>
</section>

<section id="portfolio" class="portfolio">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <p>Mira nuestra galeria</p>
        </div>
        <div class="row" data-aos="fade-up" data-aos-delay="200">
            @if ($galeria != null)
            @foreach ($galeria as $gal)
                    <div class="col-md-6 mb-5">
                        <div class="portfolio-item">
                            <div class="portfolio-wrap">
                                <img src="{{ "http://ebid.edu.bo/public"+$gal->gal_direccion }}" class="img-fluid" alt="">
                                <div class="portfolio-info">
                                    @foreach ($uacad as $ua)
                                        @if ($ua->ua_id == $gal->gal_ua_id)
                                            <h4>{{ $gal->gal_titulo.' _ '.$ua->ua_nombre }}</h4>
                                            <div class="portfolio-links">
                                                <a href="{{ "http://ebid.edu.bo/public"+gal->gal_direccion }}" data-gall="portfolioGallery" class="venobox" title="{{ $gal->gal_titulo.' _ '.$ua->ua_nombre }}"><i class="bx bx-link"></i></a>
                                            </div>
                                            @break
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                
            @endforeach
            @else
            <div class="col-12" style="justify-items: center; text-align:center;" data-aos="zoom-in" data-aos-delay="200">
                <div class="member" data-aos="fade-up" data-aos-delay="100">
                    <div class="member-info">
                        <h4>Ups!!!! no hay nada que mostrar</h4>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="row">
            <div class="mt-5">
                <div style="justify-content: space-between; display:inline-block; float:right;">{{ $galeria->onEachSide(10)->links() }}</div>
            </div>
        </div>
    </div>
</section>
@endsection