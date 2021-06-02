<footer id="footer">
    <div class="footer-top">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6">
          <div class="footer-info">
            <h3>E<span>BID</span></h3>
            <p>
              Ciudad Satelite<br>
              El Alto, La Paz<br><br>
              <strong>Telefono:</strong><br>
              <strong>Email:</strong><br>
            </p>
            <div class="social-links mt-3">
              <a href="https://www.twitter.com" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="https://www.facebook.com" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="https://www.instagram.com" class="instagram"><i class="bx bxl-instagram"></i></a>
              <a href="https://www.youtube.com" class="youtube"><i class="bx bxl-youtube"></i></a>
            </div>
            <div class="mt-3">
              <p>
                
                <strong>Institucion avalada por:</strong><br>
              </p>
              <a href="/" class="" style="width: 55px;"><img src="{{ asset('assets/img/logo2.png') }}" alt="" class="img-fluid"></a>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 footer-links">
          <h4>Navega por nuestra pagina</h4>
          <ul>
            <li><i class="bx bx-chevron-right"></i> <a href="/">Inicio</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="#">Nosotros</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="#">Oferta academica</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('indexGaleria') }}">Galeria</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('indexVideo') }}">Videos</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('indexNoticias') }}">Noticias</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('indexContactos') }}">Contactos</a></li>
            <br><br>
            <li><a href="@if (Auth::check()) /administracion @else login_ @endif">ERES MIEMBRO? INGRESA A NUESTRO SISTEMA</a></li>
          </ul>
        </div>


        <div class="col-lg-4 col-md-6 footer-newsletter">
          <h4>Ingresa tu email</h4>
          <p>Para suscribirte en nuestras noticias</p>
          <form action="" method="post">
            <input type="email" name="email" autocomplete="off"><input type="submit" value="Suscribirse" style="color: white">
          </form>
        </div>
        
      </div>
    </div>
  </div>

  <div class="container">
    <div class="copyright">
      &copy; Copyright <strong>E<span>BID</span></strong> Todos los derechos reservados
    </div>
    <!--div class="credits">
      Pagina diseñada por: <a href="">IDG</a>
    </div-->
  </div>
</footer>