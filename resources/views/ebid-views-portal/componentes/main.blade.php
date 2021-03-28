<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title') - EBID</title>
    @extends('ebid-views-portal.componentes.link')
</head>
<body>
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="/" class="" style="width: 60px;"><img src="{{ asset('assets/img/logo.png') }}" alt="" class="img-fluid"></a>
            <nav class="nav-menu d-none d-lg-block">
                <ul><li class="@yield('inicio')"><a href="/">Inicio</a></li>
                <li class="@yield('nosotros')"><a href="">Nosotros</a>
                    <ul>
                        <li class="@yield('MisionVision')"><a href="{{ route('MisionVision') }}">Mision y vision</a></li>
                        <li class="@yield('PlantelAdm')"><a href="{{ route('PlantelAdm') }}">Rectoria y direccion academica</a></li>
                        <li class="@yield('PlantelDoc')"><a href="{{ route('PlantelDoc') }}">Plantel docente</a></li>
                    </ul>
                </li>
                <li class="@yield('oferta')"><a href="">Oferta académica</a>
                    <ul>
                        <li><a href="{{ route('perfilProfesional.index') }}">Perfil profesional</a></li>
                        <li><a href="{{ route('procesoAdmision.index') }}">Proceso de admision</a></li>
                        <li><a href="{{ route('malla.index') }}">Malla curricular</a></li>
                        <li><a href="{{ route('inscripcion.index') }}">Inscripciones</a></li>
                    </ul>
                </li>
                <li class="@yield('galeria')"><a href="{{ route('indexGaleria') }}">Galeria</a></li>
                <li class="@yield('video')"><a href="{{ route('indexVideo') }}">Videos</a></li>
                <li class="@yield('noticia')"><a href="{{ route('indexNoticias') }}">Noticias</a></li>
                <li class="@yield('contactos')"><a href="{{ route('indexContactos') }}">Contactos</a></li></ul>
            </nav>
            <a href="@if (Auth::check()) /administracion @else login_ @endif" class="btn-miembro" style="">Eres miembro?</a>
        </div>
    </header>
    
    <main id="main">
        @yield('content')
    </main>
  
    @extends('ebid-views-portal.componentes.footer')
    <a href="#" class="back-to-top"><i class="ri-arrow-up-line" style="color: white"></i></a>
    <div id="preloader"></div>
    @extends('ebid-views-portal.componentes.script')
</body>
</html>