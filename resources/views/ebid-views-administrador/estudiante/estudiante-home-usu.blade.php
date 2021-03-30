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
                            <div class="card-header bg-primary" style="font-size: 30px;">ESTUDIANTES - LISTA DE ESTUDIANTES PREINSCRITOS</div>
                        </div>
                    </div>
                </div>      
                <div class="card card-table-border-none" id="recent-orders">
                    <div class="card-header">
                        <div class="col-md-12 pb-3">
                            <h4 class="row">En este listado ud. verá la lista de estudiantes preinscritos de la institucion</h4>
                        </div><br>
                    </div>
                    <div class="card-body">
                        <table id="estudiante" class="table card-table table-responsive" style="width:100%; ">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre completo</th>
                                    <th>Cedula de identidad</th>
                                    <th>Numero de telefono</th>
                                    <th>Estado de estudiante</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($arrayAux[1] as $est)
                                <tr>
                                    <td class="">{{ $est->per_id }}</td>
                                    <td class="">{{ $est->name }}</td>
                                    <td class="">{{ $est->per_num_documentacion }}</td>
                                    <td class="">{{ $est->per_telefono }}</td>
                                    @foreach ($arrayAux[0] as $subd)
                                        @if ($subd->subd_id == $est->est_subd_estado)
                                            <td class="">{{ $subd->subd_nombre }}</td>
                                            @break
                                        @endif
                                    @endforeach
                                    <td style="width:200px">
                                            <button class="btn btn-success edit" id="edit">
                                                <span class="mdi mdi-circle-edit-outline"></span>&nbsp;Completar registro
                                            </button>
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
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    
    <script>
        $(document).ready(function() {
        $('#estudiante').DataTable({
                "lengthMenu":[[10, 25, 50, -1], [10, 25, 50, "All"]],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
            });
        } );
    </script>
    
    <script type="text/javascript">
        $(document).ready(function(){
            var table = $('#estudiante').DataTable();
            table.on('click', '.edit', function(){
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }
                var data = table.row($tr).data();
                var url = "{{ route('estudiante-nuevo.show', 'temp') }}";
                url = url.replace('temp', data[0]);
                window.open(url, '_blank');
            });
        });
    </script>

@endsection