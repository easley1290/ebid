@extends('ebid-views-administrador.componentes.main')
@section('contenido')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    

    <link href= "{{ asset('assets/fullcalendar/core/main.css') }}" rel='stylesheet' />
    <link href= "{{ asset('assets/fullcalendar/daygrid/main.css') }}"rel='stylesheet' />
    <link href= "{{ asset('assets/fullcalendar/timegrid/main.css') }}"rel='stylesheet' />
    <link href= "{{ asset('assets/fullcalendar/list/main.css') }}" rel='stylesheet' />
    <link href= "{{ asset('assets/assets/css/estilos.css') }}" rel='stylesheet' />

    <script src="{{ asset('assets/fullcalendar/core/main.js') }}"></script>
    <script src="{{ asset('assets/fullcalendar/daygrid/main.js') }}"></script>    
    <script src="{{ asset('assets/fullcalendar/interaction/main.js') }}"></script>
    <script src="{{ asset('assets/fullcalendar/timegrid/main.js') }}"></script>    
    <script src="{{ asset('assets/fullcalendar/list/main.js') }}"></script> 

    <meta name="csrf-token" content="{{ csrf_token() }}">
    
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
                            <div class="card-header bg-primary" style="font-size: 30px;">INSCRIPCION - CALENDARIO DE EXAMENES DE INGRESO A LA INSTITUCION</div>
                        </div>
                    </div>
                </div>
                <div class="card card-table-border-none" id="recent-orders">
                    <div class="card-header">
                        <div class="col-md-9"><h4 class="row">Se esta mostrando el calendario de examenes de ingreso</h4></div>
                        {{-- <div class="col-md-3"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                            <span class="mdi mdi-calendar-plus create"></span>&nbsp;Planificar fecha
                        </button></div> --}}
                    </div>
                    <div class="card card-default">
                        <div class="card-body p-0">
                            <div class="full-calendar">
                                <div id='calendar'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="crearModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header px-4">
                    <h5 class="modal-title" style="color: #1B223C" id="crearModalLabel">PLANIFICAR NUEVA FECHA DE EXAMEN</h5>
                    <button type="button" class="btn-close btn btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <div class="form-group">
                        <label for="estudiante" class="form-label">Estudiante que brindara su examen:</label>
                        <select class="form-select" name="estudiante" id="estudiante" required tabindex="1">
                            <option value="a" selected disabled>-- Seleccione el estudiante que brindará su examen --</option>
                            @foreach($estudiantes as $est)               
                            <option value="{{$est->est_id}}">{{ $est->name.' '.$est->per_num_documentacion }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="fecha">Fecha de examen</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="mdi mdi-calendar-range"></i></span>
                                    </div>
                                    <input type="date" class="form-control date-range" 
                                            name="fecha" id="fecha" 
                                            placeholder="Fecha de examen" required tabindex="2">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="hora">Hora de examen</label>
                                <select class="form-control" id="hora"  name="hora" required tabindex="3">
                                    <option value="10:00" selected>10:00</option>
                                    <option value="10:30" >10:30</option>
                                    <option value="11:00" >11:00</option>
                                    <option value="11:30" >11:30</option>
                                    <option value="12:00" >12:00</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="color">Color</label>
                                <input type="color" class="form-control date-range" 
                                        name="color" id="color" 
                                        required tabindex="4" value="#F34646">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="justify-content: space-between;">
                    <button type="button" class="btn btn-warning" id="btnCompletar" style="display: none;"><span class="mdi mdi-account-plus" ></span>&nbsp;Completar registro de estudiante</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><span class="mdi mdi-cancel"></span>&nbsp;Cancelar</button>
                    <button class="btn btn-primary" id="btnAgregar"><span class="mdi mdi-check"></span>&nbsp;Confirmar cambios</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
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
                            {{-- <div class="col-md-3 mb-3">
                                <label for="e_extension_ci_estudiante" class="form-label">Extension</label>
                                <select class="form-select" name="e_extension_ci_estudiante" id="e_extension_ci_estudiante" required tabindex="7">
                                    <option value="{{ old('e_extension_ci_estudiante') }}"></option>
                                    @foreach($arrayAux[0] as $ext)               
                                    <option value="{{$ext->subd_id}}">{{$ext->subd_nombre}}</option>
                                    @endforeach
                                </select>
                            </div> --}}
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
                            {{-- <div class="col-md-6 mb-3">
                                <label for="e_genero_estudiante">Genero del estudiante</label>
                                <select class="form-select" name="e_genero_estudiante" id="e_genero_estudiante" required tabindex="11">
                                    <option value="{{ old('e_genero_estudiante') }}" selected></option>
                                    @foreach($arrayAux[2] as $gen)               
                                    <option value="{{$gen->subd_id}}">{{$gen->subd_nombre}}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <label for="e_comprobante_estudiante">Comprobante de deposito del estudiante</label>
                                <input name="e_comprobante_estudiante" type="file" 
                                        class="form-control" value="{{ old('e_comprobante_estudiante') }}"
                                        id="e_comprobante_estudiante" autocomplete="off" tabindex="12">
                            </div>
                            {{-- <div class="col-md-3 mb-3">
                                <label for="e_anio_estudiante">Año en el que cursará el estudiante</label>
                                <select class="form-select" name="e_anio_estudiante" id="e_anio_estudiante" required tabindex="13">
                                    <option value="" disabled selected>-- Seleccione la gestión --</option>
                                    @foreach($arrayAux[3] as $sem)               
                                    <option value="{{$sem->sem_id}}">{{$sem->sem_nombre}}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            {{-- <div class="col-md-3 mb-3">
                                <label for="e_ua_estudiante">Unidad academica en la que se inscribirá</label>
                                <select class="form-select" name="e_ua_estudiante" id="e_ua_estudiante" required tabindex="14">
                                    @foreach($arrayAux[4] as $ua)               
                                    <option value="{{$ua->ua_id}}">{{$ua->ua_nombre}}</option>
                                    @endforeach
                                </select>
                            </div> --}}
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
    <script src="{{ asset('assets/assets/plugins/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('assets/assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['dayGrid','interaction','timeGrid','list'],
                header: {
                    left: 'prev today',
                    center: 'title',
                    right: 'today next'
                },
                dateClick: function(info){
                    console.log(info);
                    $('#fecha').val(info.dateStr);
                    $('#hora').val("10:00");
                    $('#estudiante').val("a");
                    $('#btnCompletar').css('display', 'none');
                    $('#createModal').modal('show');
                },
                eventClick: function(info){
                    var d = info.event.start;
                    if(parseInt((d.getMonth()+1)) <= 9){
                        if(parseInt(d.getDate()) <= 9){
                            var fecha = [d.getFullYear(), "0"+(d.getMonth()+1), "0"+(d.getDate())].join('-');
                        }
                        else{
                            var fecha = [d.getFullYear(), "0"+(d.getMonth()+1), d.getDate()].join('-');
                        }
                    }
                    else{
                        if(parseInt(d.getDate()) <= 9){
                            var fecha = [d.getFullYear(), "0"+(d.getMonth()+1), d.getDate()].join('-');
                        }
                        else{
                            var fecha = [d.getFullYear(), d.getMonth()+1, d.getDate()].join('-');
                        }
                    }
                    if(parseInt(d.getHours()) <= 9) {
                        if(parseInt(d.getMinutes()) <= 9){
                            var hora = ["0"+(d.getHours()), "0"+(d.getMinutes())].join(':');
                        }
                        else{
                            var hora = ["0"+(d.getHours()), (d.getMinutes())].join(':');
                        }
                    }
                    else{
                        if(parseInt(d.getMinutes()) <= 9){
                            var hora = [d.getHours(), "0"+(d.getMinutes())].join(':');
                        }
                        else{
                            var hora = [d.getHours(), (d.getMinutes())].join(':');
                        }
                    }
                    $('#fecha').val(fecha);
                    $('#hora').val(hora);
                    $('#estudiante').val(info.event.id);
                    $('#btnCompletar').css('display', 'block');
                    $('#createModal').modal('show');
                    $('#btnCompletar').click(function(){
                        
                    });
                },
                events: "{{ route('calendario-ingreso.show', 'b') }}"
            });

            calendar.setOption('locale', 'Es');
            calendar.render();

            $('#btnAgregar').click(function(){
                info = obtenerDatosExamen("POST");
                enviarInformacion(info);
            });

            function obtenerDatosExamen(method){
                examen={
                    est_id: $('#estudiante').val(),
                    est_examen_ingreso_fecha: $('#fecha').val()+" "+$('#hora').val(),
                    est_examen_ingreso_estado: 15,
                    est_examen_ingreso_color: $('#color').val(),
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    _method: method
                }
                return examen;
            }
            
            function enviarInformacion(informacion){
                $.ajax({
                    type: "POST",
                    url: "{{ route('calendario-ingreso.store') }}",
                    data: informacion,
                    success: function(res){
                        $('#createModal').modal('hide');
                        console.log(res);
                        $mensaje = "Postulante "+res[0].name+" la fecha programada par su examen de ingreso es: "+res[0].est_examen_ingreso_fecha;
                        $url = 'https://web.whatsapp.com/send?phone=591'+res[0].per_telefono+'&text='+$mensaje+'&app_absent=0';
                        window.open($url, "_blank");
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) { 
                        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                    }
                });
            }
        });
    </script>
@endsection