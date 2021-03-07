@extends('ebid-views-login.componentes.link')

<body class="" id="body">
  <div class="container d-flex flex-column justify-content-between vh-100">
  <div class="row justify-content-center mt-5">
    <div class="col-md-10">
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
          <h4 class="text-dark mb-5">Llene los siguientes datos</h4>
          <form action="api/auth/register " method="POST">
            <div class="row">
              <div class="form-group col-md-12 mb-4">
                <input type="text" class="form-control input-lg" id="name" name="name" aria-describedby="nameHelp" placeholder="Nombres">
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
              </div>
              <div class="form-group col-md-5 mb-4">
                <input type="text" class="form-control input-lg" id="materno" aria-describedby="maternoHelp" placeholder="Numero de documento">
              </div>
              <div class="form-group col-md-3 mb-4">
                <input type="text" class="form-control input-lg" id="materno" aria-describedby="maternoHelp" placeholder="Extensión">
              </div>
              <div class="form-group col-md-6 mb-4">
                <input type="number" class="form-control input-lg" id="materno" aria-describedby="maternoHelp" placeholder="Celular">
              </div>
              <div class="form-group col-md-6 mb-4">
                <input type="number" class="form-control input-lg" id="materno" aria-describedby="maternoHelp" placeholder="Telefono">
              </div-->
              <div class="form-group col-md-12 mb-4">
                <input type="email" class="form-control input-lg" id="email" name="email" aria-describedby="emailHelp" placeholder="Correo">
              </div>
              <div class="form-group col-md-12 ">
                <input type="password" class="form-control input-lg" id="password" name="password" placeholder="Contraseña">
              </div>
              <div class="form-group col-md-12 ">
                <input type="password" class="form-control input-lg" id="password_confirmation" name="password_confirmation" placeholder="Confirmar contraseña">
              </div>
              <div class="col-md-12">
                
                <button type="submit" class="btn btn-lg btn-primary btn-block mb-4">Incribirse</button>
                <p>Ya tienes una cuenta?
                  <a class="text-blue" href="registro">Volver</a>
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