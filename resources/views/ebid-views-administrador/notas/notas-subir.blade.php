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
            <div class="row">
                <div class="col-md-12">
                    <div class="card text-white mb-3 bg-primary">
                        <div class="card-header bg-primary" style="font-size: 30px;">NOTAS - SUBIR NOTAS</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom" style="justify-content: space-between;">
                        <div class="col-md-2">
                            <a href="{{ route('ver-notas.index') }}"><button type="button" class="btn btn-secondary"><span class="mdi mdi-arrow-left"></span>&nbsp;Atrás</button></a>
                        </div>
                        <div class="col-md-10">
                            <h4>En esta seccion podrá subir las notas de los estudiantes</h4><br>
                            <h4><b>RECUERDE estamos en el parcial Nro. {{ $parcialActual->subd_descripcion }}</b></h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" id="formBusqueda">
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
                                <table id="estudiante" class="table card-table table-responsive table-responsive-large" style="width:80%">
                                    <thead>
                                        <tr>
                                            <th>Id estudiante</th>
                                            <th>Nombre completo</th>
                                            <th>Cedula de identidad</th>
                                            <th style="background-color: #C493C3; color: white;">Practica (70%)</th>
                                            <th style="background-color: #E0BBE8; color: white;">Teorica (30%)</th>
                                            <th style="background-color: #C493C3; color: white;">Total (100%)</th>
                                            <th style="display: none;" colspan="5"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="cuerpoTabla"></tbody>
                                    <div id="confirmar"></div>
                                </table>
                            </div>
                            <div class="modal fade" id="afirmar" tabindex="-1" aria-labelledby="afirmarLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="crearLabel">ATENCION</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body"><p>Esta seguro de los datos??</p>
                                            <p>Recuerde que no podra cambiar las notas a menos que adminitracion le de autorizacion para ello</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="cancelar"><span class="mdi mdi-cancel"></span>&nbsp;Cerrar</button>
                                            <button type="button" class="btn btn-primary" id="submitt" onclick="deshabilitar(submitt)"><span class="mdi mdi-folder-upload"></span>&nbsp;SUBIR NOTAS</button></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){   
            $(document).on('submit', '#formBusqueda', function() {
                var param = $('#busqueda_materia_docente').val();
                $.ajax({
                    method  : "POST",
                    url     : "materia-estudiante-buscar",
                    data    : $('#formBusqueda').serialize(),
                    success : function(res){
                        var array = JSON.parse(res);
                        var fila = '';
                        var fila2 = '';
                        var contador = 0;
                        if(array.length > 0){
                            for(var i=0; i<array.length; i++){
                                fila+= '<tr><td>'+array[i].est_id+'<input type="hidden" value="'+array[i].mate_id+'" id="materiaEstudiante'+contador+'" name="materiaEstudiante'+contador+'"></input></td>'
                                fila+='<td>'+array[i].name+'</td>';
                                fila+='<td>'+array[i].per_num_documentacion+'</td>';
                                fila+='<td><input type="text" class="form-control" onchange="calcular(notaA'+contador+', notaB'+contador+')" id="notaA'+contador+'" name="notaA'+contador+'" placeholder="Nota practica"';
                                fila+='onKeyPress="if(this.value.length==4) return false;" value=0 autocomplete="off" required></input></td>';
                                fila+='<td><input type="text" class="form-control" onchange="calcular(notaA'+contador+', notaB'+contador+')" id="notaB'+contador+'" name="notaB'+contador+'" placeholder="Nota teorica"';
                                fila+='onKeyPress="if(this.value.length==4) return false;" value=0 autocomplete="off" required></input></td>';
                                fila+='<td><input type="text" class="form-control" disabled id="notaC" name="notaC" value =0 placeholder="Nota Total"';
                                fila+='onKeyPress="if(this.value.length==4) return false;" autocomplete="off" required></input></td></tr>';
                                contador++;
                            }
                            contador--;
                            $('#cuerpoTabla').html(fila);

                            fila2+='<div class="form-group row" style="justify-content: center;"><div class="col-md-3">';
                            fila2+='<button type="button" class="btn btn-primary" id="subir_nota" onclick="verificar()"><span class="mdi mdi-account-search"></span>&nbsp;SUBIR NOTAS</button>';
                            fila2+='<input type="hidden" value="'+contador+'" name="contador" id="contador"></input>';
                            fila2+='<input type="hidden" value="'+param+'" name="materiaEst" id="materiaEst"></input>';
                            fila2+='</div></div>';
                            
                            $('#confirmar').html(fila2)
                        }
                        if(array.length<=0){
                            contador = -1;
                            fila = '<tr><td colspan="6" align="center">No existen registros de estudiantes habilitados para subir notas</td></tr>';
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

    <script>
        $(document).ready(function() {
            $('#estudiante').DataTable({
                "lengthMenu":[[10, 25, 50, -1], [10, 25, 50, "All"]],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
            });
        });
    </script>

    <script type="text/javascript">
        function calcular(param1, param2){
            if(parseFloat(param1.value) > 100 || parseFloat(param2.value) > 100){
                alert('Los valores '+param1.value+' (PRACTICO) y '+param2.value+' (TEORICO) superan el valor de 100 y 100 respectivamente, revise los valores porfavor.')
                if(parseFloat(param1.value) > 100){
                    param1.focus();
                }
                if(parseFloat(param2.value) > 100){
                    param2.focus();
                }
            }
            else{
                document.getElementById('notaC').value = ((parseFloat(param1.value))*0.7) + ((parseFloat(param2.value))*0.3);
            }
           
        }
        function verificar(){
            if(document.getElementById('notaC').value > 1 && document.getElementById('notaC').value != 0){
                $('#afirmar').modal('show');
            }
            else{
                alert('Se verifico que la nota final es igual a 0 verifique las notas practicas y teoricas');
            }
        }
        $("#submitt").click(function(){        
            $("#createRegistros").submit();
        });
    </script>
@endsection