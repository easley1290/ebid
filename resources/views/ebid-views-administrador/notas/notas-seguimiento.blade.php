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
                        <div class="col-md-9"><h3 class="row text-uppercase">Est: {{auth()->user()->name}}</h3></div>
                        <div class="col-md-9"><h3 class="row text-uppercase">Numero de documento: {{auth()->user()->per_num_documentacion}}</h3></div>
                        
                        <!--button type="button" class="btn btn-secondary"><span class="mdi mdi-printer"></span>&nbsp;<a style="color:white;" href="" target="_blank">Imprimir</a></button-->

                        <!--form action="{{route('ImprimirNotas')}}" method="POST" id="formImprimir" target="_blank">
                            @csrf
                            <div >
                                <input type="hidden" name="codigo_estudiante" id="codigo_estudiante" value="{{ auth()->user()->per_id }}">
                                <input type="hidden" name="imprimir_anio" id="imprimir_anio" value="1">

                                <button type="submit" class="btn btn-secondary"><span class="mdi mdi-print"></span>&nbsp;Imprimir</button>
                                
                            </div>
                        </form-->

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
                                <table id="notas" class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th style="display: none;"></th>
                                            <th>Nombre completo</th>
                                            <th>Cedula de identidad</th>
                                            <th colspan="3">1er Parcial</th>
                                            <th colspan="3">2do Parcial</th>
                                            <th colspan="3">3er Parcial</th>
                                            <th colspan="3">4to Parcial</th>
                                            <th>Segundo Turno</th>
                                            <th colspan="5" style="display: none;"></th>
                                            <th>Nota final</th>
                                            <th>Acciones</th>
                                        </tr>
                                        <tr>
                                            <th colspan="2"></th>
                                            <th>P</th>
                                            <th>T</th>
                                            <th>&nbsp;</th>
                                            <th>P</th>
                                            <th>T</th>
                                            <th>&nbsp;</th>
                                            <th>P</th>
                                            <th>T</th>
                                            <th>&nbsp;</th>
                                            <th>P</th>
                                            <th>T</th>
                                            <th>&nbsp;</th>
                                            <th colspan="7"></th>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

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
                                fila+= '<tr><td style="display:none">'+array[i].est_id+'</td>'
                                fila+='<td>'+array[i].name+'</td>';
                                fila+='<td>'+array[i].per_num_documentacion+'</td>';

                                aux = array[i].nota_final1.split("|");
                                practica = Math.round(aux[0]*1000)/1000;
                                teoria = Math.round(aux[1]*1000)/1000;
                                fila+='<td>'+practica+'</td>';
                                fila+='<td>'+teoria+'</td>';
                                fila+='<td>'+Math.round((practica+teoria)*1000)/1000+'</td>';

                                aux = array[i].nota_final2.split("|");
                                practica = Math.round(aux[0]*1000)/1000;
                                teoria = Math.round(aux[1]*1000)/1000;
                                fila+='<td>'+practica+'</td>';
                                fila+='<td>'+teoria+'</td>';
                                fila+='<td>'+Math.round((practica+teoria)*1000)/1000+'</td>';

                                aux = array[i].nota_final3.split("|");
                                practica = Math.round(aux[0]*1000)/1000;
                                teoria = Math.round(aux[1]*1000)/1000;
                                fila+='<td>'+practica+'</td>';
                                fila+='<td>'+teoria+'</td>';
                                fila+='<td>'+Math.round((practica+teoria)*1000)/1000+'</td>';

                                aux = array[i].nota_final4.split("|");
                                practica = Math.round(aux[0]*1000)/1000;
                                teoria = Math.round(aux[1]*1000)/1000;
                                fila+='<td>'+practica+'</td>';
                                fila+='<td>'+teoria+'</td>';
                                fila+='<td>'+Math.round((practica+teoria)*1000)/1000+'</td>';

                                fila+='<td>'+array[i].nota_dosT+'</td>';
                                fila+='<td style="display:none;">'+array[i].nota_indicador1+'</td>';
                                fila+='<td style="display:none;">'+array[i].nota_indicador2+'</td>';
                                fila+='<td style="display:none;">'+array[i].nota_indicador3+'</td>';
                                fila+='<td style="display:none;">'+array[i].nota_indicador4+'</td>';
                                fila+='<td style="display:none;">'+array[i].nota_indicador2T+'</td>';
                                fila+='<td style="display:none;">'+array[i].nota_id+'</td>';
                                if(Math.round(array[i].nota_final * 1000) / 1000 <= 60){
                                    fila+='<td style="background-color: #EA7A76; color: #000;">'+Math.round(array[i].nota_final * 1000) / 1000+'</td>';
                                }else{
                                    fila+='<td style="background-color: #8BCE91; color: #000;">'+Math.round(array[i].nota_final * 1000) / 1000+'</td>';
                                }
                            }
                            $('#cuerpoTabla').html(fila);
                        }
                        if(array.length<=0){
                            contador = -1;
                            fila = '<tr><td colspan="23" align="center">No existen registros de notas de las materias del año que seleccionó</td></tr>';
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

    {{-- <script type="text/javascript">
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
                $('#mate_id').val($tr[0].children[11].innerText);

                $('#editModal').modal('show');
                $('#editForm').attr('action', 'ver-notas/'+$tr[0].children[11].innerText);
            })
        });
    </script> --}}
@endsection