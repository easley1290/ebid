@extends('ebid-views-portal.componentes.main')
@section('title', 'Contactos')
@section('contactos', 'active')
@section('nosotros', 'drop-down')
@section('oferta', 'drop-down')

@section('content')
<section id="hero" class="d-flex align-items-center justify-content-center hero-fondo-home">
  <div class="container" data-aos="fade-up">
      <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
          <div class="col-xl-6 col-lg-8">
            <h1>CONTACTOS</h1>
            <h2>Como contactarnos</h2>
          </div>
      </div>
  </div>
</section>
<!-- ======= Contact Section ======= -->
<section id="contact" class="contact">
  @foreach ($uacad as $ua)
  <div class="container" data-aos="fade-up">
    <div class="section-title">
      <p>{{ $ua->ua_nombre }}</p>
      <h2>Ubicacion geografica</h2>
    </div>

    <div class="col-lg-12 mb-4" style="display: inline-block;">
      <div class="info">
        <div class="address">
          <i class="icofont-google-map" style="color: white"></i>
          <h4>Ubicación:</h4>
          <p>{{ $ua->ua_direccion }}</p>
        </div>

        <div class="email">
          <i class="icofont-envelope" style="color: white"></i>
          <h4>Correo electronico:</h4>
          <p>{{ $ua->ua_correo_electronico }}</p>
        </div>
        <div class="phone">
          <i class="icofont-phone" style="color: white"></i>
          <h4>Telefono:</h4>
          <p>{{ $ua->ua_telefono }}</p>
        </div>
      </div>
    </div>

    <div>
      <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7649.695421384281!2d-68.1548309!3d-16.5337842!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x915edf385449b7fb%3A0xaee624e53636b4a8!2sNueva%20Ebid!5e0!3m2!1ses-419!2sbo!4v1616883584514!5m2!1ses-419!2sbo" frameborder="0" allowfullscreen></iframe>
    </div>
  @endforeach
    
  <div class="row mt-5" style="justify-content: center">
    <div class="section-title">
      <p>Contactanos te responderemos pronto</p>
    </div>
    <div class="col-lg-8 mt-5 mt-lg-0">
      <form action="{{ route('contactus') }}" method="POST" class="php-email-form">
        @csrf
        <div class="form-row">
          <div class="col-md-6 form-group">
            <input type="text" name="name" class="form-control" 
                  id="name" placeholder="Ingresa tu nombre" data-rule="minlen:10" 
                  data-msg="Por favor minimo 10 caracteres" autocomplete="off"
                  onKeyPress="if(this.value.length==50) return false;"/>
            <div class="validate"></div>
          </div>
          <div class="col-md-6 form-group">
            <input type="email" class="form-control" name="email" id="email" 
                  placeholder="Ingresa tu correo electronico" data-rule="email"
                  data-msg="Porfavor ingresa un email valido" autocomplete="off"
                  onKeyPress="if(this.value.length==40) return false;"/>
            <div class="validate"></div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-6 form-group">
            <input type="number" name="phone" class="form-control" id="phone" 
                  placeholder="Ingresa tu numero de celular" data-rule="minlen:8" 
                  data-msg="Por favor ingresa correctamente tu celular caracteres" autocomplete="off"
                  onKeyPress="if(this.value.length==10) return false;"/>
            <div class="validate"></div>
          </div>
          <div class="col-md-6 form-group">
            <input type="text" class="form-control" name="subject" id="subject" 
                  placeholder="Cual es el asunto de tu consulta?" data-rule="minlen:8" 
                  data-msg="Por favor ingresa 8 caracteres como minimo" autocomplete="off" 
                  onKeyPress="if(this.value.length==30) return false;"/>
          <div class="validate"></div>
          </div>
        </div>
        <div class="form-group">
          <textarea class="form-control" name="message" rows="5" data-rule="required" 
                    data-msg="Cual es tu mensaje?" placeholder="Mensaje" autocomplete="off"
                    onKeyPress="if(this.value.length==300) return false;" style="resize: none"></textarea>
          <div class="validate"></div>
        </div>
        <div class="text-center">
          <button type="submit" onclick="deshabilitar(enviarMensaje)" id="enviarMensaje" style="color: white">Enviar mensaje</button>
        </div>
      </form>
    </div>
  </div>
</section>
<script type="text/javascript">
  function deshabilitar(param1){
      setTimeout(function(){
          var a = document.getElementsByClassName("validate")[4].innerHTML;
          if(!a){
            param1.disabled = true;
          }
      }, 20);
  }
</script>
@endsection

