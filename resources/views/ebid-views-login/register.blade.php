@extends('ebid-views-login.componentes.link')

<body class="" id="body">
  <div class="container d-flex flex-column justify-content-between vh-100">
  <div class="row justify-content-center mt-5">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header bg-primary">
          <div class="app-brand">
            <a href="/">
              <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="30"
                height="33" viewBox="0 0 30 33">
                <g fill="none" fill-rule="evenodd">
                  <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
                  <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                </g>
              </svg>
              <span class="brand-name">Inscripción</span>
            </a>
          </div>
        </div>
        <div class="card-body p-5">
          <h4 class="text-dark mb-5">Llene los siguientes datos, por favor</h4>
          <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="row">
              <div class="form-group col-md-4 mb-4">
                <input id="per_nombres" type="text" 
                      class="form-control input-lg @error('per_nombres') is-invalid @enderror" 
                      name="per_nombres" value="{{ old('per_nombres') }}" placeholder="Nombres" 
                      onKeyPress="if(this.value.length==50) return false;"
                      required autocomplete="per_nombres" autofocus>
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
                      onKeyPress="if(this.value.length==50) return false;" required autocomplete="per_paterno">
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
                      onKeyPress="if(this.value.length==50) return false;" required autocomplete="per_materno">
                @error('per_materno')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <!--div class="form-group col-md-6 mb-4">
                <input type="text" class="form-control input-lg" id="paterno" aria-describedby="paternoHelp" placeholder="Apellido Paterno">
              </div>
              <div class="form-group col-md-6 mb-4">
                <input type="text" class="form-control input-lg" id="materno" aria-describedby="maternoHelp" placeholder="Apellido Materno">
              </div>
              <div class="form-group col-md-6 mb-4">
                <input type="text" class="form-control input-lg" id="materno" aria-describedby="maternoHelp" placeholder="Genero">
              </div>
              <div class="form-group col-md-6 mb-4">
                <input type="text" class="form-control input-lg" id="materno" aria-describedby="maternoHelp" placeholder="Fecha de Nacimiento">
              </div>
              <div class="form-group col-md-4 mb-4">
                <input type="text" class="form-control input-lg" id="materno" aria-describedby="maternoHelp" placeholder="Tipo de Documento">
              </div-->
              <div class="form-group col-md-5 mb-4">
                <input id="per_num_documentacion" type="number" 
                      class="form-control input-lg @error('per_num_documentacion') is-invalid @enderror" 
                      name="per_num_documentacion" value="{{ old('per_num_documentacion') }}" placeholder="Numero de documento" 
                      onKeyPress="if(this.value.length==11) return false;" required autocomplete="per_num_documentacion">
                @error('per_num_documentacion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group col-md-4 mb-4">
                <input id="per_alfanumerico" type="text" 
                      class="form-control input-lg @error('per_alfanumerico') is-invalid @enderror" 
                      name="per_alfanumerico" value="{{ old('per_alfanumerico') }}" placeholder="Alfanumerico (Opcional)" 
                      onKeyPress="if(this.value.length==4) return false;" autocomplete="per_alfanumerico">
                @error('per_alfanumerico')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group col-md-3 mb-4">
                <select class="form-select form-control" name="per_subd_extension" id="per_subd_extension" required>
                  <option value="" disabled selected>-- Seleccione la extension del carnet --</option>
                  @foreach($extension as $ext)               
                    <option value="{{$ext->subd_id}}">{{$ext->subd_nombre}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-6 mb-4">
                <input id="per_telefono" type="number" class="form-control input-lg @error('per_telefono') is-invalid @enderror" 
                      name="per_telefono" value="{{ old('per_telefono') }}" placeholder="Celular con Whatsapp"
                      onKeyPress="if(this.value.length==10) return false;" required>
                @error('per_telefono')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <!--div class="form-group col-md-6 mb-4">
                <input type="number" class="form-control input-lg" id="materno" aria-describedby="maternoHelp" placeholder="Telefono">
              </div-->

              <div class="form-group col-md-12 mb-4">
                <input id="email" type="email" class="form-control input-lg @error('email') is-invalid @enderror" 
                      name="email" value="{{ old('email') }}" placeholder="Correo personal" 
                      onKeyPress="if(this.value.length==50) return false;"
                      required autocomplete="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="form-group col-md-12 ">
                <input id="password" type="password" class="form-control input-lg @error('password') is-invalid @enderror" 
                name="password" placeholder="Contraseña" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="form-group col-md-12 ">
                <input id="password-confirm" type="password" class="form-control" 
                name="password_confirmation" placeholder="Confirmar Contraseña" required autocomplete="new-password">
              </div>

              <div class="col-md-12">
                <button type="submit" class="btn btn-lg btn-primary btn-block mb-4">Incribirse</button>
                <p>Ya tienes una cuenta?
                  <a class="text-blue" href="login_">Volver</a>
                </p>
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
@extends('ebid-views-login.componentes.script')