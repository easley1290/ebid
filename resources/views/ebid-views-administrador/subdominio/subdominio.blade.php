@extends('ebid-views-admin.componentes.main')
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
                        <h2>Tabla de Subdominios</h2>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Crear Subdominio
                        </button>
                      </div>
                      <div class="card-body pt-0 pb-5">
                        <table id="subdominios" class="table card-table table-responsive table-responsive-large" style="width:100%">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Nombre</th>
                              <th>Descripción</th>
                              <th>Dominio</th>
                              <th>Acciones</th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach($auxiliar[0] as $subdominio)
                            <tr>
                                <td class="">{{ $subdominio->subd_id}}</td>
                                <td class="">{{ $subdominio->subd_nombre}}</td>
                                <td class="">{{ $subdominio->subd_descrip}}</td>
                                @foreach($auxiliar[1] as $dominio)
                                  @if($dominio->dom_id === $subdominio->dom_id)
                                  <td class="">{{ $dominio->dom_nombre}}</td>
                                  @endif
                                @endforeach
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
                    @foreach($auxiliar[1] as $dominio)
                      <h1>{{$dominio->dom_id}}</h1>
                    @endforeach
                    </div> end Prueba-->
            </div>
     
            <!-- Modal crear-->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Creación del Dominio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="{{ route('Subdominio.store') }}" method="POST"> <!-- {{route('Dominio.store')}} -->
                  {{ csrf_field() }}
                  <div class="modal-body">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nombre del Subdominio</label>
                        <input name="subd_nombre" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Descripción</label>
                        <input name="subd_descrip" type="text" class="form-control" id="exampleInputPassword1">
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Dominio perteneciente</label>
                        <select class="form-select" aria-label="Default select example" name="dom_id">
                        @foreach($auxiliar[1] as $dominio)               
                          <option value="{{$dominio->dom_id}}">{{$dominio->dom_nombre}}</option>
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
                    <h5 class="modal-title" id="exampleModalLabel">Editar Subdominio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="/Subdominio" method="POST" id="editForm"> <!-- {{route('Dominio.store')}} -->
                  {{ csrf_field() }}
                  {{ method_field('PUT') }}
                  <div class="modal-body">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nombre del Subdominio</label>
                        <input name="subd_nombre" id="subd_nombre" type="text" class="form-control" aria-describedby="emailHelp">
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Descripción</label>
                        <input name="subd_descrip" id="subd_descrip" type="text" class="form-control">
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Dominio</label>
                        <select class="form-select" aria-label="Default select example" name="dom_id" id="dom_id">
                          @foreach($auxiliar[1] as $dominio)               
                            <option value="{{$dominio->dom_id}}">{{$dominio->dom_nombre}}</option>
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
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Dominio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="/Subdominio" method="POST" id="deleteForm"> <!-- {{route('Dominio.store')}} -->
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <div class="modal-body">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Esta seguro de elimiar el Subdominio?</label>
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
  $('#subdominios').DataTable({
        "lengthMenu":[[5, 10, 50, -1], [5, 10, 50, "All"]]
    });
} );
</script>
<!-- editar -->
<script type="text/javascript">
$(document).ready(function(){
  var table = $('#subdominios').DataTable();
  table.on('click', '.edit', function(){
    $tr = $(this).closest('tr');
    if ($($tr).hasClass('child')) {
      $tr = $tr.prev('.parent');
    }
    var data = table.row($tr).data();
    console.log(data);
    $('#subd_nombre').val(data[1]);
    $('#subd_descrip').val(data[2]);
    $('#dom_id').val(data[3]);

    $('#editForm').attr('action', '/Subdominio/'+data[0]);
    $('#editModal').modal('show');
  })
});
</script>
<!-- eliminar -->
<script type="text/javascript">
$(document).ready(function(){
  var table = $('#subdominios').DataTable();
  table.on('click', '.delete', function(){
    $tr = $(this).closest('tr');
    if ($($tr).hasClass('child')) {
      $tr = $tr.prev('.parent');
    }
    var data = table.row($tr).data();

    $('#deleteForm').attr('action', '/Subdominio/'+data[0]);
    $('#deleteModal').modal('show');
  })
});
</script>

          
@endsection