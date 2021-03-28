@extends('ebid-views-portal.componentes.main')
@section('title', 'Videos')
@section('nosotros', 'drop-down')
@section('oferta', 'drop-down')
@section('video', 'active')
@section('content')
<section id="hero" class="d-flex align-items-center justify-content-center hero-fondo-home">
  <div class="container" data-aos="fade-up">
      <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
          <div class="col-xl-6 col-lg-8">
            <h1>VIDEOS</h1>
            <h2>Vea nuestros nuevos videos de nuestro canal de YouTube</h2>
          </div>
      </div>
  </div>
</section>

<section id="portfolio" class="portfolio">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <p>Mira nuestros videos</p>
        </div>
        <div class="row" data-aos="fade-up" data-aos-delay="200">
            @if ($video != null)
            @foreach ($video as $vid)
                <div class="col-md-6 mb-5">
                    <div class="d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="200">
                        <div class="member col-md-12" data-aos="fade-up" data-aos-delay="100">
                            <div class="member-img mb-4">
                                <h4 class="mb-2">{{ $vid->vid_titulo }}</h4>
                                <iframe width="100%" height="300px" src="{{ $vid->vid_url.'?rel=0&amp;autoplay=0' }}" frameborder="0"
                                allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen></iframe>
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
                <div style="justify-content: space-between; display:inline-block; float:right;">{{ $video->onEachSide(10)->links() }}</div>
            </div>
        </div>
    </div>
</section>
@endsection