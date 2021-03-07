@extends('ebid-views-administrador.componentes.main')
@section('contenido')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <br>
    <div class="container">
        <div class="row">
            <div class="col-12">             
                <div class="card card-table-border-none" id="recent-orders">
                    <div class="card-header justify-content-between">
                    <h2>LISTA DE NUESTRAS UNIDADES ACADEMICAS</h2>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearModal">
                        <i class="mdi mdi-note-plus"></i>&nbsp;Crear registro de nueva unidad academica
                    </button>
                    </div>
                    <div class="card-body pt-0 pb-5">
                    <table id="unidad-academica" class="table card-table table-responsive table-responsive-large" style="width:100%">
                        <thead>
                            <tr>
                                <th>Codigo U.A.</th>
                                <th>Nombre U.A.</th>
                                <th>Descripci&oacute;n U.A.</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($unidadesAcademicas as $ua)
                            <tr>
                                <td class="">{{ $ua->uni_id}}</td>
                                <td class="">{{ $ua->uni_nombre}}</td>
                                <td class="">{{ $ua->uni_descrip}}</td>
                                <td><button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#verModal">
                                        <i class="mdi mdi-eye-plus"></i>&nbsp;Ver m&aacute;s
                                    </button>
                                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editModal">
                                        <i class="mdi mdi-circle-edit-outline"></i>&nbsp;Editar
                                    </button>
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                        <i class="mdi mdi-delete"></i>&nbsp;Eliminar
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>    
     
    <div class="modal fade" id="crearModal" tabindex="-1" role="dialog" aria-labelledby="crearModalTitle" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crearModalLabel">REGISTRO DE NUEVA UNIDAD ACADEMICA</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('unidad.store') }}" method="POST"> 
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div style="margin-left: 10px;">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="inputCodigo" class="form-label">C&oacute;digo U.A.</label>
                                    <input name="inputCodigo" type="text" class="form-control" 
                                        id="inputCodigo" autocomplete="off" 
                                        placeholder="Ingrese el codigo de la nueva U.A."
                                        onKeyPress="if(this.value.length==20) return false;"
                                        required>
                                </div>
                                <div class="col-md-8">
                                    <label for="inputNombre" class="form-label">Nombre U.A.</label>
                                    <input name="inputNombre" type="text" class="form-control" 
                                        id="inputNombre" autocomplete="off" 
                                        placeholder="Ingrese el nombre de la nueva U.A."
                                        onKeyPress="if(this.value.length==150) return false;"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="inputTelefono" class="form-label">Tel&eacute;fono de la U.A.</label>
                                    <input name="inputTelefono" type="number" class="form-control" 
                                        id="inputTelefono" autocomplete="off" 
                                        placeholder="Ingrese el numero telefonico"
                                        onKeyPress="if(this.value.length==10) return false;">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputTelefono2" class="form-label">N&uacute;mero de celular de la U.A.</label>
                                    <input name="inputTelefono2" type="number" class="form-control" 
                                        id="inputTelefono2" autocomplete="off" 
                                        placeholder="Ingrese el numero telefonico."
                                        onKeyPress="if(this.value.length==10) return false;">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="inputDireccion" class="form-label">Direcci&oacute;n de la U.A.</label>
                                    <input name="inputDireccion" type="text" class="form-control" 
                                        id="inputDireccion" autocomplete="off" 
                                        placeholder="Ingrese ubicacion de la U.A."
                                        onKeyPress="if(this.value.length==10) return false;"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="mb-2 mt-4 d-inline-block mr-3">Estado de U.A.</label>
                                    <ul class="list-unstyled list-inline">
                                        <li class="d-inline-block mr-6">
                                            <label class="control control-radio">Activo
                                                <input type="radio" name="option" checked="checked">
                                                <div class="control-indicator"></div>
                                            </label>
                                        </li>
                                        <li class="d-inline-block mr-6">
                                            <label class="control control-radio">En pausa
                                                <input type="radio" name="option">
                                                <div class="control-indicator"></div>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-pill" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary btn-pill">Guardar registro</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Creación del Dominio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="/Dominio" method="POST" id="editForm"> <!-- {{route('Dominio.store')}} -->
                  {{ csrf_field() }}
                  {{ method_field('PUT') }}
                  <div class="modal-body">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nombre del Dominio</label>
                        <input name="dom_nombre" id="dom_nombre" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Descripción</label>
                        <input name="dom_descrip" id="dom_descrip" type="text" class="form-control" id="exampleInputPassword1">
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
                  <form action="/Dominio" method="POST" id="deleteForm"> <!-- {{route('Dominio.store')}} -->
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <div class="modal-body">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Esta seguro de elimiar el dominio?</label>
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
    <script>
        $(document).ready(function() {
        $('#unidad-academica').DataTable({
                "lengthMenu":[[5, 10, 50, -1], [5, 10, 50, "All"]]
            });
        });
    </script>
    {{-- <script type="text/javascript">
        $(document).ready(function(){
            var table = $('#unidad-academica').DataTable();
            table.on('click', '.edit', function(){
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }
                var data = table.row($tr).data();
                $('#uni_nombre').val(data[1]);
                $('#uni_descrip').val(data[2]);
                $('#editForm').attr('action', '/Dominio/'+data[0]);
                $('#editModal').modal('show');
            })
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            var table = $('#unidad-academica').DataTable();
            table.on('click', '.delete', function(){
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }
                var data = table.row($tr).data();
                $('#deleteForm').attr('action', '/Dominio/'+data[0]);
                $('#deleteModal').modal('show');
            })
        });
    </script>  --}}
@endsection