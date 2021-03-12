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
                        <div class="card text-white mb-3" style="background-color: #9B4375;">
                            <div class="card-header" style="font-size: 30px; background-color: #9B4375;">PORTAL WEB - CONTACTOS DE LAS U.A.</div>
                        </div>
                    </div>
                     
                </div>
                     
                <div class="card card-table-border-none" id="recent-orders">
                    <div class="card-header justify-content-between">
                        <div class="col-md-9"> <h4 class="row">La informacion que se muestra actualmente, se mostrará en el portal web</h4></div>
                    </div>
                    <div class="card-body">
                        <table id="contactos" class="table card-table table-responsive" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Numeros de contacto</th>
                                    <th colspan="4" style="display: none;"></th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($arrayAux[0] as $ua)
                                <tr>
                                    <td class="">{{ $ua->ua_id}}</td>
                                    <td class="">{{ $ua->ua_nombre }}</td>
                                    <td class="">Telefono: {{ $ua->ua_telefono }}&nbsp;/&nbsp; Celular: {{ $ua->ua_celular }}</td>
                                    <td style="display: none;">{{ $ua->ua_direccion }}</td>
                                    <td style="display: none;">{{ $ua->ua_telefono }}</td>
                                    <td style="display: none;">{{ $ua->ua_celular }}</td>
                                    <td style="display: none;">{{ $ua->ua_correo_electronico }}</td>
                                    <td class="">
                                        <button class="btn btn-info see">
                                            <span class="mdi mdi-eye"></span>&nbsp;Ver más</button>
                                        <button class="btn btn-danger edit">
                                            <span class="mdi mdi-circle-edit-outline"></span>&nbsp;Editar contactos</button>
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

    <!--**********Modal ver contactos**********-->
    <div class="modal fade" id="verModal" tabindex="-1" aria-labelledby="verModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="color: #1B223C" id="verModalLabel"><label id="labelModal"></label></h5>
                    <button type="button" class="btn btn-danger btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div style="margin-left: 10px;">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="nombre_ua_e" class="form-label">Nombre de la unidad acad&eacute;mica</label>
                                <input name="nombre_ua_e" type="text" class="form-control"
                                    id="nombre_ua_e" autocomplete="off" 
                                    placeholder="Nombre de la U.A."
                                    onKeyPress="if(this.value.length==50) return false;"
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="direccion_ua_e" class="form-label">Dirección de la unidad académica</label>
                                <textarea name="direccion_ua_e" type="text" class="form-control"
                                    id="direccion_ua_e" autocomplete="off" 
                                    placeholder="Direccion de la U.A."
                                    onKeyPress="if(this.value.length==150) return false;"
                                    style="height: 100px; resize: none;"
                                    readonly></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="telefono_ua_e" class="form-label">Teléfono de la unidad académica</label>
                                <input name="telefono_ua_e" type="number" class="form-control"
                                    id="telefono_ua_e" autocomplete="off" 
                                    placeholder="Telefono de la U.A."
                                    onKeyPress="if(this.value.length==11) return false;"
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="celular_ua_e" class="form-label">Celular de la unidad académica</label>
                                <input name="celular_ua_e" type="number" class="form-control"
                                    id="celular_ua_e" autocomplete="off" 
                                    placeholder="Celular de la U.A."
                                    onKeyPress="if(this.value.length==11) return false;"
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="correo_electronico_ua_e" class="form-label">correo electrónico de la unidad académica</label>
                                <input name="correo_electronico_ua_e" type="text" class="form-control"
                                    id="correo_electronico_ua_e" autocomplete="off" 
                                    placeholder="Correo electronico de la U.A."
                                    onKeyPress="if(this.value.length==80) return false;"
                                    readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar ventana</button>
                </div>
            </div>
        </div>
    </div>

     <!--**********Modal editar contactos**********-->
     <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="verModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="color: #1B223C" id="verModalLabel"><label id="labelModalEdit"></label></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/administracion/contactos" method="POST" id="editForm">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div style="margin-left: 10px;">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="nombre_ua" class="form-label">Nombre de la unidad acad&eacute;mica</label>
                                    <input name="nombre_ua" type="text" class="form-control"
                                        id="nombre_ua" autocomplete="off" 
                                        placeholder="Nombre de la U.A."
                                        onKeyPress="if(this.value.length==50) return false;"
                                        readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="direccion_ua" class="form-label">Dirección de la unidad académica</label>
                                    <textarea name="direccion_ua" type="text" class="form-control"
                                        id="direccion_ua" autocomplete="off" 
                                        placeholder="Direccion de la U.A."
                                        onKeyPress="if(this.value.length==150) return false;"
                                        style="height: 100px; resize: none;"
                                        required></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="telefono_ua" class="form-label">Teléfono de la unidad académica</label>
                                    <input name="telefono_ua" type="number" class="form-control"
                                        id="telefono_ua" autocomplete="off" 
                                        placeholder="Telefono de la U.A."
                                        onKeyPress="if(this.value.length==11) return false;"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="celular_ua" class="form-label">Celular de la unidad académica</label>
                                    <input name="celular_ua" type="number" class="form-control"
                                        id="celular_ua" autocomplete="off" 
                                        placeholder="Celular de la U.A."
                                        onKeyPress="if(this.value.length==11) return false;"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="correo_electronico_ua" class="form-label">correo electrónico de la unidad académica</label>
                                    <input name="correo_electronico_ua" type="text" class="form-control"
                                        id="correo_electronico_ua" autocomplete="off" 
                                        placeholder="Correo electronico de la U.A."
                                        onKeyPress="if(this.value.length==80) return false;"
                                        required>
                                </div>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer></script>
    <script>
        $(document).ready(function() {
        $('#contactos').DataTable({
                "lengthMenu":[[10, 25, 50, -1], [10, 25, 50, "All"]]
            });
        } );
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            var table = $('#contactos').DataTable();
            table.on('click', '.see', function(){
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }
                var data = table.row($tr).data();
                $('#labelModal').text('MODIFICAR INFORMACION DE LOS CONTACTOS DE LA U.A. '+data[0]);
                $('#nombre_ua_e').val(data[1]);
                $('#direccion_ua_e').val(data[3]);
                $('#telefono_ua_e').val(data[4]);
                $('#celular_ua_e').val(data[5]);
                $('#correo_electronico_ua_e').val(data[6]);
                $('#verModal').modal('show');
          })
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            var table = $('#contactos').DataTable();
            table.on('click', '.edit', function(){
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }
                var data = table.row($tr).data();
                $('#labelModalEdit').text('MODIFICAR INFORMACION DE LOS CONTACTOS DE LA U.A. '+data[0]);
                $('#nombre_ua').val(data[1]);
                $('#direccion_ua').val(data[3]);
                $('#telefono_ua').val(data[4]);
                $('#celular_ua').val(data[5]);
                $('#correo_electronico_ua').val(data[6]);
                $('#editModal').modal('show');
                $('#editForm').attr('action', 'contactos/'+data[0]);
          })
        });
    </script>
@endsection