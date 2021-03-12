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
                            <div class="card-header bg-primary" style="font-size: 30px;">PORTAL WEB - ADMINISTRACION DE LA GALERIA DE FOTOS</div>
                        </div>
                    </div>
                </div>
                     
                <div class="card card-table-border-none" id="recent-orders">
                    <div class="card-header">
                        <div class="col-md-9"><h4 class="row">La informacion que se muestra actualmente se mostrará en el portal web</h4></div>
                        <div class="col-md-3"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearModal">
                            <span class="mdi mdi-image-plus"></span>&nbsp;Agregar nueva foto
                        </button></div>
                    </div>
                    <div class="card-body">
                        <table id="galeria" class="table card-table table-responsive" style="width:100%; ">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Titulo de fotografía</th>
                                    <th>Perteneciente a</th>
                                    <th>Estado de imagen</th>
                                    <th style="display: none;"></th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($arrayAux[2] as $galeria)
                                <tr>
                                    <td class="">{{ $galeria->gal_id}}</td>
                                    <td class="">{{ $galeria->gal_titulo }}</td>
                                    @foreach($arrayAux[0] as $ua)
                                        @if($ua->ua_id === $galeria->gal_ua_id)
                                            <td class="">{{ $ua->ua_nombre}}</td>
                                        @endif
                                    @endforeach
                                    @foreach($arrayAux[1] as $subd)
                                        @if($subd->subd_id === $galeria->gal_subd_estado)
                                            <td class="">Imagen {{ $subd->subd_nombre}}</td>
                                        @endif
                                    @endforeach
                                    <td style="display: none;">{{ $galeria->gal_direccion }}</td>
                                    <td class="">
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
        </div>
    </div>
    <!--**********Modal crear imagen**********-->
    <div class="modal fade" id="crearModal" tabindex="-1" aria-labelledby="crearModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="color: #1B223C" id="crearModalLabel">CREAR NUEVA IMAGEN PARA LA GALERIA</h5>
                    <button type="button" class="btn-close btn btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('galeria.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div style="margin-left: 10px;">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_nombre_galeria" class="form-label">Titulo de la foto de la galeria</label>
                                    <input name="c_nombre_galeria" type="text" class="form-control"
                                        id="c_nombre_galeria" autocomplete="off" 
                                        placeholder="Ej. ENSEÑANDO A ADULTOS MAYORES...."
                                        onKeyPress="if(this.value.length==30) return false;"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_imagen_galeria" class="form-label">Foto para la galeria</label>
                                    <input name="c_imagen_galeria" type="file" class="form-control"
                                        id="c_imagen_galeria" autocomplete="off"
                                        required>
                                    <p>NOTA: La foto no debe pesar mas de 8MB</p><br>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_ua_galeria" class="form-label">Pertenece a la U.A.:</label>
                                    <select class="form-select" aria-label="" name="c_ua_galeria" id="c_ua_galeria">
                                    @foreach($arrayAux[0] as $ua)               
                                        <option value="{{$ua->ua_id}}">{{$ua->ua_nombre}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_estado_galeria" class="form-label">Se mostrará la foto?</label>
                                    <ul class="list-unstyled list-inline">
                                        <li class="d-inline-block mr-3">
                                            <label class="control control-radio">Activo
                                                <input type="radio" name="c_estado_galeria" checked="checked" value="1">
                                                <div class="control-indicator"></div>
                                            </label>
                                        </li>
                                        <li class="d-inline-block mr-3">
                                            <label class="control control-radio">Inactivo
                                                <input type="radio" name="c_estado_galeria" value="2">
                                                <div class="control-indicator"></div>
                                            </label>
                                        </li>
                                        <p>NOTA: Activo = Se mostrará la imagen en el portal web <br> Inactivo = No se mostrará la imagen en el portal web <br><br><br>
                                            Recuerde que si se suben demasiadas fotografias al servidor, el disco duro se irá llenando rapidamente.
                                        </p><br>
                                    </ul>
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

    <!--**********Modal editar imagen**********-->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="color: #1B223C" id="editModalLabel">MODIFICAR REGISTRO DE GALERIA</h5>
                    <button type="button" class="btn-close btn btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="administracion/galeria" method="POST" enctype="multipart/form-data" id="editForm">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div style="margin-left: 10px;">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="e_nombre_galeria" class="form-label">Titulo de la foto de la galeria</label>
                                    <input name="e_nombre_galeria" type="text" class="form-control"
                                        id="e_nombre_galeria" autocomplete="off" 
                                        placeholder="Ej. ENSEÑANDO A ADULTOS MAYORES...."
                                        onKeyPress="if(this.value.length==30) return false;"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="e_imagen_galeria" class="form-label">Imagen para la galeria</label><br>
                                    <a href="" id="e_imagen_galeria" target="_blank"></a><br><br><br>
                                    <img src="" alt="" id="img_imagen_galeria" width="100%">
                                    <p>NOTA: Si desea modificar la fotografia mostrada en el portal web, debe subir una nueva fotografia en el siguiente campo caso contrario NO debe subir ninguna imagen</p><br>
                                    <input name="em_imagen_galeria" type="file" class="form-control"
                                        id="em_imagen_galeria" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="e_ua_galeria" class="form-label">Pertenece a la U.A.:</label>
                                    <select class="form-select" aria-label="" name="e_ua_galeria" 
                                            id="e_ua_galeria">
                                    @foreach($arrayAux[0] as $ua)               
                                        <option value="{{$ua->ua_id}}">{{$ua->ua_nombre}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="e_estado_galeria" class="form-label">Se mostrará la foto?</label>
                                    <ul class="list-unstyled list-inline">
                                        <li class="d-inline-block mr-3">
                                            <label class="control control-radio">Activo
                                                <input type="radio" name="e_estado_galeria" id="radio1" checked="checked" value="1">
                                                <div class="control-indicator"></div>
                                            </label>
                                        </li>
                                        <li class="d-inline-block mr-3">
                                            <label class="control control-radio">Inactivo
                                                <input type="radio" name="e_estado_galeria" id="radio2"  value="2">
                                                <div class="control-indicator"></div>
                                            </label>
                                        </li>
                                        <p>NOTA: Activo = Se mostrará la imagen en el portal web <br> Inactivo = No se mostrará la imagen en el portal web <br><br><br>
                                            Recuerde que si se suben demasiadas fotografias al servidor, el disco duro se irá llenando rapidamente.
                                        </p><br>
                                    </ul>
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

    <!--**********Modal eliminar imagen**********-->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">ELIMINAR REGISTRO DE GALERIA</h5>
                    <button type="button" class="btn-close btn btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="administracion/galeria" method="POST" id="deleteForm">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <div class="mb-3">
                            <p>Esta seguro de eliminar la fotografia de la galeria????</p>
                        </div>
                        <div>
                            <img src="" alt="" id="imgd_imagen_galeria" width="100%">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><span class="mdi mdi-cancel"></span>&nbsp;Cancelar</button>
                            <button type="submit" class="btn btn-primary"><span class="mdi mdi-check"></span>&nbsp;Confirmar cambios</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script>
        $(document).ready(function() {
        $('#galeria').DataTable({
                "lengthMenu":[[10, 25, 50, -1], [10, 25, 50, "All"]],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
            });
        } );
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            var table = $('#galeria').DataTable();
            table.on('click', '.edit', function(){
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }
                var data = table.row($tr).data();
                $('#e_nombre_galeria').val(data[1]);
                $("#e_imagen_galeria").attr("href", "\\ebid\\public\\assets\\img\\galeria\\" + data[4]);
                $("#img_imagen_galeria").attr("src", "\\ebid\\public\\assets\\img\\galeria\\" + data[4]);
                $("#e_imagen_galeria").text(data[4]);
                $('#editModal').modal('show');
                if(data[3]=='Imagen Activo'){
                    $("#radio1").attr("checked", "checked");
                }
                if(data[3]=='Imagen Inactivo'){
                    $("#radio2").attr("checked", "checked");
                }
                $('#editForm').attr('action', 'galeria/'+data[0]);
          })
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            var table = $('#galeria').DataTable();
            table.on('click', '.delete', function(){
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }
                var data = table.row($tr).data();
                $("#imgd_imagen_galeria").attr("src", "\\ebid\\public\\assets\\img\\galeria\\" + data[4]);
                $('#deleteModal').modal('show');
                $('#deleteForm').attr('action', 'galeria/'+data[0]);
            })
        });
    </script>
@endsection