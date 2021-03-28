@extends('ebid-views-portal.componentes.main')
@section('title', 'Noticias')
@section('nosotros', 'drop-down')
@section('oferta', 'drop-down')
@section('noticia', 'active')


@section('content')
<section id="hero" class="d-flex align-items-center justify-content-center hero-fondo-home">
  <div class="container" data-aos="fade-up">
      <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
          <div class="col-xl-6 col-lg-8">
            <h1>NOTICIAS</h1>
            <h2>de nuestra institucion</h2>
          </div>
      </div>
  </div>
</section>

<section id="services" class="services">
    <div class="container" data-aos="fade-up">
        <div class="row">
            @if ($noticias != null)
                @foreach ($noticias as $noticia)
                    <div class="col-md-6 mb-5">
                        <div class="d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="200">
                            <div class="member" data-aos="fade-up" data-aos-delay="100">
                                <div class="member-img mb-4">
                                    <img src="{{ $noticia->not_imagen }}" class="img-fluid" width="100%" alt="">
                                </div>
                                <div class="member-info">
                                    @foreach ($uacad as $ua)
                                        @if ($ua->ua_id == $noticia->not_ua_id)
                                            <h4>{{ $noticia->not_titulo.' _ '.$ua->ua_nombre }}</h4>
                                            @break
                                        @endif
                                    @endforeach
                                    <span>{{ $noticia->not_historia }}</span>
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
                <div style="justify-content: space-between; display:inline-block; float:right;">{{ $noticias->onEachSide(10)->links() }}</div>
            </div>
        </div>
    </div>
</section>
@endsection

