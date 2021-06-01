@extends('ebid-views-administrador.componentes.main')
@section('contenido')
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
    <div class="card card-default">
        <div class="card-header">
            <h1>SISTEMA INTERNO EBID</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div style="text-align: center;" class="mb-6">
                        <img src="{{ asset('assets/img/aaaa.jpg') }}" alt="" width="80%">
                    </div>
                    <h3 class="mb-1">Bienvenidos a nuestro sistema, le invitamos a navegar por nuestras opciones del menu disponible.</h3>
                    <h3 class="mb-6"><b>Actualmente nos encontramos en el parcial Nro.{{ $subdominios->subd_descripcion }}</b></h3>
                </div>
            </div>
            @if (auth()->user()->per_rol == '1')
                <div class="form-group row">
                    <div class="col-md-4">
                        <a href="{{ route('cerrarAbrirParcialVer') }}">
                            <div class="card text-white bg-primary">
                                <div class="card-header bg-primary" style="font-size: 20px"><b>ABRIR/CERRAR PARCIALES</b></div>
                                <div class="card-body">
                                    <p class="card-text" style="text-align: justify;">Con esta opcion ud. podrá cerrar los parciales, necesario para que los docentes puedan subir notas del parcial correspondiente.</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('permisoModificarNotasVer') }}">
                            <div class="card text-white bg-success">
                                <div class="card-header bg-success" style="font-size: 20px"><b>BRINDAR PERMISOS DE MODIFICACION DE NOTAS</b></div>
                                <div class="card-body">
                                    <p class="card-text" style="text-align: justify;">Con esta opcion ud. podrá brindar el permiso de modificar la nota del estudiante del parcial seleccionado.</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <button type="button" onclick="mostrar()">
                            <div class="card text-white bg-danger">
                                <div class="card-header bg-danger" style="font-size: 18px; text-align: left"><b>CERRAR GESTION ACADÉMICA</b></div>
                                <div class="card-body">
                                    <p class="card-text" style="text-align: justify;">Con esta opcion ud. cerrará el cuarto parcial y enviará a los estudiantes que tengan una nota de reprobacion en la nota final a segudo turno.</p>
                                </div>
                            </div>
                        </button>
                        <form action="{{ route('cerrarGestionAcademica') }}" method="POST">
                            @csrf
                            <div class="modal fade" id="seguroModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title mb-1" id="crearLabel"><b>ATENCION!!!</b></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Se cerrará la gestión académica, lo que provocará que los estudiantes reprobados en la nota final se redirijan a segundo turno</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="cerrar()"><span class="mdi mdi-cancel"></span>&nbsp;Cerrar</button>
                                            <button type="submit" class="btn btn-primary"><span class="mdi mdi-folder-upload"></span>&nbsp;CERRAR GESTION ACADEMICA</button></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <button type="button" onclick="mostrar2()">
                                <div class="card text-white bg-danger">
                                    <div class="card-header bg-danger" style="font-size: 18px; text-align: left"><b>CERRAR PERIODO SEGUNDO TURNO</b></div>
                                    <div class="card-body">
                                        <p class="card-text" style="text-align: justify;">Con esta opcion ud. cerrará el segundo turno.</p>
                                    </div>
                                </div>
                            </button>
                            <form action="{{ route('cerrarDosT') }}" method="POST">
                                @csrf
                                <div class="modal fade" id="segundoModal" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title mb-1" id="crearLabel"><b>ATENCION!!!</b></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Se cerrará el periodo de segundo turno, lo que provocará que los estudiantes reprobados en segundo turno entren en estado reprobados.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="cerrar2()"><span class="mdi mdi-cancel"></span>&nbsp;Cerrar</button>
                                                <button type="submit" class="btn btn-primary"><span class="mdi mdi-folder-upload"></span>&nbsp;CERRAR GESTION ACADEMICA</button></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
            @endif
        </div>
    </div>
    <script type="text/javascript">
        function mostrar(){
            $('#seguroModal').modal('show');
        }
        function cerrar(){
            $('#seguroModal').modal('hide');
        }
        function mostrar2(){
            $('#segundoModal').modal('show');
        }
        function cerrar2(){
            $('#segundoModal').modal('hide');
        }
    </script>
@endsection