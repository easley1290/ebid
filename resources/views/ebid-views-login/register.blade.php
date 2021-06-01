@extends('ebid-views-login.componentes.link')
{!! htmlScriptTagJsApi(['lang' => 'es']) !!}
<body class="" id="body">
  <div class="container d-flex flex-column justify-content-between vh-100">
  <div class="row justify-content-center mt-5">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header bg-purple">
          <div class="app-brand">
            <a href="/">
              <img src="{{ asset('assets/img/logo.png') }}" alt="" class="img-fluid">
              <span class="brand-name"><h3>Inscripción</h3></span>
            </a>
          </div>
        </div>
        <div class="card-body p-5">
          <h4 class="text-dark mb-5">Ingrese los siguientes datos</h4>
          <form method="POST" action="{{ route('register') }}" onsubmit="return validateRecaptcha();">
            @csrf
            <div class="row">
              <div class="form-group col-md-4 mb-4">
                <input id="per_nombres" type="text" 
                      class="form-control input-lg @error('per_nombres') is-invalid @enderror" 
                      name="per_nombres" value="{{ old('per_nombres') }}" placeholder="Nombres" 
                      onKeyPress="if(this.value.length==50) return false;"
                      autocomplete="per_nombres" autofocus required>
                @error('per_nombres')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group col-md-4 mb-4">
                <input id="per_paterno" type="text" 
                      class="form-control input-lg @error('per_paterno') is-invalid @enderror" 
                      name="per_paterno" value="{{ old('per_paterno') }}" placeholder="Apellido Paterno" 
                      onKeyPress="if(this.value.length==50) return false;" autocomplete="per_paterno" required>
                @error('per_paterno')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group col-md-4 mb-4">
                <input id="per_materno" type="text" 
                      class="form-control input-lg @error('per_materno') is-invalid @enderror" 
                      name="per_materno" value="{{ old('per_materno') }}" placeholder="Apellido materno" 
                      onKeyPress="if(this.value.length==50) return false;" autocomplete="per_materno" required>
                @error('per_materno')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group col-md-4 mb-4">
                <input id="per_num_documentacion" type="number" 
                      class="form-control input-lg @error('per_num_documentacion') is-invalid @enderror" 
                      name="per_num_documentacion" value="{{ old('per_num_documentacion') }}" placeholder="Numero de documento" 
                      onKeyPress="if(this.value.length==11) return false;" autocomplete="per_num_documentacion" min="1" required>
                @error('per_num_documentacion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group col-md-4 mb-4">
                <input id="per_alfanumerico" type="text" 
                      class="form-control input-lg @error('per_alfanumerico') is-invalid @enderror" 
                      name="per_alfanumerico" value="{{ old('per_alfanumerico') }}" placeholder="Complemento (Opcional)" 
                      onKeyPress="if(this.value.length==4) return false;" autocomplete="per_alfanumerico">
                @error('per_alfanumerico')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group col-md-4 mb-4">
                <select class="form-select form-control" name="per_subd_extension" id="per_subd_extension" required>
                  <option value="" disabled selected>-- Extensión CI --</option>
                  @foreach($extension as $ext)               
                    <option value="{{$ext->subd_id}}">{{$ext->subd_nombre}}</option>
                  @endforeach
                </select>
              </div>
              
              <!--div class="form-group col-md-6 mb-4">
                <input type="number" class="form-control input-lg" id="materno" aria-describedby="maternoHelp" placeholder="Telefono">
              </div-->

              <div class="form-group col-md-8 mb-4">
                <input id="email" type="email" class="form-control input-lg @error('email') is-invalid @enderror" 
                      name="email" value="{{ old('email') }}" placeholder="Correo personal" 
                      onKeyPress="if(this.value.length==50) return false;"
                      autocomplete="email" required>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group col-md-4 mb-4">
                <input id="per_telefono" type="number" class="form-control input-lg @error('per_telefono') is-invalid @enderror" 
                      name="per_telefono" value="{{ old('per_telefono') }}" placeholder="Celular con Whatsapp"
                      onKeyPress="if(this.value.length==10) return false;" min="1" required>
                @error('per_telefono')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <!--div class="form-group col-md-12 ">
                <input id="password" type="password" class="form-control input-lg @error('password') is-invalid @enderror" 
                name="password" placeholder="Contraseña" autocomplete="new-password" required>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="form-group col-md-12 ">
                <input id="password-confirm" type="password" class="form-control" 
                name="password_confirmation" placeholder="Confirmar Contraseña" autocomplete="new-password" required>
              </div-->
              
              <div class="col-md-12" aria-label="Verifique el codigo captcha" >
                <div class="col-md-4" style="display: flex; justify-content: center; margin-left: auto; margin-right: auto;">{!! htmlFormSnippet() !!}</div>

              </div>

              <div class="form-group row col-md-12">
                <div class="col-md-12 mt-4">
                  <button type="submit" class="btn btn-lg btn-purple btn-block mb-4">Incribirse</button>
                  <p>Ya tienes una cuenta?
                    <a class="text-blue" href="login_">Volver</a>
                  </p>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
<script src='https://www.google.com/recaptcha/api.js?render=onload{{ (isset($lang) ? '&hl='.$lang : '') }}'></script>
<script type="text/javascript">
  function validateRecaptcha() {
    var response = grecaptcha.getResponse();
    if (response.length === 0) {
        alert("Debe validar que no es un robot, marcando el captcha");
        return false;
    } else {
        return true;
    }
}
</script>
@extends('ebid-views-login.componentes.script')