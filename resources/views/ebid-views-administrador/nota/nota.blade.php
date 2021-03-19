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
                                <div class="card-header bg-primary" style="font-size: 30px;">PORTAL WEB - ADMINISTRACIÓN DE NOTAS</div>
                            </div>
                        </div>
                    </div>                 
                    <!-- Recent Order Table -->
                    <div class="card card-table-border-none" id="recent-orders">
                      <div class="card-header">
                            <div class="col-md-9"><h4 class="row">Listado de notas de todos los estudiantes de la Intitución</h4></div>
                            <div class="col-md-3"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <span class="mdi mdi-comment-plus"></span>&nbsp;Agregar nueva nota
                            </button></div>
                        </div>
                      <div class="card-body pt-0 pb-5">
                      <table id="notas" class="table card-table table-responsive table-responsive-large" style="width:100%">
                          <thead>
                            <tr>
                              <th style="display:none">id_nota</th>
                              <th>Nombre del estudiante</th>
                              <th>Materia cursada</th>
                              <th style="display:none">nota_mat_id</th>
                              <th style="display:none">nota_practica1</th>
                              <th style="display:none">nota_examen1</th>
                              <th style="display:none">nota_practica2</th>
                              <th style="display:none">nota_examen2</th>
                              <th style="display:none">nota_practica3</th>
                              <th style="display:none">nota_examen3</th>
                              <th>Nota final</th>
                              <th style="width:200px">Acciones</th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach($aux[0] as $nota)
                            <tr>
                                <td class="" style="display:none">{{ $nota->nota_id}}</td>
                                @foreach($aux[1] as $materiaEst)
                                  @if($materiaEst->mate_id === $nota->nota_mate_id)
                                    @foreach($aux[3] as $estudiante)
                                      @if($estudiante->est_id === $materiaEst->mate_est_id)
                                        @foreach($aux[4] as $persona)
                                          @if($persona->per_id === $estudiante->est_per_id)
                                            <td class="">{{ $persona->name}}</td>
                                          @endif
                                        @endforeach
                                      @endif
                                    @endforeach
                                    @foreach($aux[2] as $materia)
                                      @if($materia->mat_id === $materiaEst->mate_mat_id)
                                        <td class="">{{ $materia->mat_nombre}}</td>
                                      @endif
                                    @endforeach
                                  @endif
                                @endforeach
                                <td class="" style="display:none">{{ $nota->nota_mate_id}}</td>
                                <td class="" style="display:none">{{ $nota->nota_practica1}}</td>
                                <td class="" style="display:none">{{ $nota->nota_examen1}}</td>
                                <td class="" style="display:none">{{ $nota->nota_practica2}}</td>
                                <td class="" style="display:none">{{ $nota->nota_examen2}}</td>
                                <td class="" style="display:none">{{ $nota->nota_practica3}}</td>
                                <td class="" style="display:none">{{ $nota->nota_examen3}}</td>
                                <td class="text-center">{{ $nota->nota_final}}</td>
                                <td style="width:200px">
                                  @if($nota->nota_practica1 == 0.10 || $nota->nota_examen1 == 0.10 ||$nota->nota_practica2 == 0.10
                                      || $nota->nota_examen2 == 0.10 || $nota->nota_practica3 == 0.10 || $nota->nota_examen3 == 0.10)
                                    <button class="btn btn-success edit">
                                      <span class="mdi mdi-circle-edit-outline"></span>&nbsp;Calificar</button>
                                  @endif
                                  <button class="btn btn-info delete">
                                    <span class="mdi mdi-eye"></span>&nbsp;Observar</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Creación de Nota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="{{ route('Nota.store') }}" method="POST"> <!-- {{route('Dominio.store')}} -->
                  {{ csrf_field() }}
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Nombre del estudiante</label>
                        <input name="per_paterno" type="text" class="form-control" required>
                      </div>
                      <div class="col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Nombre de la materia</label>
                        <input name="per_materno" type="text" class="form-control" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Nota practicas 1er pacial</label>
                        <input name="per_paterno" type="text" class="form-control" required>
                      </div>
                      <div class="col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Nota examen 1er parcial</label>
                        <input name="per_materno" type="text" class="form-control" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Nota practicas 2do pacial</label>
                        <input name="per_paterno" type="text" class="form-control" required>
                      </div>
                      <div class="col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Nota examen 2do parcial</label>
                        <input name="per_materno" type="text" class="form-control" required>
                      </div>
                    </div>                    
                    <div class="row">
                      <div class="col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Nota practicas 3er pacial</label>
                        <input name="per_paterno" type="text" class="form-control" required>
                      </div>
                      <div class="col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Nota examen 3er parcial</label>
                        <input name="per_materno" type="text" class="form-control" required>
                      </div>
                    </div> 
                    <div class="row">
                      <div class="col-md-12">
                        <label for="exampleInputPassword1" class="form-label">Nota final</label>
                        <input name="per_paterno" type="text" class="form-control" required>
                      </div>
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
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Creación del Dominio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="/Nota" method="POST" id="editForm"> <!-- {{route('Dominio.store')}} -->
                  {{ csrf_field() }}
                  {{ method_field('PUT') }}
                  <div class="modal-body">
                      <div class="row">
                        <input id="nota_mate_id" name="nota_mate_id" type="hidden">
                        <div class="col-md-6">
                          <label for="exampleInputPassword1" class="form-label">Nombre del estudiante</label>
                          <input name="est_id" type="text" class="form-control" id="est_id" readonly="readonly" required>
                        </div>
                        <div class="col-md-6">
                          <label for="exampleInputPassword1" class="form-label">Nombre de la materia</label>
                          <input id="mat_id" name="per_materno" type="text" class="form-control" id="mat_id" readonly="readonly" required>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <label for="exampleInputPassword1" class="form-label">Nota practicas 1er pacial</label>
                          <input name="nota_practica1" type="text" class="form-control" id="nota_practica1" required>
                        </div>
                        <div class="col-md-6">
                          <label for="exampleInputPassword1" class="form-label">Nota examen 1er parcial</label>
                          <input name="nota_examen1" type="text" class="form-control" id="nota_examen1" required>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <label for="exampleInputPassword1" class="form-label">Nota practicas 2do pacial</label>
                          <input name="nota_practica2" type="text" class="form-control" id="nota_practica2" required>
                        </div>
                        <div class="col-md-6">
                          <label for="exampleInputPassword1" class="form-label">Nota examen 2do parcial</label>
                          <input name="nota_examen2" type="text" class="form-control" id="nota_examen2" required>
                        </div>
                      </div>                    
                      <div class="row">
                        <div class="col-md-6">
                          <label for="exampleInputPassword1" class="form-label">Nota practicas 3er pacial</label>
                          <input name="nota_practica3" type="text" class="form-control" id="nota_practica3" required>
                        </div>
                        <div class="col-md-6">
                          <label for="exampleInputPassword1" class="form-label">Nota examen 3er parcial</label>
                          <input name="nota_examen3" type="text" class="form-control" id="nota_examen3" required>
                        </div>
                      </div> 
                      <div class="row">
                        <div class="col-md-12">
                          <label for="exampleInputPassword1" class="form-label">Nota final</label>
                          <input name="nota_final" type="text" class="form-control" id="nota_final" readonly="readonly" required>
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
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Dominio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="/Dominio" method="POST" id="deleteForm"> <!-- {{route('Dominio.store')}} -->
                  {{ csrf_field() }}
                  <div class="modal-body">
                  <div class="row">
                        <input id="nota_mate_id1 " name="nota_mate_id" type="hidden">
                        <div class="col-md-6">
                          <label for="exampleInputPassword1" class="form-label">Nombre del estudiante</label>
                          <input name="est_id1" type="text" class="form-control" id="est_id1" readonly="readonly" required>
                        </div>
                        <div class="col-md-6">
                          <label for="exampleInputPassword1" class="form-label">Nombre de la materia</label>
                          <input id="mat_id1" name="per_materno" type="text" class="form-control" id="mat_id1" readonly="readonly" required>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <label for="exampleInputPassword1" class="form-label">Nota practicas 1er pacial</label>
                          <input name="nota_practica11" type="text" class="form-control" id="nota_practica11" readonly="readonly" required>
                        </div>
                        <div class="col-md-6">
                          <label for="exampleInputPassword1" class="form-label">Nota examen 1er parcial</label>
                          <input name="nota_examen11" type="text" class="form-control" id="nota_examen11" readonly="readonly" required>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <label for="exampleInputPassword1" class="form-label">Nota practicas 2do pacial</label>
                          <input name="nota_practica21" type="text" class="form-control" id="nota_practica21" readonly="readonly" required>
                        </div>
                        <div class="col-md-6">
                          <label for="exampleInputPassword1" class="form-label">Nota examen 2do parcial</label>
                          <input name="nota_examen21" type="text" class="form-control" id="nota_examen21" readonly="readonly" required>
                        </div>
                      </div>                    
                      <div class="row">
                        <div class="col-md-6">
                          <label for="exampleInputPassword1" class="form-label">Nota practicas 3er pacial</label>
                          <input name="nota_practica31" type="text" class="form-control" id="nota_practica31" readonly="readonly" required>
                        </div>
                        <div class="col-md-6">
                          <label for="exampleInputPassword1" class="form-label">Nota examen 3er parcial</label>
                          <input name="nota_examen31" type="text" class="form-control" id="nota_examen31" readonly="readonly" required>
                        </div>
                      </div> 
                      <div class="row">
                        <div class="col-md-12">
                          <label for="exampleInputPassword1" class="form-label">Nota final</label>
                          <input name="nota_final1" type="text" class="form-control" id="nota_final1" readonly="readonly" required>
                        </div>
                      </div> 
                      <div class="modal-footer">
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
  $('#notas').DataTable({
        "lengthMenu":[[10, 25, 50, -1], [10, 25, 50, "All"]]
    });
} );
</script>
<script type="text/javascript">
$(document).ready(function(){
  var table = $('#notas').DataTable();
  table.on('click', '.edit', function(){
    $tr = $(this).closest('tr');
    if ($($tr).hasClass('child')) {
      $tr = $tr.prev('.parent');
    }
    var data = table.row($tr).data();
    console.log(data);
    $('#est_id').val(data[1]);
    $('#mat_id').val(data[2]);
    $('#nota_mate_id').val(data[3]);
    $('#nota_practica1').val(data[4]);
    $('#nota_examen1').val(data[5]);
    $('#nota_practica2').val(data[6]);
    $('#nota_examen2').val(data[7]);
    $('#nota_practica3').val(data[8]);
    $('#nota_examen3').val(data[9]);
    $('#nota_final').val(data[10]);

    $('#editForm').attr('action', '/Nota/'+data[0]);
    $('#editModal').modal('show');
  })
});
</script>

<script type="text/javascript">
$(document).ready(function(){
  var table = $('#notas').DataTable();
  table.on('click', '.delete', function(){
    $tr = $(this).closest('tr');
    if ($($tr).hasClass('child')) {
      $tr = $tr.prev('.parent');
    }
    var data = table.row($tr).data();
    console.log(data);
    $('#est_id1').val(data[1]);
    $('#mat_id1').val(data[2]);
    $('#nota_mate_id1').val(data[3]);
    $('#nota_practica11').val(data[4]);
    $('#nota_examen11').val(data[5]);
    $('#nota_practica21').val(data[6]);
    $('#nota_examen21').val(data[7]);
    $('#nota_practica31').val(data[8]);
    $('#nota_examen31').val(data[9]);
    $('#nota_final1').val(data[10]);

    $('#deleteForm').attr('action', '/Nota/'+data[0]);
    $('#deleteModal').modal('show');
  })
});
</script>

          
@endsection