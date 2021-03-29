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
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header px-4">
                    <h5 class="modal-title" style="color: #1B223C" id="crearModalLabel"></h5>
                    <button type="button" class="btn-close btn btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <div class="form-group">
                        <label for="estudiante" class="form-label">Postulante que brindara su examen:</label>
                        <select class="form-select" name="estudiante" id="estudiante" required tabindex="1">
                            <option value="a" selected disabled>-- Seleccione el postulante que brindará su examen --</option>
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
                    <div id="cestudiante">
                        
                    </div>
                    <div id="sestudiante">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><span class="mdi mdi-cancel"></span>&nbsp;Cancelar</button>
                        <button class="btn btn-primary" id="btnAgregar"><span class="mdi mdi-check"></span>&nbsp;Confirmar cambios</button>
                    </div>
                </div>
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
                    $('#fecha').val(info.dateStr);
                    $('#hora').val("10:00");
                    $('#estudiante').val("a");
                    $('#cestudiante').html("");
                    
                    $('#crearModalLabel').text('PLANIFICAR FECHA DE EXAMEN');
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
                    $('#crearModalLabel').text('DETALLES DEL EXAMEN');
                    $('#createModal').modal('show');
                    
                    var fila = '<a href="" id="aBtnAprobar"><button type="button" class="btn btn-success" id="btnAprobar">';
                    fila+='<span class="mdi mdi-account-plus" ></span>&nbsp;Aprobar examen</button></a>&nbsp;';
                    $('#cestudiante').html(fila);
                    $('#btnAprobar').click(function(){
                        var valorId = $('#estudiante').val();
                        var url = "{{ route('estudiante-nuevo.edit', 'temp') }}";
                        url = url.replace('temp', valorId);
                        window.open(url, '_blank');
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
                        $mensaje = "Postulante "+res[0].name+" la fecha programada par su examen de ingreso es: "+res[0].est_examen_ingreso_fecha;
                        $url = 'https://web.whatsapp.com/send?phone=591'+res[0].per_telefono+'&text='+$mensaje+'&app_absent=0';
                        window.open($url, "_blank");
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) { 
                        alert('Hubo un error, actualice la pagina');
                    }
                });
            }
        });
    </script>
@endsection