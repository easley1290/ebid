@extends('ebid-views-administrador.componentes.main')
@section('contenido')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
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
                            <div class="card-header bg-primary" style="font-size: 30px;">ESTUDIANTES - LISTA DE ESTUDIANTES REGISTRADOS</div>
                        </div>
                    </div>
                </div>
                     
                <div class="card card-table-border-none" id="recent-orders">
                    <div class="card-header">
                        <div class="col-md-12 pb-3">
                            <h4 class="row">En este listado ud. verá la lista de estudiantes registrados en la institucion, ya sean estudiantes nuevos, antiguos o reprobados</h4>
                        </div><br>
                            <div class="col-md-6"></div>
                            <div class="col-md-3">
                                <a href="estudiante-nuevo">
                                    <button type="button" class="btn btn-danger">
                                        <span class="mdi mdi-account-plus-outline"></span>&nbsp;Registrar estudiante nuevo
                                    </button>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-warning">
                                    <span class="mdi mdi-account-plus"></span>&nbsp;Registrar est. antiguo
                                </button>
                            </div>
                    </div>
                    <div class="card-body">
                        <table id="estudiante" class="table card-table table-responsive" style="width:100%; ">
                            <thead>
                                <tr>
                                    <th>Codigo institucional</th>
                                    <th>Nombre completo</th>
                                    <th>Cedula de identidad</th>
                                    <th>Numero de telefono</th>
                                    <th colspan="2" style="display: none;"></th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($arrayAux[1] as $est)
                                <tr>
                                    <td class="">{{ $est->per_codigo_institucional }}</td>
                                    <td class="">{{ $est->name }}</td>
                                    <td class="">{{ $est->per_num_documentacion }}</td>
                                    <td class="">{{ $est->per_telefono }}</td>
                                    <td style="width:200px">
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
        </div>
    </div>
    <!--**********Modal crear noticias**********-->
    {{-- <div class="modal fade" id="crearModal" tabindex="-1" aria-labelledby="crearModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="color: #1B223C" id="crearModalLabel">CREAR NUEVA NOTICIA</h5>
                    <button type="button" class="btn-close btn btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('noticias.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div style="margin-left: 10px;">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_nombre_noticia" class="form-label">T&iacute;tulo de la noticia</label>
                                    <input name="c_nombre_noticia" type="text" class="form-control"
                                        id="c_nombre_noticia" autocomplete="off" 
                                        placeholder="Titulo de la noticia"
                                        onKeyPress="if(this.value.length==100) return false;"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_imagen_noticia" class="form-label">Imagen de la noticia</label>
                                    <input name="c_imagen_noticia" type="file" class="form-control"
                                        id="c_imagen_noticia" autocomplete="off"
                                        required>
                                    <p>NOTA: La imagen no debe ser mayor a 8MB</p><br>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_historia_noticia" class="form-label">Historia de la noticia</label>
                                    <textarea name="c_historia_noticia" type="text" class="form-control"
                                        id="c_historia_noticia" autocomplete="off" 
                                        placeholder="Historia de la noticia"
                                        onKeyPress="if(this.value.length==500) return false;"
                                        style="height: 150px; resize: none;"
                                        required></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_ua_noticia" class="form-label">Pertenece a la U.A.</label>
                                    <select class="form-select" aria-label="" name="c_ua_noticia" id="c_ua_noticia">
                                    @foreach($arrayAux[0] as $ua)               
                                        <option value="{{$ua->ua_id}}">{{$ua->ua_nombre}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_estado_noticia" class="form-label">Estado de la noticia</label>
                                    <ul class="list-unstyled list-inline">
                                        <li class="d-inline-block mr-3">
                                            <label class="control control-radio">Activo
                                                <input type="radio" name="c_estado_noticia" checked="checked" value="1">
                                                <div class="control-indicator"></div>
                                            </label>
                                        </li>
                                        <li class="d-inline-block mr-3">
                                            <label class="control control-radio">Inactivo
                                                <input type="radio" name="c_estado_noticia" value="2">
                                                <div class="control-indicator"></div>
                                            </label>
                                        </li>
                                        <p>NOTA: Activo = Se mostrará la noticia en el portal web <br> Inactivo = No se mostrará la noticia en el portal web</p><br>
                                    </ul>
                                </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><span class="mdi mdi-cancel"></span>&nbsp;Cancelar</button>
                        <button type="submit" class="btn btn-primary"><span class="mdi mdi-check"></span>&nbsp;Confirmar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--**********Modal editar noticias**********-->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="color: #1B223C" id="editModalLabel">MODIFICAR NOTICIA</h5>
                    <button type="button" class="btn-close btn btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="administracion/noticias" method="POST" enctype="multipart/form-data" id="editForm">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div style="margin-left: 10px;">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="e_nombre_noticia" class="form-label">T&iacute;tulo de la noticia</label>
                                    <input name="e_nombre_noticia" type="text" class="form-control"
                                        id="e_nombre_noticia" autocomplete="off" 
                                        placeholder="Titulo de la noticia"
                                        onKeyPress="if(this.value.length==100) return false;"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="e_imagen_noticia" class="form-label">Imagen actual de la noticia</label><br>
                                    <a href="" id="e_imagen_noticia" target="_blank"></a>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <img src="" alt="" id="img_imagen_noticia" width="100%">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <p>NOTA: Si desea modificar la imagen mostrada en el portal web, debe subir una nueva imagen en el siguiente campo
                                        caso contrario no debe subir ninguna imagen</p><br>
                                    <input name="em_imagen_noticia" type="file" class="form-control"
                                        id="em_imagen_noticia" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="e_historia_noticia" class="form-label">Historia de la noticia</label>
                                    <textarea name="e_historia_noticia" type="text" class="form-control"
                                        id="e_historia_noticia" autocomplete="off" 
                                        placeholder="Historia de la noticia"
                                        onKeyPress="if(this.value.length==500) return false;"
                                        style="height: 150px; resize: none;"
                                        required></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="e_ua_noticia" class="form-label">Pertenece a la U.A.</label>
                                    <select class="form-select" aria-label="" name="e_ua_noticia" id="e_ua_noticia">
                                    @foreach($arrayAux[0] as $ua)               
                                        <option value="{{$ua->ua_id}}">{{$ua->ua_nombre}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="e_estado_noticia" class="form-label">Estado de la noticia</label>
                                    <ul class="list-unstyled list-inline">
                                        <li class="d-inline-block mr-3">
                                            <label class="control control-radio">Activo
                                                <input type="radio" name="e_estado_noticia" id="radio1" value="1" checked="checked">
                                                <div class="control-indicator"></div>
                                            </label>
                                        </li>
                                        <li class="d-inline-block mr-3">
                                            <label class="control control-radio">Inactivo
                                                <input type="radio" name="e_estado_noticia" id="radio2" value="2">
                                                <div class="control-indicator"></div>
                                            </label>
                                        </li>
                                    </ul>
                                </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><span class="mdi mdi-cancel"></span>&nbsp;Cancelar</button>
                        <button type="submit" class="btn btn-primary"><span class="mdi mdi-check"></span>&nbsp;Confirmar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--**********Modal eliminar noticias**********-->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">ELIMINAR NOTICIA</h5>
                    <button type="button" class="btn-close btn btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="administracion/noticias" method="POST" id="deleteForm">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <div class="mb-3">
                            <p>Esta seguro de eliminar la noticia????</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><span class="mdi mdi-cancel"></span>&nbsp;Cancelar</button>
                            <button type="submit" class="btn btn-primary"><span class="mdi mdi-check"></span>&nbsp;Confirmar cambios</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script>
        $(document).ready(function() {
        $('#estudiante').DataTable({
                "lengthMenu":[[10, 25, 50, -1], [10, 25, 50, "All"]],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
            });
        } );
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            var table = $('#noticias').DataTable();
            table.on('click', '.edit', function(){
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }
                var data = table.row($tr).data();
                $('#e_nombre_noticia').val(data[1]);
                $('#e_historia_noticia').val(data[5]);
                $("#e_imagen_noticia").attr("href", "\\ebid\\public\\assets\\img\\noticias\\" + data[4]);
                $("#img_imagen_noticia").attr("src", "\\ebid\\public\\assets\\img\\noticias\\" + data[4]);
                $("#e_imagen_noticia").text(data[4]);
                if(data[3]=='Noticia Activo'){
                    $("#radio1").attr("checked", "checked");
                }
                if(data[3]=='Noticia Inactivo'){
                    $("#radio2").attr("checked", "checked");
                }
                
                $('#editModal').modal('show');
                $('#editForm').attr('action', 'noticias/'+data[0]);
          })
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            var table = $('#noticias').DataTable();
            table.on('click', '.delete', function(){
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }
                var data = table.row($tr).data();
                $('#deleteModal').modal('show');
                $('#deleteForm').attr('action', 'noticias/'+data[0]);
            })
        });
    </script>

@endsection