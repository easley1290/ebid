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
                            <div class="card-header bg-primary" style="font-size: 30px;">GESTION ACADÉMICA - CERRAR/ABRIR PARCIAL</div>
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
                                <h4 class="row">En esta seccion podrá cerrar o abrir un parcial, segun conveniencia</h4>
                                <h4 class="row"><b>RECUERDE: si abre un parcial los otros vigentes serán cerrados.</b></h4>
                            </div>
                            
                        </div>
                        <div class="card-body">
                            <form action="{{ route('cerrarAbrirParcialMod') }}" method="POST">
                                @csrf
                                <div class="form-group row" style="justify-content: center;">
                                    <div class="col-md-3">
                                        <label for="nombre_parcial">Escoja el parcial</label>
                                        <select name="nombre_parcial" id="nombre_parcial" class="form-select">
                                            <option value="" disabled selected>--Seleccione el parcial--</option>
                                            <option value="1">PRIMER PARCIAL</option>
                                            <option value="2">SEGUNDO PARCIAL</option>
                                            <option value="3">TERCER PARCIAL</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2"></div>
                                    <div class="col-md-4">
                                        <label for="indicador_parcial">Abrir o cerrar el parcial seleccionado</label>
                                        <select name="indicador_parcial" id="indicador_parcial" class="form-select">
                                            <option value="" disabled selected>--Abrir o cerrar el parcial--</option>
                                            <option value="ABRIR">ABRIR</option>
                                            <option value="CERRAR">CERRAR</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row"  style="justify-content: center;">
                                    <button type="button" class="btn btn-success col-md-5" data-bs-toggle="modal" data-bs-target="#avisoModal"><span class="mdi mdi-check"></span>&nbsp;CONFIRMAR CAMBIOS</button>
                                </div>
                                <div class="modal fade" id="avisoModal" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="crearLabel"><b>ATENCION!!!</b></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body"><p>Se abrirá/cerrará el parcial seleccionado</p> <br>
                                                <p><b>RECUERDE: Si abre el parcial seleccionado los docentes subiran notas correspondientes a ese parcial lo pude que ocasione errores</b></p><br>
                                                <p>Se recomienda cerrar solamente parciales</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><span class="mdi mdi-cancel"></span>&nbsp;Cerrar</button>
                                                <button type="submit" class="btn btn-primary"><span class="mdi mdi-folder-upload"></span>&nbsp;ABRIR O CERRAR EL PARCIAL</button></div>
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