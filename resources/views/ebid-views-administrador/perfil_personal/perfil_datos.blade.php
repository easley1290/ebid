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
                            <div class="card-header bg-primary" style="font-size: 30px;">PORTAL WEB - DATOS PERSONALES</div>
                            </div>
                        </div>
                    </div>             
                    <!-- Recent Order Table -->
                    <div class="card card-table-border-none" id="recent-orders">
                      
                      <div class="card-body pt-0 pb-5">
                        <div  class="row">
                          <div class="col-md-4" style="position: relative;">
                            <div style="position: absolute;
                            top: 40%;
                            left: 20%;
                            transform: translate(-20%, -40%);">
                              <img src="http://ebid.edu.bo/public{{ auth()->user()->per_foto_personal }}" width="100%" />
                            </div>
                          </div>
                          <div class="col-md-8">
                              <div class="modal-body">
                                <div class="row">
                                  <input id="per_id_" name="per_id" type="hidden" value="{{$personas->per_id}}">
                                  <div class="col-md-4">
                                    <label for="exampleInputEmail1" class="form-label">Nombres</label>
                                    <input id="per_nombres_" name="per_nombres" type="text" class="form-control" readonly="readonly" value="{{$personas->per_nombres}}">
                                  </div>
                                  <div class="col-md-4">
                                    <label for="exampleInputPassword1" class="form-label">Ap. Paterno</label>
                                    <input id="per_paterno_" name="per_paterno" type="text" class="form-control" readonly="readonly" value="{{$personas->per_paterno}}">
                                  </div>
                                  <div class="col-md-4">
                                    <label for="exampleInputPassword1" class="form-label">Ap.Materno</label>
                                    <input id="per_materno_" name="per_materno" type="text" class="form-control" readonly="readonly" value="{{$personas->per_materno}}">
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <label for="exampleInputPassword1" class="form-label">Género</label>
                                        @foreach($generos as $subdominio)   
                                          @if($subdominio->subd_id == $personas->per_subd_genero)            
                                            <input id="per_genero" name="per_genero" type="text" class="form-control" readonly="readonly" value="{{$subdominio->subd_nombre}}">
                                            <input id="per_subd_genero_" name="per_subd_genero" value="{{$personas->per_subd_genero}}" type="hidden">
                                          @endif
                                        @endforeach  
                                        @if($personas->per_subd_genero == null)
                                            <input type="text" class="form-control" readonly="readonly" placeholder="Sin especificar">
                                        @endif
                                  </div>
                                  <div class="col-md-6">
                                    <label for="exampleInputPassword1" class="form-label">Fecha Naciminento</label>
                                    <input id="per_fecha_nacimiento_" name="per_fecha_nacimiento" type="date" class="form-control" readonly="readonly" value="{{$personas->per_fecha_nacimiento}}">
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-4">
                                    <label for="exampleInputPassword1" class="form-label">Tipo Documento</label>
                                    @foreach($tipo_docs as $subdominio)
                                        @if($subdominio->subd_id == $personas->per_subd_documentacion)
                                        <input id="per_documentacion" name="per_documentacion" type="text" class="form-control" readonly="readonly" value="{{ $subdominio->subd_nombre}}">
                                        <input id="per_subd_documentacion_" name="per_subd_documentacion" value="{{$personas->per_subd_documentacion}}" type="hidden">
                                        @endif
                                    @endforeach
                                    @if($personas->per_subd_documentacion == null)
                                      <input type="text" class="form-control" readonly="readonly" placeholder="Sin especificar">
                                    @endif
                                  </div>
                                  <div class="col-md-4">
                                    <label for="exampleInputPassword1" class="form-label">Numero Documento</label>
                                    <input id="per_num_documentacion_" name="per_num_documentacion" type="number" class="form-control" readonly="readonly" value="{{$personas->per_num_documentacion}}" placeholder="Sin especificar">
                                  </div>
                                  <div class="col-md-4">
                                    <label for="exampleInputPassword1" class="form-label">Extensión</label>
                                    @foreach($extensions as $subdominio)
                                      @if($subdominio->subd_id == $personas->per_subd_extension)
                                      <input id="per_extension" name="per_extension" type="text" class="form-control"  readonly="readonly" value="{{ $subdominio->subd_nombre}}">
                                      <input id="per_subd_extension_" name="per_subd_extension" value="{{$personas->per_subd_extension}}" type="hidden">
                                      @endif
                                    @endforeach
                                    @if($personas->per_subd_extension == null)
                                      <input type="text" class="form-control" readonly="readonly" placeholder="Sin especificar">
                                    @endif
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <label for="exampleInputPassword1" class="form-label">Telefono</label>
                                    <input id="per_telefono_" name="per_telefono" type="number" class="form-control" readonly="readonly" value="{{$personas->per_telefono}}" placeholder="Sin especificar">
                                  </div>
                                  <div class="col-md-6">
                                    <label for="exampleInputPassword1" class="form-label">Correo Personal</label>
                                    <input id="per_correo_personal_" name="per_correo_personal" type="email" class="form-control" readonly="readonly" value="{{$personas->email}}" placeholder="Sin especificar">
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12">
                                    <label for="exampleInputPassword1" class="form-label">Domicilio</label>
                                    <input id="per_domicilio_" name="per_domicilio" type="text" class="form-control" readonly="readonly" value="{{$personas->per_domicilio}}" placeholder="Sin especificar">
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button class="btn btn-success edit" id="edit">
                                    <span class="mdi mdi-circle-edit-outline"></span>&nbsp;Modificar Datos</button>
                                  
                                </div>
                              </div>
                          </div>
                          
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
                          <form action="/PersonaPerfil" method="POST" id="editForm" enctype="multipart/form-data">
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
                                <input id="per_num_documentacion" name="per_num_documentacion" type="number" class="form-control" id="exampleInputPassword1" onKeyPress="if(this.value.length==10) return false;" min="1" required>
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
                                <input id="per_telefono" name="per_telefono" type="number" class="form-control" id="exampleInputPassword1" onKeyPress="if(this.value.length==10) return false;" min="1" required>
                              </div>
                              <div class="col-md-6">
                                <label for="exampleInputPassword1" class="form-label">Correo Personal</label>
                                <input id="per_correo_personal" name="per_correo_personal" type="email" class="form-control" id="exampleInputPassword1" required>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                <label for="exampleInputPassword1" class="form-label">Domicilio</label>
                                <input id="per_domicilio" name="per_domicilio" type="text" class="form-control" id="exampleInputPassword1" required>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <label for="exampleInputPassword1" class="form-label">Foto (Opcional)</label>
                                <input id="per_foto_personal" name="per_foto_personal" type="file" class="form-control">
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
                    <!----->
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
<!-- editar -->
<script type="text/javascript">
  $(document).ready(function(){
    $('.edit').on('click', function() {
      
      var id = $('#per_id_').val();
      $('#per_nombres').val($('#per_nombres_').val());
      $('#per_paterno').val($('#per_paterno_').val());
      $('#per_materno').val($('#per_materno_').val());
      $('#per_subd_genero').val($('#per_subd_genero_').val());
      $('#per_fecha_nacimiento').val($('#per_fecha_nacimiento_').val());
      $('#per_subd_documentacion').val($('#per_subd_documentacion_').val());
      $('#per_num_documentacion').val($('#per_num_documentacion_').val());
      $('#per_subd_extension').val($('#per_subd_extension_').val());
      $('#per_telefono').val($('#per_telefono_').val());
      $('#per_correo_personal').val($('#per_correo_personal_').val());
      $('#per_domicilio').val($('#per_domicilio_').val());
      

      $('#editForm').attr('action', '/public/PersonaPerfil/'+id);
      $('#editModal').modal('show');
    })
  });
  </script>
@endsection