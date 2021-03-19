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
                        <div class="card-header bg-primary" style="font-size: 30px;">AÑADIR NUEVO ESTUDIANTE NUEVO EN LA INSTITUCION</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom" style="justify-content: space-between;">
                        <a href="{{ route('estudiante.index') }}">
                            <button type="button" class="btn btn-secondary">
                                <span class="mdi mdi-arrow-left"></span>&nbsp;Atras</button>
                        </a>
                        <h2>BUSCAR ESTUDIANTE</h2>
                    </div>
                    <div class="card-body">
                        <form action="estudiante-buscar" method="POST" id="formBusqueda">
                            @csrf
                            <div class="form-group row" style="justify-content: center;">
                                <div class="col-md-6">
                                    <label for="busqueda_estudiante">Busqueda de estudiante que se registro previamente</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-account-search"></i>
                                            </span>
                                        </div>
                                        <input type="text" id="busqueda_estudiante" 
                                            name="busqueda_estudiante" class="form-control"
                                            onKeyPress="if(this.value.length==10) return false;"
                                            placeholder="Ingrese C.I. de estudiante" autocomplete="off">
                                        <button type="submit" class="btn btn-primary"><span class="mdi mdi-check"></span>&nbsp;Buscar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="form-group row">
                            <table id="estudiantes-encontrados" class="table card-table table-responsive table-responsive-large" style="width:80%">
                                <thead>
                                    <tr>
                                        <th style="display: none;"></th>
                                        <th>Nombre completo</th>
                                        <th>Cedula de identidad</th>
                                        <th>Acciones</th>
                                        <th style="display: none;" colspan="5"></th>
                                    </tr>
                                </thead>
                                <tbody id="cuerpoTabla">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--**********Modal crear registro de persona - estudiante**********-->
    <div class="modal fade" id="crear" tabindex="-1" aria-labelledby="crearLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('storeNuevo') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="crearLabel">FORMULARIO DE REGISTRO DE ESTUDIANTE</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <label for="nombre_estudiante">Nombres</label>
                                <input type="text" class="form-control" 
                                        id="nombre_estudiante" name="nombre_estudiante" 
                                        placeholder="Nombres del estudiante" value="{{ old('nombre_estudiante') }}"
                                        onKeyPress="if(this.value.length==50) return false;" 
                                        tabindex="1" autocomplete="off" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="paterno_estudiante">Apellido Paterno</label>
                                <input type="text" class="form-control" 
                                        id="paterno_estudiante" name="paterno_estudiante" 
                                        placeholder="Apellido paterno del estudiante" value="{{ old('paterno_estudiante') }}"
                                        onKeyPress="if(this.value.length==50) return false;" 
                                        tabindex="2" autocomplete="off" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="materno_estudiante">Apellido Materno</label>
                                <input type="text" class="form-control" 
                                        id="materno_estudiante" name="materno_estudiante" 
                                        placeholder="Apellido materno del estudiante" value="{{ old('materno_estudiante') }}"
                                        onKeyPress="if(this.value.length==50) return false;"
                                        tabindex="3" autocomplete="off"  required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="fec_nacimiento_estudiante">Fecha de nacimiento</label>
                                <input type="date" class="form-control" 
                                        id="fec_nacimiento_estudiante" tabindex="4" 
                                        value="{{ old('fec_nacimiento_estudiante') }}" name="fec_nacimiento_estudiante" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <label for="numero_ci_estudiante">Numero de cédula de identidad</label>
                                <input type="number" class="form-control" 
                                        id="numero_ci_estudiante" name="numero_ci_estudiante" 
                                        placeholder="Numero de C.I. del estudiante" value="{{ old('numero_ci_estudiante') }}"
                                        onKeyPress="if(this.value.length==11) return false;"
                                        tabindex="5" autocomplete="off"  required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="alfanumerico_ci_estudiante">Alfanumerico de C.I.</label>
                                <input type="text" class="form-control" value="{{ old('alfanumerico_ci_estudiante') }}"
                                        id="alfanumerico_ci_estudiante" name="alfanumerico_ci_estudiante" 
                                        placeholder="Opcional" onKeyPress="if(this.value.length==5) return false;"
                                        tabindex="6" autocomplete="off" >
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="extension_ci_estudiante" class="form-label">Extension</label>
                                <select class="form-select" name="extension_ci_estudiante" id="extension_ci_estudiante" required tabindex="7">
                                    <option value="" disabled selected>-- Seleccione la extension del carnet --</option>
                                    @foreach($arrayAux[0] as $ext)               
                                    <option value="{{$ext->subd_id}}">{{$ext->subd_nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5 mb-3">
                                <label for="numero_telefono_estudiante">Telefono o celular del estudiante</label>
                                <input type="number" class="form-control" value="{{ old('numero_telefono_estudiante') }}"
                                        id="numero_telefono_estudiante" name="numero_telefono_estudiante" 
                                        placeholder="Numero de telefono del estudiante" 
                                        onKeyPress="if(this.value.length==11) return false;"
                                        tabindex="8" autocomplete="off"  required>
                            </div>
                            <div class="col-md-7 mb-3">
                                <label for="correo_personal_estudiante">Correo personal del estudiante</label>
                                <input type="email" class="form-control"  value="{{ old('correo_personal_estudiante') }}"
                                        id="correo_personal_estudiante" name="correo_personal_estudiante" 
                                        placeholder="Servirá de acceso del estudiante hasta que se asigne un institucional"
                                        onKeyPress="if(this.value.length==50) return false;"
                                        tabindex="9" autocomplete="off"  required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <label for="domicilio_estudiante">Domicilio del estudiante</label>
                                <textarea name="domicilio_estudiante" type="text" class="form-control"
                                    id="domicilio_estudiante" autocomplete="off" 
                                    placeholder="Domicilio del estudiante"
                                    onKeyPress="if(this.value.length==100) return false;"
                                    style="height: 100px; resize: none;"
                                    required autocomplete="off"  tabindex="10">{{ old('domicilio_estudiante') }}</textarea><br>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="genero_estudiante">Genero del estudiante</label>
                                <select class="form-select" name="genero_estudiante" id="genero_estudiante" required tabindex="11">
                                    <option value="" disabled selected>-- Seleccione el genero del estudiante--</option>
                                    @foreach($arrayAux[2] as $gen)               
                                    <option value="{{$gen->subd_id}}">{{$gen->subd_nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <label for="comprobante_estudiante">Comprobante de deposito del estudiante</label>
                                <input name="comprobante_estudiante" type="file" 
                                        class="form-control" value="{{ old('comprobante_estudiante') }}"
                                        id="comprobante_estudiante" autocomplete="off" tabindex="12">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="anio_estudiante">Año en el que cursará el estudiante</label>
                                <select class="form-select" name="anio_estudiante" id="anio_estudiante" required tabindex="13">
                                    <option value="" disabled selected>-- Seleccione la gestión --</option>
                                    @foreach($arrayAux[3] as $sem)               
                                    <option value="{{$sem->sem_id}}">{{$sem->sem_nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="ua_estudiante">Unidad academica en la que se inscribirá</label>
                                <select class="form-select" name="ua_estudiante" id="ua_estudiante" required tabindex="14">
                                    @foreach($arrayAux[4] as $ua)               
                                    <option value="{{$ua->ua_id}}">{{$ua->ua_nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">
                        <span class="mdi mdi-account-plus"></span>&nbsp;Confirmar cambios
                    </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--**********Modal editar registro de persona - estudiante**********-->
    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="administracion/estudiante-nuevo" method="POST" enctype="multipart/form-data" id="editForm">
                    @csrf
                    @method('put')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editLabel">FORMULARIO DE REGISTRO DE ESTUDIANTE</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <label for="e_nombre_estudiante">Nombres</label>
                                <input type="text" class="form-control" 
                                        id="e_nombre_estudiante" name="e_nombre_estudiante" 
                                        placeholder="Nombres del estudiante" value="{{ old('e_nombre_estudiante') }}"
                                        onKeyPress="if(this.value.length==50) return false;" 
                                        tabindex="1" autocomplete="off" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="e_paterno_estudiante">Apellido Paterno</label>
                                <input type="text" class="form-control" 
                                        id="e_paterno_estudiante" name="e_paterno_estudiante" 
                                        placeholder="Apellido paterno del estudiante" value="{{ old('e_paterno_estudiante') }}"
                                        onKeyPress="if(this.value.length==50) return false;" 
                                        tabindex="2" autocomplete="off" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="e_materno_estudiante">Apellido Materno</label>
                                <input type="text" class="form-control" 
                                        id="e_materno_estudiante" name="e_materno_estudiante" 
                                        placeholder="Apellido materno del estudiante" value="{{ old('e_materno_estudiante') }}"
                                        onKeyPress="if(this.value.length==50) return false;"
                                        tabindex="3" autocomplete="off"  required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="e_fec_nacimiento_estudiante">Fecha de nacimiento</label>
                                <input type="date" class="form-control" 
                                        id="e_fec_nacimiento_estudiante" tabindex="4" 
                                        value="{{ old('e_fec_nacimiento_estudiante') }}" 
                                        name="e_fec_nacimiento_estudiante" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <label for="e_numero_ci_estudiante">Numero de cédula de identidad</label>
                                <input type="number" class="form-control" 
                                        id="e_numero_ci_estudiante" name="e_numero_ci_estudiante" 
                                        placeholder="Numero de C.I. del estudiante" value="{{ old('e_numero_ci_estudiante') }}"
                                        onKeyPress="if(this.value.length==11) return false;"
                                        tabindex="5" autocomplete="off"  required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="e_alfanumerico_ci_estudiante">Alfanumerico de C.I.</label>
                                <input type="text" class="form-control" value="{{ old('e_alfanumerico_ci_estudiante') }}"
                                        id="e_alfanumerico_ci_estudiante" name="e_alfanumerico_ci_estudiante" 
                                        placeholder="Opcional" onKeyPress="if(this.value.length==5) return false;"
                                        tabindex="6" autocomplete="off" >
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="e_extension_ci_estudiante" class="form-label">Extension</label>
                                <select class="form-select" name="e_extension_ci_estudiante" id="e_extension_ci_estudiante" required tabindex="7">
                                    <option value="{{ old('e_extension_ci_estudiante') }}"></option>
                                    @foreach($arrayAux[0] as $ext)               
                                    <option value="{{$ext->subd_id}}">{{$ext->subd_nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5 mb-3">
                                <label for="e_numero_telefono_estudiante">Telefono o celular del estudiante</label>
                                <input type="number" class="form-control" value="{{ old('e_numero_telefono_estudiante') }}"
                                        id="e_numero_telefono_estudiante" name="e_numero_telefono_estudiante" 
                                        placeholder="Numero de telefono del estudiante" 
                                        onKeyPress="if(this.value.length==11) return false;"
                                        tabindex="8" autocomplete="off"  required>
                            </div>
                            <div class="col-md-7 mb-3">
                                <label for="e_correo_personal_estudiante">Correo personal del estudiante</label>
                                <input type="email" class="form-control"  value="{{ old('e_correo_personal_estudiante') }}"
                                        id="e_correo_personal_estudiante" name="e_correo_personal_estudiante" 
                                        placeholder="Servirá de acceso del estudiante hasta que se asigne un institucional"
                                        onKeyPress="if(this.value.length==50) return false;"
                                        tabindex="9" autocomplete="off"  required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <label for="e_domicilio_estudiante">Domicilio del estudiante</label>
                                <textarea name="e_domicilio_estudiante" type="text" class="form-control"
                                    id="e_domicilio_estudiante" autocomplete="off" 
                                    placeholder="Domicilio del estudiante"
                                    onKeyPress="if(this.value.length==100) return false;"
                                    style="height: 100px; resize: none;"
                                    required autocomplete="off"  tabindex="10">{{ old('e_domicilio_estudiante') }}</textarea><br>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="e_genero_estudiante">Genero del estudiante</label>
                                <select class="form-select" name="e_genero_estudiante" id="e_genero_estudiante" required tabindex="11">
                                    <option value="{{ old('e_genero_estudiante') }}" selected></option>
                                    @foreach($arrayAux[2] as $gen)               
                                    <option value="{{$gen->subd_id}}">{{$gen->subd_nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <label for="e_comprobante_estudiante">Comprobante de deposito del estudiante</label>
                                <input name="e_comprobante_estudiante" type="file" 
                                        class="form-control" value="{{ old('e_comprobante_estudiante') }}"
                                        id="e_comprobante_estudiante" autocomplete="off" tabindex="12">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="e_anio_estudiante">Año en el que cursará el estudiante</label>
                                <select class="form-select" name="e_anio_estudiante" id="e_anio_estudiante" required tabindex="13">
                                    <option value="" disabled selected>-- Seleccione la gestión --</option>
                                    @foreach($arrayAux[3] as $sem)               
                                    <option value="{{$sem->sem_id}}">{{$sem->sem_nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="e_ua_estudiante">Unidad academica en la que se inscribirá</label>
                                <select class="form-select" name="e_ua_estudiante" id="e_ua_estudiante" required tabindex="14">
                                    @foreach($arrayAux[4] as $ua)               
                                    <option value="{{$ua->ua_id}}">{{$ua->ua_nombre}}</option>
                                    @endforeach
                                </select>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#estudiantes-encontrados').DataTable({
                "lengthMenu":[[10, 25, 50, -1], [10, 25, 50, "All"]],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
            });
        });
    </script>
    <script type="text/javascript">
        $("body").on("keydown", "input, select, textarea", function(e) {
            var self = $(this),
                form = self.parents("form:eq(0)"),
                focusable,
                next;
            
            if (e.keyCode == 13) {
                focusable = form.find("input,select,textarea").filter(":visible");
                next = focusable.eq(focusable.index(this) + 1);
                if (next.length) {
                    next.focus();
                }
                return false;
            }
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){   
            $(document).on('submit', '#formBusqueda', function() {
                var param = $('#busqueda_estudiante').val();
                $.ajax({  
                    method  : 'POST',
                    url     : "estudiante-buscar",
                    data    : $('#formBusqueda').serialize(),
                    success : function(res){
                        var array = JSON.parse(res);
                        if(array.length>0){
                            for(var i=0; i< array.length; i++){
                                var fila = '<tr><td style="display:none;">'+array[i].per_id+'</td>'
                                fila+='<td>'+array[i].name+'</td>';
                                fila+='<td>'+array[i].per_num_documentacion+'</td>';
                                fila+='<td style="display:none;">'+array[i].per_nombres+'</td>';
                                fila+='<td style="display:none;">'+array[i].per_paterno+'</td>';
                                fila+='<td style="display:none;">'+array[i].per_materno+'</td>';
                                fila+='<td style="display:none;">'+array[i].email+'</td>';
                                fila+='<td style="display:none;">'+array[i].per_subd_extension+'</td>';
                                fila+='<td><button class="btn btn-success edit"><span class="mdi mdi-account-plus"></span>&nbsp;Completar registro</button></td></tr>';
                                $('#cuerpoTabla').html(fila);
                            }
                        }
                        if(array.length<=0){
                            var fila = '<tr><td colspan="2" align="center">No existen registros de ese C.I.</td>';
                            fila+='<td><button class="btn btn-danger create" data-bs-toggle="modal" data-bs-target="#crear"><span class="mdi mdi-account-plus"></span>&nbsp;Crear nuevo registro</button></td></tr>';
                            $('#cuerpoTabla').html(fila);
                        }
                    },
                    error   : function(){
                        alert("hubo un error")
                    }
                })
                return false;
            });
        });
    </script>
     <script type="text/javascript">
        $(document).ready(function(){
            var table = $('#estudiantes-encontrados').DataTable();
            table.on('click', '.edit', function(){
                $tr = $(this).closest('tr');
                console.log($tr[0].children[7].innerText);
                var extens = parseInt($tr[0].children[7].innerText)+1;
                $('#e_numero_ci_estudiante').val($tr[0].children[2].innerText);
                $('#e_nombre_estudiante').val($tr[0].children[3].innerText);
                $('#e_paterno_estudiante').val($tr[0].children[4].innerText);
                $('#e_materno_estudiante').val($tr[0].children[5].innerText);
                $('#e_correo_personal_estudiante').val($tr[0].children[6].innerText);
                $("#e_extension_ci_estudiante option[value='"+extens+"']").attr("selected", true);
                $('#edit').modal('show');
                $('#editForm').attr('action', 'estudiante-nuevo/'+$tr[0].children[0].innerText);
          })
        });
    </script>
@endsection