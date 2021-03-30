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
                            <div class="card-header bg-primary" style="font-size: 30px;">INSCRIPCION - LISTA DE COMPROBANTES</div>
                        </div>
                    </div>
                </div>
                     
                <div class="card card-table-border-none" id="recent-orders">
                    @if (auth()->user()->per_rol == 1)
                        <div class="card-header">
                            <div class="col-md-9"><h4 class="row">Se esta mostrando la lista de comprobantes </h4></div>
                            <div class="col-md-3"><a href="{{ route('subir-comprobante.index') }}"><button type="button" class="btn btn-primary">
                                <span class="mdi mdi-comment-plus"></span>&nbsp;Subir comprobante
                            </button></a></div>
                        </div>
                        <div class="card-body">
                            <table id="postulante" class="table card-table table-responsive" style="width:100%; ">
                                <thead>
                                    <tr>
                                        <th>Id Est.</th>
                                        <th>Nombre completo</th>
                                        <th>C.I.</th>
                                        <th>Comprobante Tipo</th>
                                        <th>Comprobante Estado</th>
                                        <th style="display:none;" colspan="3"></th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($comprobante as $comp)
                                        <tr>
                                            <td class="">{{ $comp->est_id}}</td>
                                            <td class="">{{ $comp->name }}</td>
                                            <td class="">{{ $comp->per_num_documentacion }}</td>
                                            <td class="">{{ $comp->com_tipo }}</td>
                                            <td style="display: none">{{ $comp->com_url }}</td>
                                            <td style="display: none">{{ $comp->com_id }}</td>
                                            <td style="display: none">{{ $comp->per_telefono }}</td>
                                            @if ($comp->com_estado==0)
                                                <td class="">No validado</td>
                                                <td class="">
                                                    <button class="btn btn-warning validate">
                                                        <span class="mdi mdi-circle-edit-outline"></span>&nbsp;Validar</button>
                                                    <button class="btn btn-success edit">
                                                    <span class="mdi mdi-circle-edit-outline"></span></button>
                                                    <button class="btn btn-danger delete">
                                                        <span class="mdi mdi-delete"></span></button>
                                                </td>
                                            @else
                                                <td class="">Validado</td>
                                                <td class="">
                                                <button class="btn btn-secondary">&nbsp;Ya validado</button>
                                                <button class="btn btn-success edit">
                                                    <span class="mdi mdi-circle-edit-outline"></span></button>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    @if (auth()->user()->per_rol >= 3)
                        <div class="card-header">
                            <div class="col-md-9"><h4 class="row">Se esta mostrando la lista de comprobantes </h4></div>
                            <div class="col-md-3"><a href="{{ route('subir-comprobante.index') }}"><button type="button" class="btn btn-primary">
                                <span class="mdi mdi-comment-plus"></span>&nbsp;Subir comprobante
                            </button></a></div>
                        </div>
                        <div class="card-body">
                            <table id="postulante" class="table card-table table-responsive" style="width:100%; ">
                                <thead>
                                    <tr>
                                        <th>Id de estudiante</th>
                                        <th>Nombre completo</th>
                                        <th>Comprobante Tipo</th>
                                        <th>Comprobante Estado</th>
                                        <th style="display:none;" colspan="3"></th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($comprobante as $comp)
                                    @if ($comp->est_per_id === auth()->user()->per_id)
                                        <tr>
                                            <td class="">{{ $comp->est_id}}</td>
                                            <td class="">{{ $comp->name }}</td>
                                            <td class="">{{ $comp->com_tipo }}</td>
                                            <td style="display: none">{{ $comp->com_url }}</td>
                                            <td style="display: none">{{ $comp->com_id }}</td>
                                            <td style="display: none">{{ $comp->per_telefono }}</td>
                                            @if ($comp->com_estado==0)
                                                <td class="">No validado</td>
                                                <td class="">
                                                    <button class="btn btn-success edit2">
                                                    <span class="mdi mdi-circle-edit-outline"></span></button>
                                                </td>
                                            @else
                                                <td class="">Validado</td>
                                                <td class="">
                                                <button class="btn btn-secondary">&nbsp;Ya validado</button>
                                                <button class="btn btn-success edit2">
                                                    <span class="mdi mdi-circle-edit-outline"></span></button>
                                                </td>
                                            @endif
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!--**********Modal editar comprobante**********-->
    <div class="modal fade" id="edit2" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="validateLabel">VER EL COMPROBANTE</h5>
                <button type="button" class="btn-close btn btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-12">
                        <label for="e2_nombre_estudiante">Nombre completo</label>
                        <input type="text" class="form-control" 
                                id="e2_nombre_estudiante" name="e2_nombre_estudiante" 
                                placeholder="Nombres del estudiante"
                                onKeyPress="if(this.value.length==150) return false;" 
                                autocomplete="off" required disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="e2_image_comprobante">Comprobante actual</label>
                            <a href="" id="e2_image_comprobante" target="_blank"><img src="" alt="" id="e2_img_image_comprobante" width="100%"></a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                        <label for="e2_tipo_comprobante">Tipo de comprobante</label>
                        <select class="form-select form-control" name="e2_tipo_comprobante" id="e2_tipo_comprobante" required>
                            <option value="examen" disabled>Comprobante de EXAMEN DE INGRESO</option>
                            <option value="inscripcion PRIMER AÑO">Comprobante de INSCRIPCION PRIMER AÑO</option>
                            <option value="inscripcion SEGUNDO AÑO">Comprobante de INSCRIPCION SEGUNDO AÑO</option>
                            <option value="inscripcion TERCER AÑO">Comprobante de INSCRIPCION TERCER AÑO</option>
                            <option value="inscripcion CUARTO AÑO">Comprobante de INSCRIPCION CUARTO AÑO</option>
                        </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><span class="mdi mdi-cancel"></span>&nbsp;Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (auth()->user()->per_rol == 1)
        <!--**********Modal validar comprobante**********-->
        <div class="modal fade" id="validate" tabindex="-1" aria-labelledby="validateLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="validateLabel">VALIDAR EL COMPROBANTE</h5>
                        <button type="button" class="btn-close btn btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="valida-comprobante" method="POST" id="validateForm">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                            <p id="tip_comp"></p>
                            </div>
                        </div>
                        <div class="form-group row">
                                <div class="col-md-12">
                                    <a href="" id="image_comprobante" target="_blank"><img src="" alt="" id="img_image_comprobante" width="100%"></a>
                                </div>
                                <input type="hidden" id="tipo_comp" name="tipo_comp">
                                <input type="hidden" id="telefono" name="telefono">
                                <input type="hidden" id="name" name="name">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><span class="mdi mdi-cancel"></span>&nbsp;Cancelar</button>
                            <button type="submit" class="btn btn-primary" id="validarComp"><span class="mdi mdi-check"></span>&nbsp;VALIDAR</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--**********Modal eliminar comprobante**********-->
        <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="validateLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="validateLabel">ELIMINAR EL COMPROBANTE</h5>
                        <button type="button" class="btn-close btn btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="valida-comprobante" method="POST" id="deleteForm">
                        @csrf
                        @method('delete')
                        <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                            <p id="d_tip_comp">Esta seguro de eliminar el registro??</p>
                            </div>
                        </div>
                        <div class="form-group row">
                                <div class="col-md-12">
                                    <a href="" id="d_image_comprobante" target="_blank"><img src="" alt="" id="d_img_image_comprobante" width="100%"></a>
                                </div>
                                <input type="hidden" id="d_tipo_comp" name="tipo_comp">
                                <input type="hidden" id="d_telefono" name="telefono">
                                <input type="hidden" id="d_name" name="name">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><span class="mdi mdi-cancel"></span>&nbsp;Cancelar</button>
                            <button type="submit" class="btn btn-primary" id="deleteComp"><span class="mdi mdi-check"></span>&nbsp;ELIMINAR</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--**********Modal editar comprobante**********-->
        <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="validateLabel">MODIFICAR EL COMPROBANTE</h5>
                    <button type="button" class="btn-close btn btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="comprobante" method="POST" id="editForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group row">
                        <div class="col-md-12">
                            <label for="e_nombre_estudiante">Nombre completo</label>
                            <input type="text" class="form-control" 
                                    id="e_nombre_estudiante" name="e_nombre_estudiante" 
                                    placeholder="Nombres del estudiante"
                                    onKeyPress="if(this.value.length==150) return false;" 
                                    autocomplete="off" required disabled>
                        </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                            <label for="e_image_comprobante">Comprobante actual</label>
                            <a href="" id="e_image_comprobante" target="_blank"><img src="" alt="" id="e_img_image_comprobante" width="100%"></a>
                            </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-md-12">
                            <p>NOTA: Si desea modificar la captura del comprobante, debe subir una nueva imagen en el siguiente campo
                                caso contrario no debe subir NINGUNA imagen</p><br>
                            <input name="em_image_comprobante" type="file" class="form-control"
                                id="em_image_comprobante" autocomplete="off">
                        </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-md-12">
                            <label for="e_tipo_comprobante">Tipo de comprobante</label>
                            <select class="form-select form-control" name="e_tipo_comprobante" id="e_tipo_comprobante" required>
                                <option value="examen">Comprobante de EXAMEN DE INGRESO</option>
                                <option value="inscripcion PRIMER AÑO">Comprobante de INSCRIPCION PRIMER AÑO</option>
                                <option value="inscripcion SEGUNDO AÑO">Comprobante de INSCRIPCION SEGUNDO AÑO</option>
                                <option value="inscripcion TERCER AÑO">Comprobante de INSCRIPCION TERCER AÑO</option>
                                <option value="inscripcion CUARTO AÑO">Comprobante de INSCRIPCION CUARTO AÑO</option>
                            </select>
                            </div>
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
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#postulante').DataTable({
                "lengthMenu":[[10, 25, 50, -1], [10, 25, 50, "All"]],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            var table = $('#postulante').DataTable();
            table.on('click', '.delete', function(){
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }
                var data = table.row($tr).data();
                    $("#d_image_comprobante").attr("href", data[4]);
                    $("#d_tipo_comp").val(data[3]);
                    $("#d_telefono").val(data[6]);
                    $("#d_name").val(data[1]);

                    $("#d_tip_comp").text("Esta seguro de eliminar el comprobante de '"+data[2]+"' del estudiante '"+data[1]+"'");

                    $("#d_img_image_comprobante").attr("src", data[4]);
                    $('#delete').modal('show');
                    $('#deleteForm').attr('action', 'comprobante/'+data[5]);
            })
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            var table = $('#postulante').DataTable();
            table.on('click', '.edit', function(){
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }
                var data = table.row($tr).data();
                $("#e_nombre_estudiante").val(data[1]);
                $("#e_image_comprobante").attr("href", data[4]);
                $("#e_img_image_comprobante").attr("src", data[4]);
                $("#e_tipo_comprobante option[value='"+data[3]+"']").attr("selected", true);
                $('#edit').modal('show');
                $('#editForm').attr('action', 'comprobante/'+data[5]);
            })
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            var table = $('#postulante').DataTable();
            table.on('click', '.edit2', function(){
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }
                var data = table.row($tr).data();
                $("#e2_nombre_estudiante").val(data[1]);
                $("#e2_image_comprobante").attr("href", data[3]);
                $("#e2_img_image_comprobante").attr("src", data[3]);
                $("#e2_tipo_comprobante option[value='"+data[2]+"']").attr("selected", true);
                $('#edit2').modal('show');
            })
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            var table = $('#postulante').DataTable();
            table.on('click', '.validate', function(){
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }
                var data = table.row($tr).data();
                $("#image_comprobante").attr("href", data[4]);
                $("#tipo_comp").val(data[3]);
                $("#telefono").val(data[6]);
                $("#name").val(data[1]);
                $("#tip_comp").text("Esta seguro de validar el comprobante de '"+data[3]+"' del estudiante '"+data[1]+"'");
                $("#img_image_comprobante").attr("src", data[4]);

                $('#validate').modal('show');
                
                $('#validateForm').attr('action', 'valida-comprobante/'+data[5]);

                $('#validarComp').click(function() {
                    $mensaje = "Postulante "+data[1]+" su comprobante ha sido validado, en unos momentos se le asignara una fecha de examen";
                    $url = 'https://web.whatsapp.com/send?phone=591'+data[6]+'&text='+$mensaje+'&app_absent=0';
                    window.open($url, "_blank");
                });
            })
        });
    </script>
@endsection