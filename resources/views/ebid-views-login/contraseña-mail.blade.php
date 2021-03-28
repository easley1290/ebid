@extends('ebid-views-login.componentes.link')
<body class="" id="body">
  <div class="container d-flex flex-column justify-content-between vh-100">
  <div class="row justify-content-center mt-5">
    <div class="col-xl-6 col-lg-6 col-md-12">
      <div class="card">
        <div class="card-header bg-purple">
          <div class="app-brand">
            <a href="/">
              <img src="{{ asset('assets/img/logo.jpg') }}" alt="" class="img-fluid">
              <span class="brand-name"><h3>Cambio Contraseña</h3></span>
            </a>
          </div>
        </div>
        <div class="card-body p-5">

        <h5 class="mb-5">Introduzca el email con el que se registró, para enviarle su nueva contraseña</h5>
        
        <form method="POST" action="{{ route('CambioContraseña') }}">
            @csrf
            <div class="form-group row">
                <div class="form-group col-md-12 mb-4">
                    <input id="email" type="email" class="form-control input-lg @error('email') is-invalid @enderror" 
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                    placeholder="ejemplo@usuario.com">

                      @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-lg btn-purple btn-block mb-4">Enviar contraseña</button>
            <p>No quieres cambiar tu contraseña?
                <a class="text-purple" href="login_">Volver</a>
            </p>
          
        </form>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
@extends('ebid-views-login.componentes.script')