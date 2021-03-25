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
                            <div class="card-header bg-primary" style="font-size: 30px;">INSCRIPCION - PRE INSCRIPCION</div>
                        </div>
                    </div>
                </div>
                     
                <div class="card card-table-border-none" id="recent-orders">
                    <div class="card-header card-header-border-bottom" style="justify-content: space-between;">
                        <a href="{{ route('postulante.index') }}">
                            <button type="button" class="btn btn-secondary">
                                <span class="mdi mdi-arrow-left"></span>&nbsp;Atras</button>
                        </a>
                        <h2>Pre inscripcion de estudiantes NUEVOS para dar el examen de admision</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('postulante.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-4 mb-4">
                                    <label for="nombres_estudiante">Nombres del postulante</label>
                                    <input id="nombres_estudiante" type="text" 
                                        class="form-control input-lg @error('nombres_estudiante') is-invalid @enderror" 
                                        name="nombres_estudiante" value="{{ old('nombres_estudiante') }}" 
                                        placeholder="Nombres del postulante" 
                                        onKeyPress="if(this.value.length==50) return false;"
                                        required autocomplete="off">
                                </div>
                                <div class="form-group col-md-4 mb-4">
                                    <label for="paterno_estudiante">Ap. Paterno del postulante</label>
                                    <input id="paterno_estudiante" type="text" 
                                            class="form-control input-lg @error('paterno_estudiante') is-invalid @enderror" 
                                            name="paterno_estudiante" value="{{ old('paterno_estudiante') }}" 
                                            placeholder="Apellido Paterno del postulante" 
                                            onKeyPress="if(this.value.length==50) return false;" 
                                            required autocomplete="off">
                                </div>
                                <div class="form-group col-md-4 mb-4">
                                    <label for="materno_estudiante">Ap. Materno del postulante</label>
                                    <input id="materno_estudiante" type="text" 
                                            class="form-control input-lg @error('materno_estudiante') is-invalid @enderror" 
                                            name="materno_estudiante" value="{{ old('materno_estudiante') }}" 
                                            placeholder="Apellido materno del postulante" 
                                            onKeyPress="if(this.value.length==50) return false;" 
                                            required autocomplete="off">
                                </div>
                                <div class="form-group col-md-5 mb-4">
                                    <label for="numero_ci_estudiante">Nro. C.I. del postulante</label>
                                    <input id="numero_ci_estudiante" type="number" 
                                            class="form-control input-lg @error('numero_ci_estudiante') is-invalid @enderror" 
                                            name="numero_ci_estudiante" value="{{ old('numero_ci_estudiante') }}" 
                                            placeholder="Numero de documento del postulante" 
                                            onKeyPress="if(this.value.length==11) return false;" 
                                            required autocomplete="off">
                                </div>
                                <div class="form-group col-md-3 mb-4">
                                    <label for="per_alfanumerico">Alfanumerico</label>
                                    <input id="per_alfanumerico" type="text" 
                                            class="form-control input-lg @error('per_alfanumerico') is-invalid @enderror" 
                                            name="per_alfanumerico" value="{{ old('per_alfanumerico') }}" 
                                            placeholder="Alfanumerico (Opcional)" 
                                            onKeyPress="if(this.value.length==4) return false;" 
                                            autocomplete="off">
                                </div>
                                <div class="form-group col-md-4 mb-4">
                                    <label for="extension_ci_estudiante">Extension</label>
                                    <select class="form-select form-control" name="extension_ci_estudiante" id="extension_ci_estudiante" required>
                                        <option value="" disabled selected>-- Seleccione la extension del carnet --</option>
                                        @foreach($extension as $ext)               
                                        <option value="{{$ext->subd_id}}">{{$ext->subd_nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6 mb-4">
                                    <label for="numero_telefono_estudiante">Celular del postulante</label>
                                    <input id="numero_telefono_estudiante" type="number" 
                                            class="form-control input-lg @error('numero_telefono_estudiante') is-invalid @enderror" 
                                            name="numero_telefono_estudiante" value="{{ old('numero_telefono_estudiante') }}" 
                                            placeholder="Celular con Whatsapp del postulante"
                                            onKeyPress="if(this.value.length==10) return false;" 
                                            required autocomplete="off">
                                </div>
                                <div class="form-group col-md-6 mb-4">
                                    <label for="email">Correo Personal del postulante</label>
                                    <input id="email" type="email" 
                                            class="form-control input-lg @error('email') is-invalid @enderror" 
                                            name="email" value="{{ old('email') }}" 
                                            placeholder="Correo personal del postulante" 
                                            onKeyPress="if(this.value.length==50) return false;"
                                            required autocomplete="off">
                                </div>
                                <div class="form-group col-md-12 ">
                                    <label for="password">Nueva contraseña</label>
                                    <input id="password" type="password" 
                                            class="form-control input-lg @error('password') is-invalid @enderror" 
                                            name="password" placeholder="Contraseña"
                                            required autocomplete="off">
                                </div>
                                <div class="form-group col-md-12 ">
                                    <label for="password">Repita la contraseña</label>
                                  <input id="password-confirm" type="password" class="form-control" 
                                        name="password_confirmation" placeholder="Confirmar Contraseña" 
                                        required autocomplete="off">
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-lg btn-primary btn-block mb-4" id="btnAgregar">Registrar est. pre inscrito</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script>
        $('#btnAgregar').click(function(){
            $mensaje = "Postulante "+$('#nombres_estudiante').val()+" "+$('#paterno_estudiante').val()+" "+$('#materno_estudiante').val()+" su registro ha sido completado";
            $mensaje+= "por el personal de EBID, el paso siguiente es realizar el deposito de Bs. 1 en el numero de cuenta XXXXXXXXXXXXXXXXXXX";
            $url = 'https://web.whatsapp.com/send?phone=591'+$('#numero_telefono_estudiante').val()+'&text='+$mensaje+'&app_absent=0';
            window.open($url, "_blank");
        });
    </script>
@endsection