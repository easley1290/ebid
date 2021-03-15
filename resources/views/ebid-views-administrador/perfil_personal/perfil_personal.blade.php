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
                                <div class="card-header bg-primary" style="font-size: 30px;">PORTAL WEB - ADMINISTRACION DE PERSONAS</div>
                            </div>
                        </div>
                    </div>             
                    <!-- Recent Order Table -->
                    <div class="card card-table-border-none" id="recent-orders">
                    <div class="card-header">
                          <div class="col-md-9"><h4 class="row">Listado de las personas registradas</h4></div>
                          <div class="col-md-3"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                              <span class="mdi mdi-comment-plus"></span>&nbsp;Agregar una persona
                          </button></div>
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
                              <th style="display:none">genero</th>
                              <th style="display:none">fecha_nac</th>
                              <th>Correo</th>
                              <th>Tipo Doc.</th>
                              <th style="display:none">per_subd_documentacion</th>
                              <th>Numero Doc</th>
                              <th style="display:none">per_num_documentacion</th>
                              <th style="display:none">per_subd_extension</th>
                              <th style="display:none">per_telefono</th>
                              <th style="display:none">per_domicilio</th>
                              <th style="width:200px">Acciones</th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach($personas as $persona)
                            <tr>
                                <td class="" style="display:none">{{ $persona->per_id}}</td>
                                <td class="">{{ $persona->name}}</td>
                                <td class="" style="display:none">{{ $persona->per_nombres}}</td>
                                <td class="" style="display:none">{{ $persona->per_paterno}}</td>
                                <td class="" style="display:none">{{ $persona->per_materno}}</td>
                                <td class="" style="display:none">{{ $persona->per_subd_genero}}</td>
                                <td class="" style="display:none">{{ $persona->per_fecha_nacimiento}}</td>
                                
                                <td class="">{{ $persona->email}}</td>
<<<<<<< HEAD
                                
                                @foreach($tipo_docs as $subdominio)
                                    @if($subdominio->subd_id === $persona->per_subd_documentacion)
                                    <td class="">{{ $subdominio->subd_nombre}}</td>
                                    @endif
                                @endforeach

                                <td class="">por definir 1</td>
=======
                                <td class="">
                                  @foreach($tipo_docs as $subdominio)
                                      @if($subdominio->subd_id === $persona->per_subd_documentacion)
                                      {{ $subdominio->subd_nombre}}
                                      @endif
                                  @endforeach
                                </td>
>>>>>>> 9ada9453bf2affb3233c1cbe6f0891c601f30c08
                                <td class="" style="display:none">{{ $persona->per_subd_documentacion}}</td>
                                <td class="">{{ $persona->per_num_documentacion}}
                                @foreach($extensions as $subdominio)
                                    @if($subdominio->subd_id === $persona->per_subd_extension)
                                    {{ $subdominio->subd_nombre}}
                                    @endif
                                @endforeach
                                </td>
                                <td class="" style="display:none">{{ $persona->per_num_documentacion}}</td>
                                <td class="" style="display:none">{{ $persona->per_subd_extension}}</td>
                                <td class="" style="display:none">{{ $persona->per_telefono}}</td>
                                <td class="" style="display:none">{{ $persona->per_domicilio}}</td>
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
                    <h5 class="modal-title" id="exampleModalLabel">Creación de Persona</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div> 
                  <form action="{{ route('Persona.store') }}" method="POST">
                  {{ csrf_field() }}
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-4">
                        <label for="exampleInputEmail1" class="form-label">Nombres</label>
                        <input name="nombres" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                      </div>
                      <div class="col-md-4">
                        <label for="exampleInputPassword1" class="form-label">Ap. Paterno</label>
                        <input name="paterno" type="text" class="form-control" id="exampleInputPassword1" required>
                      </div>
                      <div class="col-md-4">
                        <label for="exampleInputPassword1" class="form-label">Ap.Materno</label>
                        <input name="materno" type="text" class="form-control" id="exampleInputPassword12" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Género</label>
                        <select class="form-select" aria-label="Default select example" name="genero" required>
                        @foreach($generos as $genero)               
                          <option value="{{$genero->subd_id}}">{{$genero->subd_nombre}}</option> 
                        @endforeach
                        </select>
                      </div>
                      <div class="col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Fecha Naciminento</label>
                        <input name="fec_nac" type="date" class="form-control" id="exampleInputPassword13" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <label for="exampleInputPassword1" class="form-label">Tipo Documento</label>
                        <select class="form-select" aria-label="Default select example" name="tipo_doc" required>
                        @foreach($tipo_docs as $tipo_doc)               
                          <option value="{{$tipo_doc->subd_id}}">{{$tipo_doc->subd_nombre}}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="col-md-4">
                        <label for="exampleInputPassword1" class="form-label">Numero Documento</label>
                        <input name="num_doc" type="number" class="form-control" id="exampleInputPassword14" required>
                      </div>
                      <div class="col-md-4">
                        <label for="exampleInputPassword1" class="form-label">Extensión</label>
                        <select class="form-select" aria-label="Default select example" name="extension" required>
                        @foreach($extensions as $extension)               
                          <option value="{{$extension->subd_id}}">{{$extension->subd_nombre}}</option>
                        @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Telefono</label>
                        <input name="telefono" type="number" class="form-control" id="exampleInputPassword15">
                      </div>
                      <div class="col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Correo Personal</label>
                        <input name="correo" type="email" class="form-control" id="exampleInputPassword16" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <label for="exampleInputPassword1" class="form-label">Domicilio</label>
                        <input name="domicilio" type="text" class="form-control" id="exampleInputPassword17  ">
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
                    <h5 class="modal-title" id="exampleModalLabel">Edición de Persona</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="/Persona" method="POST" id="editForm">
                  {{ csrf_field() }}
                  {{ method_field('PUT') }}
                  <div class="modal-body">
                    <div class="row">
                      <input id="per_id" name="per_id" type="hidden">
                      <div class="col-md-4">
                        <label for="exampleInputEmail1" class="form-label">Nombres</label>
                        <input id="per_nombres" name="per_nombres" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                      </div>
                      <div class="col-md-4">
                        <label for="exampleInputPassword1" class="form-label">Ap. Paterno</label>
                        <input id="per_paterno" name="per_paterno" type="text" class="form-control" id="exampleInputPassword1" required>
                      </div>
                      <div class="col-md-4">
                        <label for="exampleInputPassword1" class="form-label">Ap.Materno</label>
                        <input id="per_materno" name="per_materno" type="text" class="form-control" id="exampleInputPassword1" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Género</label>
                        <select class="form-select" aria-label="Default select example" id="per_subd_genero" name="per_subd_genero" required>
                        @foreach($generos as $genero)               
                          <option value="{{$genero->subd_id}}">{{$genero->subd_nombre}}</option> 
                        @endforeach
                        </select>
                      </div>
                      <div class="col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Fecha Naciminento</label>
                        <input id="per_fecha_nacimiento" name="per_fecha_nacimiento" type="date" class="form-control" id="exampleInputPassword1" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <label for="exampleInputPassword1" class="form-label">Tipo Documento</label>
                        <select class="form-select" aria-label="Default select example" id="per_subd_documentacion" name="per_subd_documentacion" required>
                        @foreach($tipo_docs as $tipo_doc)               
                          <option value="{{$tipo_doc->subd_id}}">{{$tipo_doc->subd_nombre}}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="col-md-4">
                        <label for="exampleInputPassword1" class="form-label">Numero Documento</label>
                        <input id="per_num_documentacion" name="per_num_documentacion" type="number" class="form-control" id="exampleInputPassword1" required>
                      </div>
                      <div class="col-md-4">
                        <label for="exampleInputPassword1" class="form-label">Extensión</label>
                        <select class="form-select" aria-label="Default select example" id="per_subd_extension" name="per_subd_extension" required>
                        @foreach($extensions as $extension)               
                          <option value="{{$extension->subd_id}}">{{$extension->subd_nombre}}</option>
                        @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Telefono</label>
                        <input id="per_telefono" name="per_telefono" type="number" class="form-control" id="exampleInputPassword1">
                      </div>
                      <div class="col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Correo Personal</label>
                        <input id="per_correo_personal" name="per_correo_personal" type="email" class="form-control" id="exampleInputPassword1" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <label for="exampleInputPassword1" class="form-label">Domicilio</label>
                        <input id="per_domicilio" name="per_domicilio" type="text" class="form-control" id="exampleInputPassword1">
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
    $('#per_nombres').val(data[2]);
    $('#per_paterno').val(data[3]);
    $('#per_materno').val(data[4]);
    $('#per_subd_genero').val(data[5]);
    $('#per_fecha_nacimiento').val(data[6]);
    $('#per_subd_documentacion').val(data[9]);
    $('#per_num_documentacion').val(data[11]);
    $('#per_subd_extension').val(data[12]);
    $('#per_telefono').val(data[13]);
    $('#per_correo_personal').val(data[7]);
    $('#per_domicilio').val(data[14]);

    $('#editForm').attr('action', '/Persona/'+data[0]);
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
  
      $('#deleteForm').attr('action', '/Persona/'+data[0]);
      $('#deleteModal').modal('show');
    })
  });
</script>

@endsection