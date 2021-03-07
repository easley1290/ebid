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
          <form action="api/auth/login  " method="POST">
            <div class="row">
              <div class="form-group col-md-12 mb-4">
                <input type="email" class="form-control input-lg" id="email" name="email" aria-describedby="emailHelp" placeholder="ejemplo@usuario.com">
              </div>
              <div class="form-group col-md-12 ">
                <input type="password" class="form-control input-lg" id="password" name="password" placeholder="Contraseña">
              </div>
              <div class="col-md-12">
                <div class="d-flex my-2 justify-content-between">
                  <div class="d-inline-block mr-3">
                    <label class="control control-checkbox">Recordarme
                      <input type="checkbox" />
                      <div class="control-indicator"></div>
                    </label>

                  </div>
                  <p><a class="text-blue" href="#">Olvidaste tu contraseña?</a></p>
                </div>
                <button type="submit" class="btn btn-lg btn-primary btn-block mb-4">Acceder</button>
                <p>No tienes una cuenta aun?
                  <a class="text-blue" href="formulario">Inscribirse</a>
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