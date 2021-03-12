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
                        <h2>Tabla de Instituciones</h2>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Crear institución
                        </button>
                      </div>
                      <div class="card-body pt-0 pb-5">
                        <table id="institucions" class="table card-table table-responsive table-responsive-large" style="width:100%">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Nombre</th>
                              <th>Misión</th>
                              <th>Visión</th>
                              <th>Objetivo general</th>
                              <th style="display:none">objetivo_especifico_1</th>
                              <th style="display:none">objetivo_especifico_2</th>
                              <th style="display:none">objetivo_especifico_3</th>
                              <th>Acciones</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($instituciones as $institucion)
                            <tr>
                                <td class="">{{ $institucion->ins_id }}</td>
                                <td class="">{{ $institucion->ins_nombre }}</td>
                                <td class="">{{ $institucion->ins_mision }}</td>
                                <td class="">{{ $institucion->ins_vision }}</td>
                                <td class="">{{ $institucion->ins_obj }}</td>
                                <td class="" style="display:none">{{ $institucion->ins_obj_esp1 }}</td>
                                <td class="" style="display:none">{{ $institucion->ins_obj_esp2}}</td>
                                <td class="" style="display:none">{{ $institucion->ins_obj_esp3}}</td>
                                <td width="50px"><a href="#" class="btn btn-info edit" >Editar</a>
                                    <a href="#" class="btn btn-danger text-white delete">Eliminar</a>
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
                    <h5 class="modal-title" id="exampleModalLabel">Creación de la institución</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="{{ route('Institucion.store') }}" method="POST"> <!-- {{route('Dominio.store')}} -->
                  {{ csrf_field() }}
                  <div class="modal-body">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nombre de la institución</label>
                        <input name="ins_nombre" id="ins_nombre1" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <label for="exampleInputPassword1" class="form-label">Misón</label>
                          <textarea name="ins_mision" id="ins_mision1" cols="30" rows="4" class="form-control"></textarea>
                        </div>
                        <div class="col-md-6">
                          <label for="exampleInputPassword1" class="form-label">Visón</label>
                          <textarea name="ins_vision" id="ins_vision1" cols="30" rows="4" class="form-control"></textarea>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Objetivo general de la institución</label>
                        <input name="ins_obj" type="text" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp" required>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">1er objetivo especifico de la institución</label>
                        <input name="ins_obj_esp1" type="text" class="form-control" id="exampleInputEmail3" aria-describedby="emailHelp" required>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">2do objetivo especifico de la institución</label>
                        <input name="ins_obj_esp2" type="text" class="form-control" id="exampleInputEmail9" aria-describedby="emailHelp" required>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">3er objetivo especifico de la institución</label>
                        <input name="ins_obj_esp3" type="text" class="form-control" id="exampleInputEmail4" aria-describedby="emailHelp" required>
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

            <!-- Modal editar-->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Creación del Dominio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="/Institucion" method="POST" id="editForm"> <!-- {{route('Dominio.store')}} -->
                  {{ csrf_field() }}
                  {{ method_field('PUT') }}
                  <div class="modal-body">
                  <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nombre de la institución</label>
                        <input name="ins_nombre" id="ins_nombre" type="text" class="form-control" aria-describedby="emailHelp" required>
                      </div>
                        <div class="row">
                          <div class="col-md-6">
                            <label for="exampleInputPassword1" class="form-label">Misón</label>
                            <textarea name="ins_mision" id="ins_mision" cols="30" rows="4" class="form-control"></textarea>
                          </div>
                          <div class="col-md-6">
                            <label for="exampleInputPassword1" class="form-label">Visón</label>
                            <textarea name="ins_vision" id="ins_vision" cols="30" rows="4" class="form-control"></textarea>
                          </div>
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Objetivo general de la institución</label>
                          <input name="ins_obj" type="text" class="form-control" id="ins_obj" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">1er objetivo especifico de la institución</label>
                          <input name="ins_obj_esp1" type="text" class="form-control" id="ins_obj_esp1" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">2do objetivo especifico de la institución</label>
                          <input name="ins_obj_esp2" type="text" class="form-control" id="ins_obj_esp2" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">3er objetivo especifico de la institución</label>
                          <input name="ins_obj_esp3" type="text" class="form-control" id="ins_obj_esp3" aria-describedby="emailHelp">
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
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar la institución</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="/Institucion" method="POST" id="deleteForm"> <!-- {{route('Dominio.store')}} -->
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <div class="modal-body">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" id="ins_nombre_1" class="form-label">Esta seguro de elimiar la institución?</label>
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
  $('#institucions').DataTable({
        "lengthMenu":[[10, 25, 50, -1], [10, 25, 50, "All"]]
    });
} );
</script>

<!-- editar -->
<script type="text/javascript">
$(document).ready(function(){
  var table = $('#institucions').DataTable();
  table.on('click', '.edit', function(){
    $tr = $(this).closest('tr');
    if ($($tr).hasClass('child')) {
      $tr = $tr.prev('.parent');
    }
    var data = table.row($tr).data();
    console.log(data);
    $('#ins_nombre').val(data[1]);
    $('#ins_mision').val(data[2]);
    $('#ins_vision').val(data[3]);
    $('#ins_obj').val(data[4]);
    $('#ins_obj_esp1').val(data[5]);
    $('#ins_obj_esp2').val(data[6]);
    $('#ins_obj_esp3').val(data[7]);

    $('#editForm').attr('action', '/Institucion/'+data[0]);
    $('#editModal').modal('show');
  })
});
</script>

<script type="text/javascript">
$(document).ready(function(){
  var table = $('#institucions').DataTable();
  table.on('click', '.delete', function(){
    $tr = $(this).closest('tr');
    if ($($tr).hasClass('child')) {
      $tr = $tr.prev('.parent');
    }
    var data = table.row($tr).data();

    $('#deleteForm').attr('action', '/Institucion/'+data[0]);
    $('#deleteModal').modal('show');
  })
});
</script>

          
@endsection