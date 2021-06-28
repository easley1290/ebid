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
                        <!--------------------------------------->
                    </div>
                    <div class="card-body">
                        @if (auth()->user()->per_rol == 1 || auth()->user()->per_rol == 10)
                        
                            <div class="col-md-9"><h3 class="row text-uppercase">Seleccione al estudiante y el año del cual desea sacar el informe de notas.</h3></div>
                            <br>
                            <form action="{{route('ImprimirNotas')}}" method="POST" id="formBusqueda" target="_blank">
                                @csrf
                                <div class="form-group row" style="justify-content: center;">
                                    <div class="col-md-4">
                                        <label for="codigo_estudiante">Seleccione al estudiante</label>
                                        <select class="form-select" name="codigo_estudiante" id="codigo_estudiante" required>
                                            <option value="" selected disabled>--Seleccione al estudiante--</option>
                                            @foreach($estudiantes as $est)   
                                                <option value="{{ $est->per_id }}">{{ $est->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="imprimir_anio">Seleccione el año</label>
                                        <select class="form-select" name="imprimir_anio" id="imprimir_anio" required>
                                            <option value="" selected disabled>--Seleccione el año--</option>
                                            @foreach($semestres as $sem)   
                                                <option value="{{ $sem->sem_id }}">{{ $sem->sem_nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 pt-4">
                                        <button type="submit" class="btn btn-secondary"><span class="mdi mdi-print"></span>&nbsp;Imprimir</button>
                                    </div>
                                </div>
                            </form>
                        @endif
                        @if (auth()->user()->per_rol == 3)
                        <form action="{{route('ImprimirNotas')}}" method="POST" id="formBusqueda" target="_blank">
                            @csrf
                            <div class="form-group row" style="justify-content: center;">
                                
                                <input type="hidden" name="codigo_estudiante" id="codigo_estudiante" value="{{ auth()->user()->per_id }}">
                                
                                <div class="col-md-4">
                                    <label for="imprimir_anio">Seleccione el año</label>
                                    <select class="form-select" name="imprimir_anio" id="imprimir_anio" required>
                                        <option value="" selected disabled>--Seleccione el año--</option>
                                        @foreach($semestres as $sem)   
                                            <option value="{{ $sem->sem_id }}">{{ $sem->sem_nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 pt-4">
                                    <button type="submit" class="btn btn-secondary"><span class="mdi mdi-print"></span>&nbsp;Imprimir</button>
                                </div>
                            </div>
                        </form>
                        

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div> 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

@endsection