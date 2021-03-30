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
                            <div class="card-header bg-primary" style="font-size: 30px;">PORTAL WEB - ADMINISTRACION DE VIDEOS</div>
                        </div>
                    </div>
                </div>
                     
                <div class="card card-table-border-none" id="recent-orders">
                    <div class="card-header">
                        <div class="col-md-9"><h4 class="row">Recuerde que solo debe ingresar las URL's de los videos, recomendablemente subidos en la plataforma YouTube</h4></div>
                        <div class="col-md-3"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearModal">
                            <span class="mdi mdi-video-plus"></span>&nbsp;Agregar nuevo video
                        </button></div>
                    </div>
                    <div class="card-body">
                        <table id="videos" class="table card-table table-responsive" style="width:100%; ">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Titulo del video</th>
                                    <th>Perteneciente a</th>
                                    <th>Estado del video</th>
                                    <th style="display: none;"></th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($arrayAux[2] as $video)
                                <tr>
                                    <td class="">{{ $video->vid_id}}</td>
                                    <td class="">{{ $video->vid_titulo }}</td>
                                    @foreach($arrayAux[0] as $ua)
                                        @if($ua->ua_id == $video->vid_ua_id)
                                            <td class="">{{ $ua->ua_nombre}}</td>
                                        @endif
                                    @endforeach
                                    @foreach($arrayAux[1] as $subd)
                                        @if($subd->subd_id == $video->vid_subd_estado)
                                            <td class="">Video {{ $subd->subd_nombre}}</td>
                                        @endif
                                    @endforeach
                                    <td style="display:none;">{{ $video->vid_url }}</td>
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

    <!--**********Modal crear registro de video**********-->
    <div class="modal fade" id="crearModal" tabindex="-1" aria-labelledby="crearModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="color: #1B223C" id="crearModalLabel">CREAR NUEVA IMAGEN PARA LA GALERIA</h5>
                    <button type="button" class="btn-close btn btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div style="margin-left: 10px;">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_nombre_video" class="form-label">Titulo del video</label>
                                    <input name="c_nombre_video" type="text" class="form-control"
                                        id="c_nombre_video" autocomplete="off" 
                                        placeholder="Ej. PRESENTACION EN LA PLAZA DEL OBELISCO...."
                                        onKeyPress="if(this.value.length==50) return false;"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_url_video" class="form-label">ID de la URL del video</label>
                                    <input name="c_url_video" type="text" class="form-control"
                                        id="c_url_video" autocomplete="off" 
                                        placeholder="Ej. NrTVtRyxfxM"
                                        onKeyPress="if(this.value.length==200) return false;"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <p>NOTA: Solo se debe agregar la ID del video de YouTube <br>caso contrario no se podra visualizar el video.</p>
                                    <img src="{{ asset('assets/img/indicacion-url.png') }}" alt="" width="100%">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_ua_video" class="form-label">Pertenece a la U.A.:</label>
                                    <select class="form-select" aria-label="" name="c_ua_video"
                                            id="c_ua_video">
                                    @foreach($arrayAux[0] as $ua)               
                                        <option value="{{$ua->ua_id}}">{{$ua->ua_nombre}}</option>
                                     @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_estado_video" class="form-label">Se mostrará el video?</label>
                                    <ul class="list-unstyled list-inline">
                                        <li class="d-inline-block mr-3">
                                            <label class="control control-radio">Activo
                                                <input type="radio" name="c_estado_video" checked="checked" value="1">
                                                <div class="control-indicator"></div>
                                            </label>
                                        </li>
                                        <li class="d-inline-block mr-3">
                                            <label class="control control-radio">Inactivo
                                                <input type="radio" name="c_estado_video" value="2">
                                                <div class="control-indicator"></div>
                                            </label>
                                        </li>
                                        <p>NOTA: Activo = Se mostrará el video en el portal web 
                                            <br> Inactivo = No se mostrará el video en el portal web <br>
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

    <!--**********Modal editar video**********-->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="color: #1B223C" id="editModalLabel">MODIFICAR REGISTRO</h5>
                    <button type="button" class="btn-close btn btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="administracion/videos" method="POST" id="editForm">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div style="margin-left: 10px;">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="e_nombre_video" class="form-label">Titulo del video</label>
                                    <input name="e_nombre_video" type="text" class="form-control"
                                        id="e_nombre_video" autocomplete="off" 
                                        placeholder="Ej. ENSEÑANDO A ADULTOS MAYORES...."
                                        onKeyPress="if(this.value.length==50) return false;"
                                        required>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="e_video_actual" class="form-label">Video actual</label><br>
                                    <iframe width="100%" height="300" src="" frameborder="0" id="e_video_actual"
                                        allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                        allowfullscreen></iframe>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <p>NOTA: SOLO SI desea modificar la URL del video mostrada en el portal web 
                                        debe subir una nueva URL en el siguiente campo, caso contrario NO debe subir ninguna URL</p>
                                    <input name="e_url_video" type="text" class="form-control"
                                        id="e_url_video" autocomplete="off" 
                                        placeholder="Ej. NrTVtRyxfxM"
                                        onKeyPress="if(this.value.length==200) return false;">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="e_ua_video" class="form-label">Pertenece a la U.A.:</label>
                                    <select class="form-select" aria-label="" name="e_ua_video" 
                                            id="e_ua_video">
                                        @foreach($arrayAux[0] as $ua)               
                                            <option value="{{$ua->ua_id}}">{{$ua->ua_nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="e_estado_video" class="form-label">Se mostrará el video?</label>
                                    <ul class="list-unstyled list-inline">
                                        <li class="d-inline-block mr-3">
                                            <label class="control control-radio">Activo
                                                <input type="radio" name="e_estado_video" id="radio1" checked="checked" value="1">
                                                <div class="control-indicator"></div>
                                            </label>
                                        </li>
                                        <li class="d-inline-block mr-3">
                                            <label class="control control-radio">Inactivo
                                                <input type="radio" name="e_estado_video" id="radio2" value="2">
                                                <div class="control-indicator"></div>
                                            </label>
                                        </li>
                                        <p>NOTA: Activo = Se mostrará el video en el portal web 
                                            <br> Inactivo = No se mostrará el video en el portal web <br>
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

    <!--**********Modal eliminar video**********-->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">ELIMINAR REGISTRO DE VIDEO</h5>
                    <button type="button" class="btn-close btn btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="administracion/videos" method="POST" id="deleteForm">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <div class="mb-3">
                            <p>Esta seguro de eliminar el video del registro????</p>
                        </div>
                        <div>
                            <iframe width="100%" height="300" src="" frameborder="0" id="d_video_actual"
                                    allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen></iframe>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><span class="mdi mdi-cancel"></span>&nbsp;Cancelar</button>
                            <button type="submit" class="btn btn-primary"><span class="mdi mdi-check"></span>&nbsp;Confirmar ELIMINACIÓN</button>
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
        $('#videos').DataTable({
                "lengthMenu":[[10, 25, 50, -1], [10, 25, 50, "All"]],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
            });
        } );
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            var table = $('#videos').DataTable();
            table.on('click', '.edit', function(){
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }
                var data = table.row($tr).data();
                $('#e_nombre_video').val(data[1]);
                $("#e_video_actual").attr("src", data[4]);
                if(data[3]=='Video Activo'){
                    $("#radio1").attr("checked", "checked");
                }
                if(data[3]=='Video Inactivo'){
                    $("#radio2").attr("checked", "checked");
                }
                $('#editModal').modal('show');
                $('#editForm').attr('action', 'videos/'+data[0]);
          })
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            var table = $('#videos').DataTable();
            table.on('click', '.delete', function(){
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }
                var data = table.row($tr).data();
                $("#d_video_actual").attr("src", data[4]);
                $('#deleteModal').modal('show');
                $('#deleteForm').attr('action', 'videos/'+data[0]);
            })
        });
    </script>
@endsection