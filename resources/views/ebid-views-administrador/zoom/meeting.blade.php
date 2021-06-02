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
                                <div class="card-header bg-primary" style="font-size: 30px;">PORTAL WEB - ADMINISTRACION DE REUNIONES</div>
                            </div>
                        </div>
                    </div>             
                    <!-- Recent Order Table -->
                    <div class="card card-table-border-none" id="recent-orders">
                    <div class="card-header">
                          <div class="col-md-9"><h4 class="row">Listado de las reuniones generadas en Zoom</h4></div>
                          <div class="col-md-3"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                              <span class="mdi mdi-comment-plus"></span>&nbsp;Agregar una reunión
                          </button></div>
                      </div>
                      <div class="card-body pt-0 pb-5">
                        <table id="personas" class="table card-table table-responsive table-responsive-large" style="width:100%">
                          <thead>
                            <tr>
                              <th style="display:none">ID</th>
                              <th>Tema</th>
                              <th>Materia</th>
                              <th>Fecha y Hora </th>
                              <th style="display:none">Hora Inicio</th>
                              <th>Link de Reunión</th>
                              <th style="width:200px">Acciones</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($aux[1] as $reunion)
                            <tr>
                                <td class="" style="display:none">{{$reunion['id']}}</td>
                                <td class="">{{$reunion['topic']}}</td>
                                <td class="">{{$reunion['agenda']}}</td>
                                <td class="">{{date("d/m/Y H:i", strtotime($reunion['start_time']))}}</td>
                                <td class="" style="display:none">{{date("Y-m-d\TH:i", strtotime($reunion['start_time']))}}</td>
                                <td class="">{{$reunion['join_url']}}</td>
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
                    <h5 class="modal-title" id="exampleModalLabel">Creación una reunión</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div> 
                  <form action="{{ route('createZoom') }}" method="POST">
                  {{ csrf_field() }}
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-12">
                        <label for="exampleInputEmail1" class="form-label">Tema</label>
                        <input name="topic" type="text" class="form-control" id="topic" aria-describedby="emailHelp" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <label for="exampleInputEmail1" class="form-label">Materia</label>
                        <input name="agenda" type="text" class="form-control" id="agenda" aria-describedby="emailHelp" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Fecha y Hora</label>
                        <input name="start_time" type="datetime-local" class="form-control" id="start_time" required>
                      </div>
                    </div>
                    &nbsp;
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
                    <h5 class="modal-title" id="exampleModalLabel">Edición de reunión</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="updateZoom" method="POST" id="editForm">
                  {{ csrf_field() }}
                  {{ method_field('PATCH') }}
                  <div class="modal-body">
                    <div class="row">
                      <input id="id" name="id" type="hidden">
                      <div class="col-md-12">
                        <label for="exampleInputEmail1" class="form-label">Tema</label>
                        <input name="topic_" type="text" class="form-control" id="topic_" aria-describedby="emailHelp" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <label for="exampleInputEmail1" class="form-label">Materia</label>
                        <input name="agenda_" type="text" class="form-control" id="agenda_" aria-describedby="emailHelp" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Fecha y Hora</label>
                        <input name="start_time_" type="datetime-local" class="form-control" id="start_time_" required>
                      </div>
                    </div>
                    &nbsp;
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Modificar</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Reunión</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="/Persona" method="POST" id="deleteForm">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <div class="modal-body">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Esta seguro de eliminar la reunión?</label>
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
    $('#topic_').val(data[1]);
    $('#agenda_').val(data[2]);
    $('#start_time_').val(data[4]);

    $('#editForm').attr('action', 'meetings/'+data[0]);
    $('#editModal').modal('show');
  })
});
</script>
          
<!-- eliminar -->
<script type="text/javascript">
  $(document).ready(function(){
    var table = $('#personas').DataTable();
    table.on('click', '.delete', function(){
      $tr = $(this).closest('tr');
      if ($($tr).hasClass('child')) {
        $tr = $tr.prev('.parent');
      }
      var data = table.row($tr).data();
  
      $('#deleteForm').attr('action', 'meetings/'+data[0]);
      $('#deleteModal').modal('show');
    })
  });
</script> 

@endsection