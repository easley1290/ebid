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
                                <div class="card-header bg-primary" style="font-size: 30px;">PORTAL WEB - ASIGNACIÓN DE DOCENTES POR MATERIA</div>
                            </div>
                        </div>
                    </div>             
                      <!-- Recent Order Table -->
                    <div class="card card-table-border-none" id="recent-orders">
                      <div class="card-header">
                            <div class="col-md-9"><h4 class="row">Listado de los docentes asignados a las materias de la Intitución</h4></div>
                            <div class="col-md-3"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <span class="mdi mdi-comment-plus"></span>&nbsp;Agregar asignación Docente
                            </button></div>
                        </div>
                      <div class="card-body pt-0 pb-5">
                        <table id="materiadocentes" class="table card-table table-responsive table-responsive-large" style="width:100%">
                          <thead>
                            <tr>
                              <th style="display:none">ID</th>
                              <th>Nombre</th>
                              <th style="display:none">matd_doc_id</th>
                              <th>Materia</th>
                              <th style="display:none">matd_mat_id</th>
                              <th style="display:none">matd_subd_estado</th>
                              <th style="width:200px">Acciones</th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach($aux[0] as $materiadocente)
                            <tr>
                                <td class="" style="display:none">{{ $materiadocente->matd_id}}</td>
                                @foreach($aux[1] as $docente)
                                  @if($materiadocente->matd_doc_id === $docente->doc_id)
                                    @foreach($aux[2] as $persona)
                                      @if($docente->doc_per_id === $persona->per_id)
                                        <td class="">{{ $persona->name}}</td>
                                      @endif
                                    @endforeach
                                  @endif
                                @endforeach
                                <td class="" style="display:none">{{ $materiadocente->matd_doc_id}}</td>
                                @foreach($aux[3] as $materia)
                                  @if($materiadocente->matd_mat_id === $materia->mat_id)
                                  <td class="">{{ $materia->mat_nombre}}</td>
                                  @endif
                                @endforeach
                                <td class="" style="display:none">{{ $materiadocente->matd_mat_id}}</td>
                                <td class="" style="display:none">{{ $materiadocente->matd_subd_estado}}</td>
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
                    <h5 class="modal-title" id="exampleModalLabel">Creación de Docentes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="{{ route('MateriaDocente.store') }}" method="POST"> <!-- {{route('Dominio.store')}} -->
                  {{ csrf_field() }}
                  <div class="modal-body">
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nombre del Docente</label>
                        <select class="form-select" aria-label="Default select example" name="matd_doc_id" id="mat_subd_estado12">
                        @foreach($aux[2] as $persona)  
                          @foreach($aux[1] as $docente)             
                            @if($persona->per_id === $docente->doc_per_id)
                            <option value="{{$docente->doc_id}}">{{$persona->name}}</option>
                            @endif
                          @endforeach
                        @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nombre de la materia</label>
                        <select class="form-select" aria-label="Default select example" name="matd_mat_id" id="mat_subd_estado13">
                        @foreach($aux[3] as $materia)               
                          <option value="{{$materia->mat_id}}">{{$materia->mat_nombre}}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Estado</label>
                        <select class="form-select" aria-label="Default select example" name="matd_subd_estado" id="mat_subd_estado1">
                        @foreach($aux[4] as $subdominio)               
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
                    <h5 class="modal-title" id="exampleModalLabel">Editar asignación del Docente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="/MateriaDocente" method="POST" id="editForm"> <!-- {{route('Dominio.store')}} -->
                  {{ csrf_field() }}
                  {{ method_field('PUT') }}
                  <div class="modal-body">
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nombre del Docente</label>
                        <select class="form-select" aria-label="Default select example" name="matd_doc_id" id="matd_doc_id">
                        @foreach($aux[2] as $persona)  
                          @foreach($aux[1] as $docente)             
                            @if($persona->per_id === $docente->doc_per_id)
                            <option value="{{$docente->doc_id}}">{{$persona->name}}</option>
                            @endif
                          @endforeach
                        @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nombre de la materia</label>
                        <select class="form-select" aria-label="Default select example" name="matd_mat_id" id="matd_mat_id">
                        @foreach($aux[3] as $materia)               
                          <option value="{{$materia->mat_id}}">{{$materia->mat_nombre}}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Estado</label>
                        <select class="form-select" aria-label="Default select example" name="matd_subd_estado" id="matd_subd_estado">
                        @foreach($aux[4] as $subdominio)               
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
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Docente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="/MateriaDocente" method="POST" id="deleteForm"> <!-- {{route('Dominio.store')}} -->
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <div class="modal-body">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Esta seguro de elimiar al docente de la materia?</label>
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
  $('#materiadocentes').DataTable({
        "lengthMenu":[[5, 10, 50, -1], [5, 10, 50, "All"]]
    });
} );
</script>
<!-- editar -->
<script type="text/javascript">
$(document).ready(function(){
  var table = $('#materiadocentes').DataTable();
  table.on('click', '.edit', function(){
    $tr = $(this).closest('tr');
    if ($($tr).hasClass('child')) {
      $tr = $tr.prev('.parent');
    }
    var data = table.row($tr).data();
    console.log(data);
    $('#matd_doc_id').val(data[2]);
    $('#matd_mat_id').val(data[4]);
    $('#matd_subd_estado').val(data[5]);


    $('#editForm').attr('action', '/MateriaDocente/'+data[0]);
    $('#editModal').modal('show');
  })
});
</script>
<!-- eliminar -->
<script type="text/javascript">
$(document).ready(function(){
  var table = $('#materiadocentes').DataTable();
  table.on('click', '.delete', function(){
    $tr = $(this).closest('tr');
    if ($($tr).hasClass('child')) {
      $tr = $tr.prev('.parent');
    }
    var data = table.row($tr).data();

    $('#deleteForm').attr('action', '/MateriaDocente/'+data[0]);
    $('#deleteModal').modal('show');
  })
});
</script>

          
@endsection