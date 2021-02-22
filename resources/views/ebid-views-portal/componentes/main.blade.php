<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title') - EBID</title>
    @extends('ebid-views-portal.componentes.link')
</head>
<body>
    <header id="header" class="fixed-top ">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="/" class="logo"><img src="{{ asset('assets/img/logo.png') }}" alt="" class="img-fluid"></a>
            <nav class="nav-menu d-none d-lg-block">
                <ul>
                <li class="active"><a href="#inicio">Inicio</a></li>
                <li class="drop-down"><a href="">Nosotros</a>
                    <ul>
                        <li><a href="#">Drop Down 1</a></li>
                        <li><a href="#">Drop Down 2</a></li>
                        <li><a href="#">Drop Down 3</a></li>
                        <li><a href="#">Drop Down 4</a></li>
                    </ul>
                </li>
                <li><a href="">Oferta académica</a></li>
                <li><a href="">Galeria</a></li>
                <li><a href="">Noticias</a></li>
                <li><a href="">Contactos</a></li>
                </ul>
            </nav>
            <a href="" class="btn-miembro" style="">Eres miembro?</a>
        </div>
    </header>
    
    <main id="main">
        @yield('content')
    </main>
  
    @extends('ebid-views-portal.componentes.footer')

    <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>
    <div id="preloader"></div>
    @extends('ebid-views-portal.componentes.script')
</body>
</html>