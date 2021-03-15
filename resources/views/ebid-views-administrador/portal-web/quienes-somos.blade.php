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
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-header bg-primary" style="font-size: 30px;">PORTAL WEB - INFORMACION INSTITUCIONAL</div>
                        </div>
                    </div>
                     
                </div>
                     
                <div class="card card-table-border-none" id="recent-orders">
                    <div class="card-header justify-content-between">
                        <div class="col-md-9"> <h4 class="row">La informacion que esta viendo actualmente se mostrará en el portal web</h4></div>
                        <div class="col-md-3"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
                            <span class="mdi mdi-briefcase-edit"></span>&nbsp;Modificar informacion
                        </button></div>
                    </div>
                    <div class="card-body pt-0 pb-5 mt-50">
                        <div style="margin-left: 10px;">
                            <div class="form-group row">
                                <div class="col-md-8">
                                    <label for="inputNombre" class="form-label">Nombre de la instituci&oacute;n</label>
                                    <input name="inputNombre" type="text" class="form-control" 
                                        value="{{ $institucion->ins_nombre }}"
                                        id="inputNombre" autocomplete="off" 
                                        placeholder="Nombre de la institucion"
                                        onKeyPress="if(this.value.length==100) return false;"
                                        readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="inputFrase" class="form-label">Frase de la instituci&oacute;n</label>
                                    <input name="inputFrase" type="text" class="form-control"
                                        value="{{ $institucion->ins_frase }}"
                                        id="inputFrase" autocomplete="off" 
                                        placeholder="Frase de la institución"
                                        onKeyPress="if(this.value.length==100) return false;"
                                        readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="inputMision" class="form-label">Misi&oacute;n de la instituci&oacute;n</label>
                                    <textarea name="inputMision" type="text" class="form-control"
                                        id="inputMision" autocomplete="off" 
                                        placeholder="Mision de la institucion"
                                        onKeyPress="if(this.value.length==255) return false;"
                                        style="height: 100px; resize: none;"
                                        readonly>{{ $institucion->ins_mision }}</textarea><br>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputVision" class="form-label">Visi&oacute;n de la instituci&oacute;n</label>
                                    <textarea name="inputVision" type="text" class="form-control"
                                        id="inputVision" autocomplete="off" 
                                        placeholder="Vision de la institucion"
                                        onKeyPress="if(this.value.length==255) return false;"
                                        style="height: 100px; resize: none;"
                                        readonly>{{ $institucion->ins_vision }}</textarea><br>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="inputObjetivo" class="form-label">Objetivo de la instituci&oacute;n</label>
                                    <textarea name="inputObjetivo" type="text" class="form-control"
                                        id="inputObjetivo" autocomplete="off" 
                                        placeholder="Objetivo de la institucion"
                                        onKeyPress="if(this.value.length==255) return false;"
                                        style="height: 100px; resize: none;"
                                        readonly>{{ $institucion->ins_obj }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="inputObjetivo1" class="form-label">Objetivos especificos de la instituci&oacute;n</label>
                                    <textarea name="inputObjetivo1" type="text" class="form-control"
                                        id="inputObjetivo1" autocomplete="off" 
                                        placeholder="Primer objetivo especifico de la institucion"
                                        onKeyPress="if(this.value.length==255) return false;"
                                        style="height: 100px; resize: none;"
                                        readonly>{{ $institucion->ins_obj_esp1 }}</textarea><br>
                                    <textarea name="inputObjetivo2" type="text" class="form-control"
                                        id="inputObjetivo2" autocomplete="off" 
                                        placeholder="Segundo objetivo especifico de la institucion"
                                        onKeyPress="if(this.value.length==255) return false;"
                                        style="height: 100px; resize: none;"
                                        readonly>{{ $institucion->ins_obj_esp2 }}</textarea><br>
                                    <textarea name="inputObjetivo3" type="text" class="form-control"
                                        id="inputObjetivo3" autocomplete="off" 
                                        placeholder="Tercer objetivo especifico de la institucion"
                                        onKeyPress="if(this.value.length==255) return false;"
                                        style="height: 100px; resize: none;"
                                        readonly>{{ $institucion->ins_obj_esp3 }}</textarea><br>
                                    <textarea name="cuarto_obj_esp" type="text" class="form-control"
                                        id="cuarto_obj_esp" autocomplete="off" 
                                        placeholder="Cuarto objetivo especifico de la institucion"
                                        onKeyPress="if(this.value.length==255) return false;"
                                        style="height: 100px; resize: none;"
                                        readonly>{{ $institucion->ins_obj_esp4 }}</textarea><br>
                                    <textarea name="quinto_obj_esp" type="text" class="form-control"
                                        id="quinto_obj_esp" autocomplete="off" 
                                        placeholder="Quinto objetivo especifico de la institucion"
                                        onKeyPress="if(this.value.length==255) return false;"
                                        style="height: 100px; resize: none;"
                                        readonly>{{ $institucion->ins_obj_esp5 }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--**********Modal Editar**********-->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" style="color: #1B223C" id="editModalLabel">MODIFICAR INFORMACION DE LA INSTITUCION</h5>
              <button type="button" class="btn btn-danger btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('quienessomos.update', $institucion->ins_id) }}" method="POST">
                {{ csrf_field() }}
                @method('put')
                <div class="modal-body">
                    <div style="margin-left: 10px;">
                        <div class="form-group row">
                            <div class="col-md-8">
                                <label for="nombre_institucion" class="form-label">Nombre de la instituci&oacute;n</label>
                                <input name="nombre_institucion" type="text" class="form-control" 
                                    value="{{ $institucion->ins_nombre }}"
                                    id="nombre_institucion" autocomplete="off" 
                                    placeholder="Nombre de la institucion"
                                    onKeyPress="if(this.value.length==100) return false;"
                                    required>
                            </div>
                            <div class="col-md-4">
                                <label for="frase_institucion" class="form-label">Frase de la instituci&oacute;n</label>
                                <input name="frase_institucion" type="text" class="form-control"
                                    value="{{ $institucion->ins_frase }}"
                                    id="frase_institucion" autocomplete="off" 
                                    placeholder="Frase de la institución"
                                    onKeyPress="if(this.value.length==100) return false;"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="mision_institucion" class="form-label">Misi&oacute;n de la instituci&oacute;n</label>
                                <textarea name="mision_institucion" type="text" class="form-control"
                                    id="mision_institucion" autocomplete="off" 
                                    placeholder="Mision de la institucion"
                                    onKeyPress="if(this.value.length==255) return false;"
                                    style="height: 100px; resize: none;"
                                    required>{{ $institucion->ins_mision }}</textarea><br>
                            </div>
                            <div class="col-md-6">
                                <label for="vision_institucion" class="form-label">Visi&oacute;n de la instituci&oacute;n</label>
                                <textarea name="vision_institucion" type="text" class="form-control"
                                    id="vision_institucion" autocomplete="off" 
                                    placeholder="Vision de la institucion"
                                    onKeyPress="if(this.value.length==255) return false;"
                                    style="height: 100px; resize: none;"
                                    required>{{ $institucion->ins_vision }}</textarea><br>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="objetivo_institucion" class="form-label">Objetivo de la instituci&oacute;n</label>
                                <textarea name="objetivo_institucion" type="text" class="form-control"
                                    id="objetivo_institucion" autocomplete="off" 
                                    placeholder="Objetivo de la institucion"
                                    onKeyPress="if(this.value.length==255) return false;"
                                    style="height: 100px; resize: none;"
                                    required>{{ $institucion->ins_obj }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="primer_obj_esp" class="form-label">Objetivos especificos de la instituci&oacute;n</label>
                                <textarea name="primer_obj_esp" type="text" class="form-control"
                                    id="primer_obj_esp" autocomplete="off" 
                                    placeholder="Primer objetivo especifico de la institucion"
                                    onKeyPress="if(this.value.length==255) return false;"
                                    style="height: 100px; resize: none;">{{ $institucion->ins_obj_esp1 }}</textarea><br>
                                <textarea name="segundo_obj_esp" type="text" class="form-control"
                                    id="segundo_obj_esp" autocomplete="off" 
                                    placeholder="Segundo objetivo especifico de la institucion"
                                    onKeyPress="if(this.value.length==255) return false;"
                                    style="height: 100px; resize: none;">{{ $institucion->ins_obj_esp2 }}</textarea><br>
                                <textarea name="tercer_obj_esp" type="text" class="form-control"
                                    id="tercer_obj_esp" autocomplete="off" 
                                    placeholder="Tercer objetivo especifico de la institucion"
                                    onKeyPress="if(this.value.length==255) return false;"
                                    style="height: 100px; resize: none;">{{ $institucion->ins_obj_esp3 }}</textarea>
                                <textarea name="cuarto_obj_esp" type="text" class="form-control"
                                    id="cuarto_obj_esp" autocomplete="off" 
                                    placeholder="Cuarto objetivo especifico de la institucion"
                                    onKeyPress="if(this.value.length==255) return false;"
                                    style="height: 100px; resize: none;">{{ $institucion->ins_obj_esp4 }}</textarea>
                                <textarea name="quinto_obj_esp" type="text" class="form-control"
                                    id="quinto_obj_esp" autocomplete="off" 
                                    placeholder="Quinto objetivo especifico de la institucion"
                                    onKeyPress="if(this.value.length==255) return false;"
                                    style="height: 100px; resize: none;">{{ $institucion->ins_obj_esp5 }}</textarea>
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
    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
@endsection