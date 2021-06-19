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
                        <div class="card-header bg-primary" style="font-size: 30px;">NOTAS - SEGUIMIENTO DE NOTAS A ESTUDIANTES</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom" style="justify-content: space-between;">
                        <!--------------------------------------->
                        <div class="col-md-9"><h3 class="row text-uppercase">Sr (a): {{auth()->user()->name}}</h3></div>
                        <div class="col-md-9"><h3 class="row text-uppercase">Numero de documento: {{auth()->user()->per_num_documentacion}}</h3></div>
                        <div class="col-md-9"><h4 class="row">En esta seccion ud. podra ver las notas de las materia de cada estudiante</h4></div>
                        
                        <!--button type="button" class="btn btn-secondary"><span class="mdi mdi-printer"></span>&nbsp;<a style="color:white;" href="" target="_blank">Imprimir</a></button-->

                        <form action="estudiante-materia-imprimir" method="POST" id="formImprimir" target="_blank">
                            @csrf
                            <div >
                                <input type="hidden" name="codigo_estudiante" id="codigo_estudiante" value="{{ auth()->user()->per_id }}">
                                <input type="hidden" name="busqueda_anio" id="busqueda_anio" value="1">

                                
                                <button type="submit" class="btn btn-secondary"><span class="mdi mdi-print"></span>&nbsp;Imprimir</button>
                                
                            </div>
                        </form>

                        <!--------------------------------------->
                    </div>
                    <div class="card-body">
                        @if (auth()->user()->per_rol == 1)
                            <form action="estudiante-materia-buscar" method="POST" id="formBusqueda">
                                @csrf
                                <div class="form-group row" style="justify-content: center;">
                                    <div class="col-md-4">
                                        <label for="codigo_estudiante">Seleccione al estudiante</label>
                                        <select class="form-select" name="codigo_estudiante" id="codigo_estudiante">
                                            <option value="" selected disabled>--Seleccione al estudiante--</option>
                                            @foreach($estudiantes as $est)   
                                                <option value="{{ $est->per_id }}">{{ $est->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="busqueda_anio">Seleccione el año</label>
                                        <select class="form-select" name="busqueda_anio" id="busqueda_anio">
                                            <option value="" selected disabled>--Seleccione el año--</option>
                                            @foreach($semestres as $sem)   
                                                <option value="{{ $sem->sem_id }}">{{ $sem->sem_nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 pt-4">
                                        <button type="submit" class="btn btn-primary"><span class="mdi mdi-account-search"></span>&nbsp;Buscar</button>
                                    </div>
                                </div>
                            </form>
                        @endif
                        @if (auth()->user()->per_rol == 3)
                        <form action="estudiante-materia-buscar" method="POST" id="formBusqueda">
                            @csrf
                            <div class="form-group row" style="justify-content: center;">
                                
                                <input type="hidden" name="codigo_estudiante" id="codigo_estudiante" value="{{ auth()->user()->per_id }}">
                                
                                <div class="col-md-4">
                                    <label for="busqueda_anio">Seleccione el año</label>
                                    <select class="form-select" name="busqueda_anio" id="busqueda_anio">
                                        <option value="" selected disabled>--Seleccione el año--</option>
                                        @foreach($semestres as $sem)   
                                            <option value="{{ $sem->sem_id }}">{{ $sem->sem_nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 pt-4">
                                    <button type="submit" class="btn btn-primary"><span class="mdi mdi-account-search"></span>&nbsp;Buscar</button>
                                </div>
                            </div>
                        </form>
                        

                        @endif
                        <form action="{{ route('subir-notas.store') }}" method="POST" id="createRegistros">
                            @csrf
                            <div class="form-group row">
                                <table id="notas" class="table card-table table-responsive table-responsive-large" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre materia</th>
                                            <th>1er Parcial</th>
                                            <th>2do Parcial</th>
                                            <th>3er Parcial</th>
                                            <th>4to Parcial</th>
                                            <th>Segundo Turno</th>
                                            <th colspan="5" style="display: none;"></th>
                                            <th>Nota final</th>
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
                            <p>Si usted no pude modificar las notas comuniquese con administracion para solicitar permisos de modificación</p>
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
                var param = $('#codigo_estudiante').val();
                $.ajax({
                    method  : "POST",
                    url     : "estudiante-materia-buscar",
                    data    : $('#formBusqueda').serialize(),
                    success : function(res){
                        var array = JSON.parse(res);
                        var fila = '';
                        var notaFinal = 0;
                        if(array.length > 0){
                            for(var i=0; i<array.length; i++){
                                fila+= '<tr><td>'+array[i].mat_id+'</td>'
                                fila+='<td>'+array[i].mat_nombre+'</td>';
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
                                    fila+='<td style="background-color: #EA7A76; color: #000;">'+Math.round(array[i].nota_final * 100) / 100+'</td></tr>';
                                }else{
                                    fila+='<td style="background-color: #8BCE91; color: #000;">'+Math.round(array[i].nota_final * 100) / 100+'</td></tr>';
                                }
                            }
                            $('#cuerpoTabla').html(fila);
                        }
                        if(array.length<=0){
                            contador = -1;
                            fila = '<tr><td colspan="13" align="center">No existen registros de notas de las materias del año que seleccionó</td></tr>';
                            $('#cuerpoTabla').html(fila);
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
                    if($tr[0].children[7].innerText == "0"){
                        $('#nota1').attr('readonly', 'readonly');
                    }else{
                        $('#nota1').removeAttr('readonly', 'readonly');
                    }
                    if($tr[0].children[8].innerText == "0"){
                        $('#nota2').attr('readonly', 'readonly');
                    }else{
                        $('#nota2').removeAttr('readonly', 'readonly');
                    }
                    if($tr[0].children[9].innerText == "0"){
                        $('#nota3').attr('readonly', 'readonly');
                    }else{
                        $('#nota3').removeAttr('readonly', 'readonly');
                    }
                    if($tr[0].children[10].innerText == "0"){
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
W
                $('#mate_id').val($tr[0].children[11].innerText);

                $('#editModal').modal('show');
                $('#editForm').attr('action', 'ver-notas/'+$tr[0].children[11].innerText);
            })
        });
    </script>
@endsection