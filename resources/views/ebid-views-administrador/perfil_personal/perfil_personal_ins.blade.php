@extends('ebid-views-administrador.componentes.main')
@section('contenido')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
                  <!-- Top Statistics -->
            <br>
            <div class="container">
              <div class="row">
                <div class="col-12">   
                  <div class="row">
                        <div class="col-md-12">
                            <div class="card text-white mb-3 bg-primary">
                                <div class="card-header bg-primary" style="font-size: 30px;">PORTAL WEB - ADMINISTRACION DE USUARIOS INSTITUCIONALES</div>
                            </div>
                        </div>
                    </div>           
                    <!-- Recent Order Table -->
                    <div class="card card-table-border-none" id="recent-orders">
                      
                      <div class="card-header">
                        <div class="col-md-10"><h4 class="row">Listado de las personas registradas en la Intitución</h4></div>
                      </div>

                      
                      <div class="card-body pt-0 pb-5">
                        <table id="personas" class="table card-table table-responsive table-responsive-large" style="width:100%">
                          <thead>
                            <tr>
                              <th style="display:none">ID</th>
                              <th>Nombre Completo</th>
                              <th style="display:none">nombre</th>
                              <th style="display:none">ap_pat</th>
                              <th style="display:none">ap_m</th>
                              <th>Codigo Institucional</th>
                              <th>Correo Institucional</th>
                              <th>Foto</th>
                              <th style="display:none">c</th>
                              <th>Acciones</th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach($personas as $persona)
                            <tr>
                                <td class="" style="display:none">{{ $persona->per_id}}</td>
                                <td class="" width="30%">{{ $persona->name}}</td>
                                <td class="" style="display:none">{{ $persona->per_nombres}}</td>
                                <td class="" style="display:none">{{ $persona->per_paterno}}</td>
                                <td class="" style="display:none">{{ $persona->per_materno}}</td>
                                <td class="" width="10%">{{ $persona->per_codigo_institucional}}</td>
                                <td class="" width="10%">{{ $persona->per_correo_institucional}}</td>
                                <td class="" width="15%"><img href="{{$persona->per_foto_personal}}" src="{{$persona->per_foto_personal}}" width="100%"></td>
                                <td class="" style="display:none">{{ $persona->per_contrasenia}}</td>
                                <td width="35%">
                                  <button class="btn btn-success edit">
                                    <span class="mdi mdi-circle-edit-outline"></span>&nbsp;Modificar</button>
                                  <button class="btn btn-info edit_con">
                                    <span class="mdi mdi-circle-edit-outline"></span>&nbsp;Contraseña</button>

                                    <!--a href="#" class="btn btn-info edit" >Editar</a>
                                    <a href="#" class="btn btn-success text-white edit_con">Cambiar Contraseña</a-->
                                </td>
                            </tr>
                          @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  
            </div>
     
            <!-- Modal editar -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edición de Datos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="/PersonaInstitucional" method="POST" id="editForm" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  {{ method_field('PUT') }}
                  <div class="modal-body">
                    <div class="row">
                      <input id="per_id" name="per_id" type="hidden">
                      <div class="col-md-4">
                        <label for="exampleInputEmail1" class="form-label">Nombres</label>
                        <input id="per_nombres" name="per_nombres" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required readonly="readonly">
                      </div>
                      <div class="col-md-4">
                        <label for="exampleInputPassword1" class="form-label">Ap. Paterno</label>
                        <input id="per_paterno" name="per_paterno" type="text" class="form-control" id="exampleInputPassword1" required readonly="readonly">
                      </div>
                      <div class="col-md-4">
                        <label for="exampleInputPassword1" class="form-label">Ap.Materno</label>
                        <input id="per_materno" name="per_materno" type="text" class="form-control" id="exampleInputPassword1" required readonly="readonly">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <label for="exampleInputPassword1" class="form-label">Codigo Institucional</label>
                        <input id="per_codigo_institucional" name="per_codigo_institucional" type="test" class="form-control" id="exampleInputPassword1" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <label for="exampleInputPassword1" class="form-label">Correo Institucional</label>
                        <input id="per_correo_institucional" name="per_correo_institucional" type="email" class="form-control" id="exampleInputPassword1" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Foto</label>
                        <input id="per_foto_personal" name="per_foto_personal" type="file" class="form-control">
                      </div>
                    </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                      </div>
                    </div>
                    </form> 
                </div>
              </div>
            </div>
            <!-- Modal editar contraseña-->
            <div class="modal fade" id="editconModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edición de Contraseña</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="/Contraseña" method="POST" id="editconForm">
                  {{ csrf_field() }}
                  {{ method_field('PUT') }}
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-12">
                        <label for="exampleInputPassword1" class="form-label">Contraseña Nueva</label>
                        <input id="contraseña_nueva" name="contraseña_nueva" type="password" class="form-control" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <label for="exampleInputPassword1" class="form-label">Repetir Contraseña</label>
                        <input id="contraseña_nueva1" name="contraseña_nueva1" type="password" class="form-control" required>
                      </div>
                    </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                      </div>
                    </div>
                    </form> 
                </div>
              </div>
            </div>

            <!-- Modal eliminar
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Persona</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="/Persona" method="POST" id="deleteForm">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <div class="modal-body">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Esta seguro de eliminar la persona?</label>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Borrar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                      </div>
                    </div>
                    </form>
                </div>
              </div>
            </div>-->

            


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<script>
$(document).ready(function() {
  $('#personas').DataTable({
        "lengthMenu":[[10,25, 50, -1], [10,25, 50, "All"]]
    });
} );
</script>

<!-- editar -->
<script type="text/javascript">
$(document).ready(function(){
  var table = $('#personas').DataTable();
  table.on('click', '.edit', function(){
    $tr = $(this).closest('tr');
    if ($($tr).hasClass('child')) {
      $tr = $tr.prev('.parent');
    }
    var data = table.row($tr).data();
    console.log(data);
    $('#per_nombres').val(data[2]);
    $('#per_paterno').val(data[3]);
    $('#per_materno').val(data[4]);
    $('#per_codigo_institucional').val(data[5]);
    $('#per_correo_institucional').val(data[6]);
    //$('#per_foto_personal').val(data[7]);

    $('#editForm').attr('action', '/PersonaInstitucional/'+data[0]);
    $('#editModal').modal('show');
  })
});
</script>

<!-- editar contraseña -->
<script type="text/javascript">
  $(document).ready(function(){
    var table = $('#personas').DataTable();
    table.on('click', '.edit_con', function(){
      $tr = $(this).closest('tr');
      if ($($tr).hasClass('child')) {
        $tr = $tr.prev('.parent');
      }
      var data = table.row($tr).data();
      console.log(data);
      //$('#contraseña_nueva').val(data[8]);
  
      $('#editconForm').attr('action', '/Contrasenia/'+data[0]);
      $('#editconModal').modal('show');
    })
  });
  </script>
          
<!-- eliminar 
<script type="text/javascript">
  $(document).ready(function(){
    var table = $('#personas').DataTable();
    table.on('click', '.delete', function(){
      $tr = $(this).closest('tr');
      if ($($tr).hasClass('child')) {
        $tr = $tr.prev('.parent');
      }
      var data = table.row($tr).data();
  
      $('#deleteForm').attr('action', '/Persona/'+data[0]);
      $('#deleteModal').modal('show');
    })
  });
</script>-->

@endsection