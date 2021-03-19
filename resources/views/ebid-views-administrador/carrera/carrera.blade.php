@extends('ebid-views-administrador.componentes.main')
@section('contenido')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
                  <!-- Top Statistics -->
            <br>
            @if (session('status'))
                <div class="alert alert-success"> 
                    {{ session('status') }}
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
            <div class="container">
              <div class="row">
                <div class="col-12">
                  <div class="row">
                      <div class="col-md-12">
                          <div class="card text-white mb-3 bg-primary">
                              <div class="card-header bg-primary" style="font-size: 30px;">PORTAL WEB - ADMINISTRACION DE CARRERAS</div>
                          </div>
                      </div>
                  </div>          
                    <!-- Recent Order Table -->
                    <div class="card card-table-border-none" id="recent-orders">
                      <div class="card-header">
                          <div class="col-md-9"><h4 class="row">Listado de las carreras existentes en la Intitución</h4></div>
                          <div class="col-md-3"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                              <span class="mdi mdi-comment-plus"></span>&nbsp;Crear nueva carrera
                          </button></div>
                      </div>
                      <div class="card-body pt-0 pb-5">
                        <table id="carreras" class="table card-table table-responsive table-responsive-large" style="width:100%">
                          <thead>
                            <tr>
                              <th style="display:none">ID</th>
                              <th>Unidad</th>
                              <th>Nombre</th>
                              <th>Descripción</th>
                              <th>Fecha de creación</th>
                              <th style="display:none">car_subd_estado</th>
                              <th style="width:200px">Acciones</th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach($aux[0] as $carrera)
                            <tr>
                                <td class="" style="display:none">{{ $carrera->car_id}}</td>
                                <td class="">{{ $carrera->car_ua_id}}</td>
                                <td class="">{{ $carrera->car_nombre}}</td>
                                <td class="">{{ $carrera->car_descripcion}}</td>
                                <td class="">{{ $carrera->car_fecha_creacion}}</td>
                                <td class="" style="display:none">{{ $carrera->car_subd_estado}}</td>
                                <td style="width:200px">
                                  <button class="btn btn-success edit">
                                    <span class="mdi mdi-circle-edit-outline"></span>&nbsp;Modificar</button>
                                  <button class="btn btn-danger delete">
                                    <span class="mdi mdi-circle-edit-outline"></span>&nbsp;Eliminar</button>
                                </td>
                            </tr>
                          @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  
            </div>
     
            <!-- Modal crear-->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Creación de carreras</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="{{ route('Carrera.store') }}" method="POST">
                  {{ csrf_field() }}
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-3">
                        <label for="exampleInputEmail1" class="form-label">Código de la carrera</label>
                        <input name="car_id" type="text" class="form-control" id="exampleInputEmail12" aria-describedby="emailHelp" required>
                      </div>
                      <div class="col-md-5">
                        <label for="exampleInputEmail1" class="form-label">Nombre</label>
                        <input name="car_nombre" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                      </div>
                      <div class="col-md-4">
                        <label for="exampleInputPassword1" class="form-label">Unidad Perteneciente</label>
                        <select class="form-select" aria-label="Default select example" name="car_ua_id" required>
                        @foreach($aux[1] as $ua)               
                          <option value="{{$ua->ua_id}}">{{$ua->ua_nombre}}</option> 
                        @endforeach
                        </select> 
                      </div>          
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <label for="exampleInputPassword1" class="form-label">Descripción</label>
                        <input name="car_descripcion" type="text" class="form-control" id="exampleInputPassword2" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <label for="exampleInputPassword1" class="form-label">Fecha de creación</label>
                        <input name="car_fecha_creacion" type="date" class="form-control" id="exampleInputPassword3" required>
                      </div>
                      <div class="col-md-4">
                        <label for="exampleInputPassword1" class="form-label">Estado</label>
                        <select class="form-select" aria-label="Default select example" name="car_subd_estado" required>
                        @foreach($aux[2] as $estado)               
                          <option value="{{$estado->subd_id}}">{{$estado->subd_nombre}}</option>
                        @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Crear</button>
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                  </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- Modal editar -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edición de Carrera</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="Carrera" method="POST" id="editForm">
                  {{ csrf_field() }}
                  {{ method_field('PUT') }}
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-3">
                        <label for="exampleInputEmail1" class="form-label">Código de la carrera</label>
                        <input name="car_id" type="text" class="form-control" id="car_id" aria-describedby="emailHelp" required>
                      </div>
                      <div class="col-md-5">
                        <label for="exampleInputEmail1" class="form-label">Nombre</label>
                        <input name="car_nombre" type="text" class="form-control" id="car_nombre" aria-describedby="emailHelp" required>
                      </div>
                      <div class="col-md-4">
                        <label for="exampleInputPassword1" class="form-label">Unidad Perteneciente</label>
                        <select class="form-select" aria-label="Default select example" name="car_ua_id" id="car_ua_id"required>
                        @foreach($aux[1] as $ua)               
                          <option value="{{$ua->ua_id}}">{{$ua->ua_nombre}}</option> 
                        @endforeach
                        </select>   
                      </div>       
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <label for="exampleInputPassword1" class="form-label">Descripcion</label>
                        <input name="car_descripcion" type="text" class="form-control" id="car_descripcion" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Fecha de creación</label>
                        <input name="car_fecha_creacion" type="date" class="form-control" id="car_fecha_creacion" required>
                      </div>
                      <div class="col-md-6">
                      <label for="exampleInputPassword1" class="form-label">Estado</label>
                        <select class="form-select" aria-label="Default select example" name="car_subd_estado" id="car_subd_estado" required>
                        @foreach($aux[2] as $estado)               
                          <option value="{{$estado->subd_id}}">{{$estado->subd_nombre}}</option> 
                        @endforeach
                        </select>   
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
            <!-- Modal eliminar-->
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Carrera</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="/Carrera" method="POST" id="deleteForm">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <div class="modal-body">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Esta seguro de eliminar la Carrera?</label>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Borrar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                      </div>
                    </div>
                    </form>
                </div>
              </div>
            </div>

            


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<script>
$(document).ready(function() {
  $('#carreras').DataTable({
        "lengthMenu":[[10,25, 50, -1], [10,25, 50, "All"]]
    });
} );
</script>

<!-- editar -->
<script type="text/javascript">
$(document).ready(function(){
  var table = $('#carreras').DataTable();
  table.on('click', '.edit', function(){
    $tr = $(this).closest('tr');
    if ($($tr).hasClass('child')) {
      $tr = $tr.prev('.parent');
    }
    var data = table.row($tr).data();
    console.log(data);
    $('#car_id').val(data[0]);
    $('#car_ua_id').val(data[1]);
    $('#car_nombre').val(data[2]);
    $('#car_descripcion').val(data[3]);
    $('#car_fecha_creacion').val(data[4]);
    $('#car_subd_estado').val(data[5]);

    $('#editForm').attr('action', 'Carrera/'+data[0]);
    $('#editModal').modal('show');
  })
});
</script>
          
<!-- eliminar -->
<script type="text/javascript">
  $(document).ready(function(){
    var table = $('#carreras').DataTable();
    table.on('click', '.delete', function(){
      $tr = $(this).closest('tr');
      if ($($tr).hasClass('child')) {
        $tr = $tr.prev('.parent');
      }
      var data = table.row($tr).data();
  
      $('#deleteForm').attr('action', 'Carrera/'+data[0]);
      $('#deleteModal').modal('show');
    })
  });
</script>

@endsection