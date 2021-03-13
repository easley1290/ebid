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
                        <h2>Cambio de contraseña</h2>
                      </div>
                      <div class="card-body pt-0 pb-5">
                        <form action="{{route('Contrasenia.update', auth()->user()->id)}}" method="POST" id="editForm">
                            @csrf
                            @method('PUT')
                            <div class="">
                                <div class="">
                                  <h4>Estimado(a): {{auth()->user()->name}}, introduzca los siguientes datos:</h4>
                                 
                                </div>
                                <hr>
                                <input id="per_id" name="per_id" type="hidden">
                                <div class="col-md-6">
                                  <label for="exampleInputEmail1" class="form-label">Contraseña Antigua</label>
                                  <input id="per_contraseña_antigua" name="per_contraseña_antigua" type="password" class="form-control" required>
                                </div>
                                &nbsp;
                                <div class="col-md-6">
                                  <label for="exampleInputPassword1" class="form-label">Nueva Contraseña</label>
                                  <input id="contraseña_nueva" name="contraseña_nueva" type="password" class="form-control" required>
                                </div>
                                &nbsp;
                                <div class="col-md-6">
                                  <label for="exampleInputPassword1" class="form-label">Repetir Contraseña</label>
                                  <input id="contraseña_nueva1" name="contraseña_nueva1" type="password" class="form-control" required>
                                </div>
                                &nbsp;
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                              </div>
                          </form> 
                        </div>
                    </div>
                </div>
              </div>
            </div>
     
           
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<!--script>
$(document).ready(function() {
  $('#personas').DataTable({
        "lengthMenu":[[10,25, 50, -1], [10,25, 50, "All"]]
    });
} );
</script-->

@endsection