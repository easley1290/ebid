@extends('ebid-views-administrador.componentes.main')
@section('contenido')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card text-white mb-3 bg-primary">
                        <div class="card-header bg-primary" style="font-size: 30px;">NOTAS - VER NOTAS DE SUS MATERIAS</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom" style="justify-content: space-between;">
                        <div class="col-md-9"><h4 class="row">Si tiene materias asignadas usted podrá ver a los estudiantes que estan cursando la materia</h4></div>
                        <div class="col-md-3">
                            <a href="{{ route('subir-notas.index') }}"><button type="button" class="btn btn-primary"><span class="mdi mdi-comment-plus"></span>&nbsp;Ir seccion subir notas</button></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="materia-estudiante-buscar-notas" method="POST" id="formBusqueda">
                            @csrf
                            <div class="form-group row" style="justify-content: center;">
                                <div class="col-md-6">
                                    <label for="busqueda_nombre">Seleccione una de sus materias asignadas</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-account-search"></i>
                                            </span>
                                        </div>
                                        <select class="form-select" name="busqueda_materia_docente" id="busqueda_materia_docente">
                                            <option value="" selected disabled>--Seleccione la materia--</option>
                                            @foreach($materiaDocente as $matDoc)             
                                                @foreach ($materias as $mat)
                                                    @if($mat->mat_id == $matDoc->matd_mat_id)
                                                        <option value="{{ $mat->mat_id }}">{{ $mat->mat_nombre }}</option>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-primary"><span class="mdi mdi-account-search"></span>&nbsp;Buscar</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <form action="{{ route('subir-notas.store') }}" method="POST" id="createRegistros">
                            @csrf
                            <div class="form-group row">
                                <table id="notas" class="table card-table table-responsive table-responsive-large" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre completo</th>
                                            <th>Cedula de identidad</th>
                                            <th>1er Parcial</th>
                                            <th>2do Parcial</th>
                                            <th>3er Parcial</th>
                                            <th>4to Parcial</th>
                                            <th>Segundo Turno</th>
                                            <th colspan="5" style="display: none;"></th>
                                            <th>Nota final</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="cuerpoTabla"></tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> 

    <!-- Modal editar-->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal">EDITAR NOTA</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="editForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <p class="mb-1">Si usted no pude modificar las notas comuniquese con administracion para solicitar permisos de modificación</p>
                            <p class="mb-4"><b>NO PUEDE modificar la nota del segundo turno</b></p>
                        </div>
                        <div class="row">
                            <input id="mate_id" name="mate_id" type="hidden">
                            <div class="col-md-6">
                                <label for="nombre_estudiante" class="form-label">Nombre del estudiante</label>
                                <input name="nombre_estudiante" type="text" class="form-control" id="nombre_estudiante" readonly required>
                            </div>
                            <div class="col-md-6">
                                <label for="nombre_materia" class="form-label">Nombre de la materia</label>
                                <input id="nombre_materia" name="nombre_materia" type="text" class="form-control" readonly required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label for="nota1" class="form-label">Nota 1er parcial</label>
                                <input name="nota1" type="text" class="form-control" id="nota1" required>
                            </div>
                            <div class="col-md-3">
                                <label for="nota2" class="form-label">Nota 2do parcial</label>
                                <input name="nota2" type="text" class="form-control" id="nota2" required>
                            </div>
                            <div class="col-md-3">
                                <label for="nota3" class="form-label">Nota 3er parcial</label>
                                <input name="nota3" type="text" class="form-control" id="nota3" required>
                            </div>
                            <div class="col-md-3">
                                <label for="nota4" class="form-label">Nota 4to parcial</label>
                                <input name="nota4" type="text" class="form-control" id="nota4" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><span class="mdi mdi-cancel"></span>&nbsp;Cerrar</button>
                        <button type="submit" class="btn btn-primary">
                            <span class="mdi mdi-folder-upload"></span>&nbsp;Modificar Nota
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Eliminar registro --}}
    <div class="modal fade" id="destroyModal" tabindex="-1" aria-labelledby="destroyLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="destroyLabel">ELIMINAR NOTA</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <div class="row">
                            <p>Esta seguro de eliminar el registro?</p>
                            <p>Se recomienda fervientemente no realizarlo ya que perjudicará al registro de nuestros queridos estudiantes</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><span class="mdi mdi-cancel"></span>&nbsp;Cerrar</button>
                        <button type="submit" class="btn btn-primary">
                            <span class="mdi mdi-folder-upload"></span>&nbsp;ELIMINAR NOTA
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#notas').DataTable({
                "lengthMenu":[[10, 25, 50, -1], [10, 25, 50, "All"]],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){   
            $(document).on('submit', '#formBusqueda', function() {
                var param = $('#busqueda_materia_docente').val();
                $.ajax({
                    method  : "POST",
                    url     : "materia-estudiante-buscar-notas",
                    data    : $('#formBusqueda').serialize(),
                    success : function(res){
                        var array = JSON.parse(res);
                        var fila = '';
                        var contador = 0;
                        var notaFinal = 0;
                        if(array.length > 0){
                            for(var i=0; i<array.length; i++){
                                fila+= '<tr><td>'+array[i].est_id+'</td>'
                                fila+='<td>'+array[i].name+'</td>';
                                fila+='<td>'+array[i].per_num_documentacion+'</td>';
                                fila+='<td>'+array[i].nota_final1+'</td>';
                                fila+='<td>'+array[i].nota_final2+'</td>';
                                fila+='<td>'+array[i].nota_final3+'</td>';
                                fila+='<td>'+array[i].nota_final4+'</td>';
                                fila+='<td>'+array[i].nota_dosT+'</td>';
                                fila+='<td style="display:none;">'+array[i].nota_indicador1+'</td>';
                                fila+='<td style="display:none;">'+array[i].nota_indicador2+'</td>';
                                fila+='<td style="display:none;">'+array[i].nota_indicador3+'</td>';
                                fila+='<td style="display:none;">'+array[i].nota_indicador4+'</td>';
                                fila+='<td style="display:none;">'+array[i].nota_id+'</td>';
                                if(Math.round(array[i].nota_final * 100) / 100 <= 6){
                                    fila+='<td style="background-color: #EA7A76; color: #000;">'+Math.round(array[i].nota_final * 100) / 100+'</td>';
                                }else{
                                    fila+='<td style="background-color: #8BCE91; color: #000;">'+Math.round(array[i].nota_final * 100) / 100+'</td>';
                                }
                                @if (auth()->user()->per_rol == 6)
                                    fila+='<td><button class="btn btn-success edit" type="button"><span class="mdi mdi-circle-edit-outline"></span></button></td></tr>';
                                @endif
                                @if (auth()->user()->per_rol == 1)
                                    fila+='<td><button class="btn btn-success edit" type="button"><span class="mdi mdi-circle-edit-outline"></span></button>';
                                    fila+='<button class="btn btn-danger destroy" type="button"><span class="mdi mdi-delete"></span></button></td></tr>';
                                @endif
                                contador++;
                            }
                            contador--;
                            $('#cuerpoTabla').html(fila);
                        }
                        if(array.length<=0){
                            contador = -1;
                            fila = '<tr><td colspan="3" align="center">No existen registros de estudiantes en esa materia</td></tr>';
                            $('#cuerpoTabla').html(fila);
                            fila2 = '';
                            $('#confirmar').html(fila2)
                        }
                    },
                    error   : function(){
                        alert("Hubo un error al realizar la busqueda")
                    }
                })
                return false;
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            var table = $('#notas').DataTable();
            table.on('click', '.edit', function(){
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }
                $('#nombre_estudiante').val($tr[0].children[1].innerText);
                $('#nombre_materia').val($tr[0].children[2].innerText);
                
                $('#nota1').val($tr[0].children[3].innerText);
                $('#nota2').val($tr[0].children[4].innerText);
                $('#nota3').val($tr[0].children[5].innerText);
                $('#nota4').val($tr[0].children[6].innerText);

                @if (auth()->user()->per_rol != 1)
                    if($tr[0].children[8].innerText == "0"){
                        $('#nota1').attr('readonly', 'readonly');
                    }else{
                        $('#nota1').removeAttr('readonly', 'readonly');
                    }
                    if($tr[0].children[9].innerText == "0"){
                        $('#nota2').attr('readonly', 'readonly');
                    }else{
                        $('#nota2').removeAttr('readonly', 'readonly');
                    }
                    if($tr[0].children[10].innerText == "0"){
                        $('#nota3').attr('readonly', 'readonly');
                    }else{
                        $('#nota3').removeAttr('readonly', 'readonly');
                    }
                    if($tr[0].children[11].innerText == "0"){
                        $('#nota4').attr('readonly', 'readonly');
                    }else{
                        $('#nota4').removeAttr('readonly', 'readonly');
                    }
                @else
                    $('#nota1').removeAttr('readonly', 'readonly');
                    $('#nota2').removeAttr('readonly', 'readonly');
                    $('#nota3').removeAttr('readonly', 'readonly');
                    $('#nota4').removeAttr('readonly', 'readonly');
                @endif

                $('#mate_id').val($tr[0].children[12].innerText);
                
                $('#editModal').modal('show');
                $('#editForm').attr('action', 'ver-notas/'+$tr[0].children[12].innerText);
            })
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            var table = $('#notas').DataTable();
            table.on('click', '.destroy', function(){
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }
                $('#destroyModal').modal('show');
                $('#deleteForm').attr('action', 'ver-notas/'+$tr[0].children[11].innerText);
            })
        });
    </script>
@endsection