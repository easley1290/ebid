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
                            <div class="card-header bg-primary" style="font-size: 30px;">INSCRIPCION - LISTA DE POSTULANTES</div>
                        </div>
                    </div>
                </div>
                     
                <div class="card card-table-border-none" id="recent-orders">
                    <div class="card-header">
                        <div class="col-md-9"><h4 class="row">Se esta mostrando la lista de postulantes a la institucion</h4></div>
                        <div class="col-md-3"><a href="{{ route('postulante.create') }}"><button type="button" class="btn btn-primary">
                            <span class="mdi mdi-comment-plus"></span>&nbsp;Registrar nuevo postulante
                        </button></a></div>
                    </div>
                    <div class="card-body">
                        <table id="postulante" class="table card-table table-responsive" style="width:100%; ">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre completo</th>
                                    <th>Telefono/Celular</th>
                                    <th>Fecha de Examen</th>
                                    <th>Estado</th>
                                    <th colspan="6" style="display: none"></th>
                                    <th>Acciones</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($arrayAux[0] as $postulante)
                                    <tr>
                                        <td class="">{{ $postulante->per_id}}</td>
                                        <td class="">{{ $postulante->name }}</td>
                                        <td class="">{{ $postulante->per_telefono }}</td>
                                        @if ($arrayAux[4]==0)
                                            <td class="">No se registro fecha de examen</td>
                                        @else
                                            @foreach($arrayAux[3] as $examen)
                                                @if($examen->exa_per_id === $postulante->per_id)
                                                    <td class="">{{ $examen->exa_fecha }}</td>
                                                @endif
                                            @endforeach
                                        @endif
                                        @foreach($arrayAux[2] as $subd)
                                            @if($subd->subd_id === $postulante->est_subd_estado)
                                                <td class="">{{ $subd->subd_nombre }}</td>
                                            @endif
                                        @endforeach
                                        <td style="display: none;">{{ $postulante->per_nombres }}</td>
                                        <td style="display: none;">{{ $postulante->per_paterno }}</td>
                                        <td style="display: none;">{{ $postulante->per_materno }}</td>
                                        <td style="display: none;">{{ $postulante->per_num_documentacion }}</td>
                                        <td style="display: none;">{{ $postulante->per_subd_extension }}</td>
                                        <td style="display: none;">{{ $postulante->email }}</td>
                                        <td class="">
                                            <button class="btn btn-success edit">
                                                <span class="mdi mdi-circle-edit-outline"></span>&nbsp;Modificar</button>
                                            <button class="btn btn-danger delete">
                                                <span class="mdi mdi-delete"></span>&nbsp;Eliminar</button>
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

    <!--**********Modal editar postulante**********-->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="color: #1B223C" id="editModalLabel">MODIFICAR REGISTRO DE POSTULANTE</h5>
                    <button type="button" class="btn-close btn btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="administracion/postulante" method="POST" id="editForm">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12 mb-4">
                                <label for="nombres_estudiante">Nombres del postulante</label>
                                <input id="nombres_estudiante" type="text" 
                                    class="form-control input-lg @error('nombres_estudiante') is-invalid @enderror" 
                                    name="nombres_estudiante" value="{{ old('nombres_estudiante') }}" 
                                    placeholder="Nombres del postulante" 
                                    onKeyPress="if(this.value.length==50) return false;"
                                    required autocomplete="off">
                            </div>
                            <div class="form-group col-md-12 mb-4">
                                <label for="paterno_estudiante">Ap. Paterno del postulante</label>
                                <input id="paterno_estudiante" type="text" 
                                        class="form-control input-lg @error('paterno_estudiante') is-invalid @enderror" 
                                        name="paterno_estudiante" value="{{ old('paterno_estudiante') }}" 
                                        placeholder="Apellido Paterno del postulante" 
                                        onKeyPress="if(this.value.length==50) return false;" 
                                        required autocomplete="off">
                            </div>
                            <div class="form-group col-md-12 mb-4">
                                <label for="materno_estudiante">Ap. Materno del postulante</label>
                                <input id="materno_estudiante" type="text" 
                                        class="form-control input-lg @error('materno_estudiante') is-invalid @enderror" 
                                        name="materno_estudiante" value="{{ old('materno_estudiante') }}" 
                                        placeholder="Apellido materno del postulante" 
                                        onKeyPress="if(this.value.length==50) return false;" 
                                        required autocomplete="off">
                            </div>
                            <div class="form-group col-md-7 mb-4">
                                <label for="numero_ci_estudiante">Nro. C.I. del postulante</label>
                                <input id="numero_ci_estudiante" type="text" 
                                        class="form-control input-lg @error('numero_ci_estudiante') is-invalid @enderror" 
                                        name="numero_ci_estudiante" value="{{ old('numero_ci_estudiante') }}" 
                                        placeholder="Numero de documento del postulante" 
                                        onKeyPress="if(this.value.length==11) return false;" 
                                        required autocomplete="off">
                            </div>
                            <div class="form-group col-md-5 mb-4">
                                <label for="extension_ci_estudiante">Extension</label>
                                <select class="form-select form-control" name="extension_ci_estudiante" id="extension_ci_estudiante" required>
                                    @foreach($arrayAux[5] as $ext)               
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
                                <label for="email">Correo electronico</label>
                                <input id="email" type="email" 
                                        class="form-control input-lg @error('email') is-invalid @enderror" 
                                        name="email" value="{{ old('email') }}" 
                                        placeholder="Correo personal del postulante" 
                                        onKeyPress="if(this.value.length==50) return false;"
                                        required autocomplete="off">
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

    <!--**********Modal eliminar postulante**********-->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">ELIMINAR REGISTRO DE POSTULANTE</h5>
                    <button type="button" class="btn-close btn btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="administracion/postulante" method="POST" id="deleteForm">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <div class="mb-3">
                            <p>Esta seguro de eliminar este registro????</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><span class="mdi mdi-cancel"></span>&nbsp;Cancelar</button>
                            <button type="submit" class="btn btn-primary"><span class="mdi mdi-check"></span>&nbsp;Confirmar cambios</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script>
        $(document).ready(function() {
        $('#postulante').DataTable({
                "lengthMenu":[[10, 25, 50, -1], [10, 25, 50, "All"]],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
            });
        } );
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            var table = $('#postulante').DataTable();
            table.on('click', '.edit', function(){
                $tr = $(this).closest('tr');
                var extens = parseInt($tr[0].children[9].innerText);
                $('#nombres_estudiante').val($tr[0].children[5].innerText);
                $('#paterno_estudiante').val($tr[0].children[6].innerText);
                $('#materno_estudiante').val($tr[0].children[7].innerText);
                $('#numero_ci_estudiante').val($tr[0].children[8].innerText);
                $("#extension_ci_estudiante option[value='"+extens+"']").attr("selected", true);
                $('#numero_telefono_estudiante').val(parseInt($tr[0].children[2].innerText));
                $('#email').val($tr[0].children[10].innerText);
                $('#editModal').modal('show');
                $('#editForm').attr('action', 'postulante/'+$tr[0].children[0].innerText);
          })
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            var table = $('#postulante').DataTable();
            table.on('click', '.delete', function(){
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }
                var data = table.row($tr).data();
                $('#deleteModal').modal('show');
                $('#deleteForm').attr('action', 'postulante/'+data[0]);
            })
        });
    </script>

@endsection