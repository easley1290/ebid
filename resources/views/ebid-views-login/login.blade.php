@extends('ebid-views-login.componentes.link')

<body class="" id="body">
  <div class="container d-flex flex-column justify-content-between vh-100">
  <div class="row justify-content-center mt-5">
    <div class="col-xl-5 col-lg-6 col-md-10">
      <div class="card">
        <div class="card-header bg-primary">
          <div class="app-brand">
            <a href="/">
              <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="30" height="33"
                viewBox="0 0 30 33">
                <g fill="none" fill-rule="evenodd">
                  <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
                  <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                </g>
              </svg>
              <span class="brand-name">Acceso Ebid</span>
            </a>
          </div>
        </div>
        <div class="card-body p-5">

          <h4 class="text-dark mb-5">Acceder al Sistema</h4>
          

          <form method="POST" action="{{ route('login') }}">
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

            <div class="form-group row">
                <div class="form-group col-md-12">
                    <input id="password" type="password" class="form-control input-lg @error('password') is-invalid @enderror" 
                    name="password" required autocomplete="current-password"
                    placeholder="Contraseña">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>



            <div class="col-md-12">
              <div class="d-flex my-2 justify-content-between">
                
                
                <div class="d-inline-block mr-3">
                  <label class="control control-checkbox" for="remember">Recordarme
                    <input class="form-check-input" type="checkbox" name="remember" 
                        id="remember" {{ old('remember') ? 'checked' : '' }}>                
                    <div class="control-indicator"></div>
                  </label>
                </div>
                
                @if (Route::has('password.request'))
                      <a class="text-blue" href="{{ route('password.request') }}">
                        Olvidaste tu contraseña?
                      </a>
                @endif
              </div>
              <button type="submit" class="btn btn-lg btn-primary btn-block mb-4">Acceder</button>
              <p>Quieres ser miembro de Ebid?
                <a class="text-blue" href="register_">Inscribirse</a>
              </p>

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