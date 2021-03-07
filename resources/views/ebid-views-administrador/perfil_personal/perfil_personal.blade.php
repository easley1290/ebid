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
                        <h2>Tabla de Personas</h2>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Crear Persona
                        </button>
                      </div>
                      <div class="card-body pt-0 pb-5">
                        <table id="personas" class="table card-table table-responsive table-responsive-large" style="width:100%">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Nombre Completo</th>
                              <th>Correo</th>
                              <th>Tipo Doc.</th>
                              <th>Numero Doc</th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach($personas as $persona)
                            <tr>
                                <td class="">{{ $persona->per_id}}</td>
                                <td class="">{{ $persona->per_nombres}}
                                             {{ $persona->per_paterno}}
                                             {{ $persona->per_materno}}
                                </td>
                                <td class="">{{ $persona->per_correo_personal}}</td>
                                
                                @foreach($tipo_doc as $subdominio)
                                    @if($subdominio->subd_id == $persona->per_subd_documentacion)
                                    <td class="">{{ $subdominio->subd_nombre}}</td>
                                    @endif
                                @endforeach
                                </td>
                                <td class="">{{ $persona->per_num_documentacion}}
                                @foreach($extension as $subdominio)
                                    @if($subdominio->subd_id == $persona->per_subd_extension)
                                    {{ $subdominio->subd_nombre}}
                                    @endif
                                @endforeach
                                </td>
                                <td><a href="#" class="btn btn-info edit" >Editar</a>
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
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Creación de Personas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="{{ route('Personas.store') }}" method="POST">
                  {{ csrf_field() }}
                  <div class="modal-body">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nombres</label>
                        <input name="nombres" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Ap. Paterno</label>
                        <input name="paterno" type="text" class="form-control" id="exampleInputPassword1" required>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Ap.Materno</label>
                        <input name="materno" type="text" class="form-control" id="exampleInputPassword1" required>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Género</label>
                        <select class="form-select" aria-label="Default select example" name="genero" required>
                        @foreach($genero as $genero)               
                          <option value="{{$genero->subd_id}}">{{$genero->subd_nombre}}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Fecha Naciminento</label>
                        <input name="fec_nac" type="date" class="form-control" id="exampleInputPassword1" required>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Tipo Documento</label>
                        <select class="form-select" aria-label="Default select example" name="tipo_doc" required>
                        @foreach($tipo_doc as $tipo_doc)               
                          <option value="{{$tipo_doc->subd_id}}">{{$tipo_doc->subd_nombre}}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Numero Documento</label>
                        <input name="num_doc" type="number" class="form-control" id="exampleInputPassword1" required>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Extensión</label>
                        <select class="form-select" aria-label="Default select example" name="extension" required>
                        @foreach($extension as $extension)               
                          <option value="{{$extension->subd_id}}">{{$extension->subd_nombre}}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Telefono</label>
                        <input name="telefono" type="number" class="form-control" id="exampleInputPassword1">
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Correo Personal</label>
                        <input name="correo" type="email" class="form-control" id="exampleInputPassword1" required>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Domicilio</label>
                        <input name="domicilio" type="text" class="form-control" id="exampleInputPassword1">
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Enviar</button>
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
                  <form action="/Personas" method="POST" id="deleteForm">
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
  
      $('#deleteForm').attr('action', '/Personas/'+data[0]);
      $('#deleteModal').modal('show');
    })
  });
</script>
@endsection