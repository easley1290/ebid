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
        @if (auth()->user()->per_rol == '1')
            <div class="row">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card text-white mb-3 bg-primary">
                            <div class="card-header bg-primary" style="font-size: 30px;">GESTION ACADÉMICA - PERMISOS PARA MODIFICAR NOTAS</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card card-default">
                        <div class="card-header card-header-border-bottom" style="justify-content: space-between;">
                            <div class="col-md-3">
                                <a href="{{ route('administracion.index') }}"><button type="button" class="btn btn-secondary"><span class="mdi mdi-arrow-left"></span>&nbsp;Regresar a inicio</button></a>
                            </div>
                            <div class="col-md-9">
                                <h4>En esta seccion podrá brindar permisos a los docentes para modificar las notas de los estudiantes</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('permisoModificarNotasMod') }}" method="POST">
                                @csrf
                                <div class="form-group row" style="justify-content: center;">
                                    <div class="col-md-4">
                                        <label for="indicador_materia">Escoja la materia</label>
                                        <select name="indicador_materia" id="indicador_materia" class="form-select">
                                            <option value="" disabled selected>--Seleccione la materia--</option>
                                            @foreach ($materias as $mat)
                                                <option value="{{ $mat->mat_id }}">{{ $mat->mat_nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="nombre_parcial">Escoja el parcial</label>
                                        <select name="nombre_parcial" id="nombre_parcial" class="form-select">
                                            <option value="" disabled selected>--Seleccione el parcial--</option>
                                            <option value="1">PRIMER PARCIAL</option>
                                            <option value="2">SEGUNDO PARCIAL</option>
                                            <option value="3">TERCER PARCIAL</option>
                                            <option value="4">CUARTO PARCIAL</option>
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="nombre_estudiante">Escoja al estudiante</label>
                                        <select name="nombre_estudiante" id="nombre_estudiante" class="form-select">
                                            <option value="" disabled selected>--Seleccione el estudiante--</option>
                                            @foreach ($estudiantes as $est)
                                                <option value="{{ $est->est_id }}">{{ $est->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row"  style="justify-content: center;">
                                    <button type="button" class="btn btn-warning col-md-5" data-bs-toggle="modal" data-bs-target="#avisoModal">
                                        <span class="mdi mdi-check"></span>&nbsp;BRINDAR PERMISOS PARA MODIFICAR NOTA</button>
                                </div>
                                <div class="modal fade" id="avisoModal" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="crearLabel"><b>ATENCION!!!</b></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Se brindará al (a los) docente(s) a cargo de la materia, la posibilidad de modificar la nota del parcial seleccionado</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><span class="mdi mdi-cancel"></span>&nbsp;Cerrar</button>
                                                <button type="submit" class="btn btn-primary"><span class="mdi mdi-folder-upload"></span>&nbsp;BRINDAR PERMISOS</button></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
@endsection