@extends('ebid-views-login.componentes.link')
@if (session('contrasena'))
        <div class="alert alert-success">
            {{ session('contrasena') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<body class="" id="body">
  <div class="container d-flex flex-column justify-content-between vh-100">
  <div class="row justify-content-center mt-5">
    <div class="col-xl-6 col-lg-6 col-md-10">
      <div class="card">
        <div class="card-header bg-purple">
          <div class="app-brand">
            <a href="/">
              <img src="{{ asset('assets/img/logo.png') }}" alt="" style="height: 70px" class="img-fluid">
              <span class="brand-name"><h3>LOGIN</h3></span>
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
                    name="email" value="{{ old('email') }}" required autocomplete="off" autofocus
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
               
                      <a class="text-blue" href="MailContrasena">
                        Olvidaste tu contraseña?
                      </a>
              </div>
              <button type="submit" class="btn btn-lg btn-purple btn-block mb-4">Acceder</button>
              <p>Quieres ser miembro de Ebid?
                <a class="text-purple" href="register_">Inscribirse</a>
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