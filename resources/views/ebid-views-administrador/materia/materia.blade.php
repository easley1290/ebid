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
                    <!-- Recent Order Table -->
                    <div class="card card-table-border-none" id="recent-orders">
                      <div class="card-header justify-content-between">
                        <h2>Tabla de Materias</h2>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Crear Materia
                        </button>
                      </div>
                      <div class="card-body pt-0 pb-5">
                        <table id="materiass" class="table card-table table-responsive table-responsive-large" style="width:100%">
                          <thead>
                            <tr>
                              <th>Código</th>
                              <th>Nombre</th>
                              <th>Descripción</th>
                              <th style="display:none">mat_subd_estado</th>
                              <th>Acciones</th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach($aux[0] as $materia)
                            <tr>
                                <td class="">{{ $materia->mat_id}}</td>
                                <td class="">{{ $materia->mat_nombre}}</td>
                                <td class="">{{ $materia->mat_descripcion}}</td>
                                <td class="" style="display:none">{{ $materia->mat_subd_estado}}</td>
                                <td><a href="#" class="btn btn-info edit" >Editar</a>
                                    <a href="#" class="btn btn-danger text-white delete">Eliminar</a>
                                </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                   <!-- Prueba <div>
                    @foreach($aux[1] as $dominio)
                      <h1>{{$dominio->subd_dom_id}}</h1>
                    @endforeach
                    </div> end Prueba-->
            </div>
     
            <!-- Modal crear-->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Creación de Materias</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="{{ route('Materia.store') }}" method="POST"> <!-- {{route('Dominio.store')}} -->
                  {{ csrf_field() }}
                  <div class="modal-body">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Código de la materia</label>
                        <input name="mat_id" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nombre de la materia</label>
                        <input name="mat_nombre" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Descripción del la materia</label>
                        <input name="mat_descripcion" type="text" class="form-control" id="exampleInputPassword1">
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Estado</label>
                        <select class="form-select" aria-label="Default select example" name="mat_subd_estado" id="mat_subd_estado1">
                        @foreach($aux[1] as $subdominio)               
                          <option value="{{$subdominio->subd_id}}">{{$subdominio->subd_nombre}}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                      </div>
                    </div>
                    </form>
                </div>
              </div>
            </div>

            <!-- Modal editar-->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Materia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="/Materia" method="POST" id="editForm"> <!-- {{route('Dominio.store')}} -->
                  {{ csrf_field() }}
                  {{ method_field('PUT') }}
                  <div class="modal-body">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nombre de la materia</label>
                        <input name="mat_id" id="mat_id" type="text" class="form-control" aria-describedby="emailHelp">
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nombre de la materia</label>
                        <input name="mat_nombre" id="mat_nombre" type="text" class="form-control" aria-describedby="emailHelp">
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Descripción</label>
                        <input name="mat_descripcion" id="mat_descripcion" type="text" class="form-control">
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Estado</label>
                        <select class="form-select" aria-label="Default select example" name="mat_subd_estado" id="mat_subd_estado" required>
                          @foreach($aux[1] as $subdominio)               
                            <option value="{{$subdominio->subd_id}}">{{$subdominio->subd_nombre}}</option>
                          @endforeach
                        </select>
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
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar materia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="/Materia" method="POST" id="deleteForm"> <!-- {{route('Dominio.store')}} -->
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <div class="modal-body">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Esta seguro de elimiar la materia?</label>
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
  $('#materiass').DataTable({
        "lengthMenu":[[5, 10, 50, -1], [5, 10, 50, "All"]]
    });
} );
</script>
<!-- editar -->
<script type="text/javascript">
$(document).ready(function(){
  var table = $('#materiass').DataTable();
  table.on('click', '.edit', function(){
    $tr = $(this).closest('tr');
    if ($($tr).hasClass('child')) {
      $tr = $tr.prev('.parent');
    }
    var data = table.row($tr).data();
    console.log(data);
    $('#mat_id').val(data[1]);
    $('#mat_nombre').val(data[1]);
    $('#mat_descripcion').val(data[2]);
    $('#mat_subd_estado').val(data[3]);

    $('#editForm').attr('action', '/Materia/'+data[0]);
    $('#editModal').modal('show');
  })
});
</script>
<!-- eliminar -->
<script type="text/javascript">
$(document).ready(function(){
  var table = $('#materiass').DataTable();
  table.on('click', '.delete', function(){
    $tr = $(this).closest('tr');
    if ($($tr).hasClass('child')) {
      $tr = $tr.prev('.parent');
    }
    var data = table.row($tr).data();

    $('#deleteForm').attr('action', '/Materia/'+data[0]);
    $('#deleteModal').modal('show');
  })
});
</script>

          
@endsection