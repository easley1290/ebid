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
            <div class="row">
                <div class="col-md-12">
                    <div class="card text-white mb-3 bg-primary">
                        <div class="card-header bg-primary" style="font-size: 30px;">INSCRIPCION - SUBIR COMPROBANTE</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom" style="justify-content: space-between;">
                        <h2>Asegurese de seleccionar el tipo de comprobante</h2>
                    </div>
                    <div class="card-body">
                        <form action="estudiante-buscar" method="POST" id="formBusqueda">
                            @csrf
                            <div class="form-group row" style="justify-content: center;">
                                <div class="col-md-6">
                                    <label for="busqueda_nombre">Busqueda de estudiante/postulante por nombre/CI</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-account-search"></i>
                                            </span>
                                        </div>
                                        <input type="text" id="busqueda_nombre" 
                                            name="busqueda_nombre" class="form-control"
                                            onKeyPress="if(this.value.length==100) return false;"
                                            placeholder="Ingrese apellidos/nombres/CI" autocomplete="off">
                                        <button type="submit" class="btn btn-primary"><span class="mdi mdi-account-search"></span>&nbsp;Buscar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="form-group row">
                            <table id="estudiante" class="table card-table table-responsive table-responsive-large" style="width:80%">
                                <thead>
                                    <tr>
                                        <th>Id estudiante</th>
                                        <th>Nombre completo</th>
                                        <th>Cedula de identidad</th>
                                        <th>Acciones</th>
                                        <th style="display: none;" colspan="5"></th>
                                    </tr>
                                </thead>
                                <tbody id="cuerpoTabla">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="create" tabindex="-1" aria-labelledby="crearLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="subir-comprobante" method="POST" enctype="multipart/form-data" id="createForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="crearLabel">FORMULARIO DE REGISTRO DE COMPROBANTE</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-4 mb-3">
                                <label for="nombre_estudiante">Nombres</label>
                                <input type="text" class="form-control" 
                                        id="nombre_estudiante" name="nombre_estudiante" 
                                        placeholder="Nombres del estudiante" value="{{ old('nombre_estudiante') }}"
                                        onKeyPress="if(this.value.length==50) return false;" 
                                        tabindex="1" autocomplete="off" required disabled>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="paterno_estudiante">Apellido Paterno</label>
                                <input type="text" class="form-control" 
                                        id="paterno_estudiante" name="paterno_estudiante" 
                                        placeholder="Apellido paterno del estudiante" value="{{ old('paterno_estudiante') }}"
                                        onKeyPress="if(this.value.length==50) return false;" 
                                        tabindex="2" autocomplete="off" required disabled>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="materno_estudiante">Apellido Materno</label>
                                <input type="text" class="form-control" 
                                        id="materno_estudiante" name="materno_estudiante" 
                                        placeholder="Apellido materno del estudiante" value="{{ old('materno_estudiante') }}"
                                        onKeyPress="if(this.value.length==50) return false;"
                                        tabindex="3" autocomplete="off"  required disabled>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="comprobante">Comprobante</label>
                                <input type="file" class="form-control" 
                                        id="comprobante" name="comprobante" 
                                        placeholder="Apellido materno del estudiante" value="{{ old('comprobante') }}"
                                        onKeyPress="if(this.value.length==50) return false;"
                                        tabindex="5" required>
                            </div>
                            <div class="col-md-12">
                            <label for="tipo_comprobante">Tipo de comprobante</label>
                            <select class="form-select form-control" name="tipo_comprobante" id="tipo_comprobante" required>
                                <option value="examen">Comprobante de EXAMEN DE INGRESO</option>
                                <option value="inscripcion" selected>Comprobante de INSCRIPCION</option>
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><span class="mdi mdi-cancel"></span>&nbsp;Cerrar</button>
                        <button type="submit" class="btn btn-primary">
                            <span class="mdi mdi-folder-upload"></span>&nbsp;Subir comprobante
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script>
      $(document).ready(function() {
          $('#estudiante').DataTable({
              "lengthMenu":[[10, 25, 50, -1], [10, 25, 50, "All"]],
              "language": {
                  "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
              },
          });
      });
  </script>
  <script type="text/javascript">
    $(document).ready(function(){   
        $(document).on('submit', '#formBusqueda', function() {
            var param = $('#busqueda_nombre').val();
            $.ajax({  
                method  : 'POST',
                url     : "estudiante-buscar",
                data    : $('#formBusqueda').serialize(),
                success : function(res){
                    var array = JSON.parse(res);
                    if(array.length>0){
                        for(var i=0; i< array.length; i++){
                            var fila = '<tr><td>'+array[i].est_id+'</td>'
                            fila+='<td>'+array[i].name+'</td>';
                            fila+='<td>'+array[i].per_num_documentacion+'</td>';
                            fila+='<td style="display:none;">'+array[i].per_nombres+'</td>';
                            fila+='<td style="display:none;">'+array[i].per_paterno+'</td>';
                            fila+='<td style="display:none;">'+array[i].per_materno+'</td>';
                            fila+='<td><button class="btn btn-success create"><span class="mdi mdi-folder-upload"></span>&nbsp;Subir comprobante</button></td></tr>';
                            $('#cuerpoTabla').html(fila);
                        }
                    }
                    if(array.length<=0){
                        var fila = '<tr><td colspan="3" align="center">No existen registros del nombre ingresado</td></tr>';
                        $('#cuerpoTabla').html(fila);
                    }
                },
                error   : function(){
                    alert("hubo un error")
                }
            })
            return false;
        });
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function(){
        var table = $('#estudiante').DataTable();
        table.on('click', '.create', function(){
            $tr = $(this).closest('tr');
            $('#nombre_estudiante').val($tr[0].children[3].innerText);
            $('#paterno_estudiante').val($tr[0].children[4].innerText);
            $('#materno_estudiante').val($tr[0].children[5].innerText);
            $('#create').modal('show');
            $('#createForm').attr('action', 'subir-comprobante/'+$tr[0].children[0].innerText);
      })
    });
</script>
@endsection