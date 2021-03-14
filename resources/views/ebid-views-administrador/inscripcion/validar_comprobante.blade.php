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
                            <div class="card-header bg-primary" style="font-size: 30px;">PORTAL WEB - INSCRIPCIONES</div>
                        </div>
                    </div>
                  </div>           
                    <!-- Recent Order Table -->
                    <div class="card card-table-border-none" id="recent-orders">

                      <div class="card-header">
                        <div class="col-md-9"><h4 class="row">Listado de comprobantes por validar</h4></div>
                      </div>
                      &nbsp;

                      <div class="card-body pt-0 pb-5">
                        <table id="personas" class="table card-table table-responsive table-responsive-large" style="width:100%">
                          <thead>
                            <tr>
                              <th style="display:none">ID</th>
                              <th>Nombre Completo</th>
                              <th style="display:none">nombre</th>
                              <th style="display:none">ap_pat</th>
                              <th style="display:none">ap_m</th>
                              <th style="display:none">estado</th>
                              <th>Codigo Institucional</th>
                              <th>Estado</th>
                              <th>Comprobante</th>
                              <th>Acciones</th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach($estudiantes as $estudiante)
                            <tr>
                                <td class="" style="display:none">{{ $estudiante->est_id}}</td>
                                <td class="" width="30%">{{ $estudiante->name}}</td>
                                <td class="" style="display:none">{{ $estudiante->per_nombres}}</td>
                                <td class="" style="display:none">{{ $estudiante->per_paterno}}</td>
                                <td class="" style="display:none">{{ $estudiante->per_materno}}</td>
                                <td class="" style="display:none">{{ $estudiante->est_subd_estado}}</td>
                                <td class="" width="15%">{{ $estudiante->per_codigo_institucional}}</td>
                                <td class="" width="15%">
                                  @foreach($estados as $estado)
                                      @if($estado->subd_id === $estudiante->est_subd_estado)
                                      {{ $estado->subd_nombre}}
                                      @endif
                                  @endforeach
                                </td>
                                <td class="" width="20%"><a href="{{asset($estudiante->est_comprobante)}}" target="_blank">Comprobante</a></td>
                                <td width="20%">
                                    <button class="btn btn-success edit">
                                    <span class="mdi mdi-circle-edit-outline"></span>&nbsp;Modificar</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edición de Comprobante</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="/ValidarComprobante" method="POST" id="editForm" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  {{ method_field('PUT') }}
                  <div class="modal-body">
                    <div class="row">
                      <input id="per_id" name="per_id" type="hidden">
                      <div class="col-md-4">
                        <label for="exampleInputEmail1" class="form-label">Nombres</label>
                        <input id="per_nombres" name="per_nombres" type="text" class="form-control" readonly="readonly" required>
                      </div>
                      <div class="col-md-4">
                        <label for="exampleInputPassword1" class="form-label">Ap. Paterno</label>
                        <input id="per_paterno" name="per_paterno" type="text" class="form-control" readonly="readonly" required>
                      </div>
                      <div class="col-md-4">
                        <label for="exampleInputPassword1" class="form-label">Ap.Materno</label>
                        <input id="per_materno" name="per_materno" type="text" class="form-control" readonly="readonly" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <label for="exampleInputPassword1" class="form-label">Estado del Comprobante</label>
                        <select class="form-select" aria-label="Default select example" id="est_subd_estado" name="est_subd_estado" required>
                        @foreach($estados as $est)               
                          <option value="{{$est->subd_id}}">{{$est->subd_nombre}}</option>
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
    $('#est_subd_estado').val(data[5]);

    $('#editForm').attr('action', '/ValidarComprobante/'+data[0]);
    $('#editModal').modal('show');
  })
});
</script>
          

@endsection