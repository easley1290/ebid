@extends('ebid-views-administrador.componentes.main')
@section('contenido')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
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
                        <div class="card-header bg-primary" style="font-size: 30px;">PERFIL DE ESTUDIANTE</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card card-default">            
                    @if (auth()->user()->per_rol<=3 || auth()->user()->per_id == $datos->per_id)
                    <div class="card-body">
                        <form action="{{ route('estudiante-nuevo-est.store') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="nombre_estudiante">Nombres</label>
                                    <input type="text" class="form-control" 
                                            id="nombre_estudiante" name="nombre_estudiante" 
                                            placeholder="Nombres del estudiante" value="{{ $datos->per_nombres }}"
                                            onKeyPress="if(this.value.length==50) return false;" 
                                            tabindex="1" autocomplete="off" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="paterno_estudiante">Apellido Paterno</label>
                                    <input type="text" class="form-control" 
                                            id="paterno_estudiante" name="paterno_estudiante" 
                                            placeholder="Apellido paterno del estudiante" value="{{ $datos->per_paterno }}"
                                            onKeyPress="if(this.value.length==50) return false;" 
                                            tabindex="2" autocomplete="off" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="materno_estudiante">Apellido Materno</label>
                                    <input type="text" class="form-control" 
                                            id="materno_estudiante" name="materno_estudiante" 
                                            placeholder="Apellido materno del estudiante" value="{{ $datos->per_materno }}"
                                            onKeyPress="if(this.value.length==50) return false;"
                                            tabindex="3" autocomplete="off"  required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-5 mb-3">
                                    <label for="numero_ci_estudiante">Numero de cédula de identidad</label>
                                    <input type="text" class="form-control" 
                                            id="numero_ci_estudiante" name="numero_ci_estudiante" 
                                            placeholder="Numero de C.I. del estudiante" value="{{ $datos->per_num_documentacion }}"
                                            onKeyPress="if(this.value.length==20) return false;"
                                            tabindex="4" autocomplete="off"  required>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="extension_ci_estudiante" class="form-label">Extension</label>
                                    <select class="form-select" name="extension_ci_estudiante" id="extension_ci_estudiante" required tabindex="5">
                                        @if ($nombreExt != null)
                                            <option value="{{ $datos->per_subd_extension }}" selected>{{ $nombreExt->subd_nombre }}</option>
                                        @endif
                                        @foreach($extension as $ext)               
                                            <option value="{{$ext->subd_id}}">{{$ext->subd_nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-5 mb-3">
                                    <label for="fec_nacimiento_estudiante">Fecha de nacimiento</label>
                                    <input type="date" class="form-control" 
                                            id="fec_nacimiento_estudiante" tabindex="6" 
                                            value="{{ $datos->per_fecha_nacimiento }}" 
                                            name="fec_nacimiento_estudiante" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-5 mb-3">
                                    <label for="numero_telefono_estudiante">Telefono o celular del estudiante</label>
                                    <input type="number" class="form-control" value="{{ $datos->per_telefono }}"
                                            id="numero_telefono_estudiante" name="numero_telefono_estudiante" 
                                            placeholder="Numero de telefono del estudiante" 
                                            onKeyPress="if(this.value.length==11) return false;"
                                            tabindex="7" autocomplete="off"  required>
                                </div>
                                <div class="col-md-7 mb-3">
                                    <label for="correo_personal_estudiante">Correo personal del estudiante</label>
                                    <input type="email" class="form-control"  value="{{ $datos->email }}"
                                            id="correo_personal_estudiante" name="correo_personal_estudiante" 
                                            placeholder="Servirá de acceso del estudiante hasta que se asigne un institucional"
                                            onKeyPress="if(this.value.length==50) return false;"
                                            tabindex="8" autocomplete="off"  required>
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
                                        required autocomplete="off"  tabindex="9">{{ $datos->per_domicilio }}</textarea><br>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="genero_estudiante">Genero del estudiante</label>
                                    <select class="form-select" name="genero_estudiante" id="genero_estudiante" required tabindex="10">
                                        @if ($nombreGen != null)
                                            <option value="{{ $datos->per_subd_genero }}" selected>{{ $nombreGen->subd_nombre }}</option>
                                        @else
                                            <option value="" disabled selected>-- Seleccione el genero --</option>
                                        @endif
                                        @foreach($genero as $gen)               
                                            <option value="{{$gen->subd_id}}">{{$gen->subd_nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 mb-3">
                                    <label for="nombre_tutor">Nombre completo de madre/padre/tutor</label>
                                    <input type="text" class="form-control" value="{{ $datos->est_nombre_tutor }}"
                                            id="nombre_tutor" name="nombre_tutor" 
                                            placeholder="Nombre del madre/padre/tutor" 
                                            onKeyPress="if(this.value.length==150) return false;"
                                            tabindex="11" autocomplete="off" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="telefono_tutor">Telefono de referencia de madre/padre/tutor</label>
                                    <input type="number" class="form-control" value="{{ $datos->est_telefono_tutor }}"
                                            id="telefono_tutor" name="telefono_tutor" 
                                            placeholder="Numero de telefono de madre/padre/tutor" 
                                            onKeyPress="if(this.value.length==11) return false;"
                                            tabindex="12" autocomplete="off" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="domicilio_tutor">Domiciliio de madre/padre/tutor</label>
                                    <textarea name="domicilio_tutor" type="text" class="form-control"
                                        id="domicilio_tutor" autocomplete="off" 
                                        placeholder="Domicilio de madre/padre/tutor"
                                        onKeyPress="if(this.value.length==100) return false;"
                                        style="height: 100px; resize: none;"
                                        required autocomplete="off"  tabindex="13">{{ $datos->est_domicilio_tutor }}</textarea><br>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="ocupacion_tutor">Ocupacion de madre/padre/tutor</label>
                                    <input type="text" class="form-control" value="{{ $datos->est_ocupacion_tutor }}"
                                            id="ocupacion_tutor" name="ocupacion_tutor" 
                                            placeholder="Ocupacion de madre/padre/tutor" 
                                            onKeyPress="if(this.value.length==20) return false;"
                                            tabindex="14" autocomplete="off"  required>
                                </div>
                            </div>
                            
                            <div style="float: right;">
                                <button type="button"  class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmar"><span class="mdi mdi-check" ></span>&nbsp;REGISTRAR DATOS</button>
                            </div>

                            <div class="modal fade" id="confirmar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">CONFIRMAR REGISTRO</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                            <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Esta seguro de los datos ingresados?</label>
                                            </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">CONFIRMAR DATOS</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
@endsection