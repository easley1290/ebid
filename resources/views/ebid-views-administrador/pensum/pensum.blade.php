@extends('ebid-views-administrador.componentes.main')
@section('contenido')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
                  <!-- Top Statistics -->
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
                              <div class="card-header bg-primary" style="font-size: 30px;">PENSUM - ADMINISTRACION DE PENSUMS</div>
                          </div>
                      </div>
                  </div>  
                  <div class="row">
                      <div class="col-md-12">
                          <div class="card card-table-border-none" id="recent-orders">
                            <div class="card-header">
                              <div class="col-md-12">
                                <div class="card text-white mb-3 bg-primary">
                                  <div class="bg-primary" style="font-size: 25px;text-align: center;">PENSUMS DE LAS ESPECIALIDADES DE DANZA</div>
                                </div>
                              </div>
                            </div>
                            <div class="card-body pt-0 pb-5">
                              <div class="row">
                                <div class="col-md-4">
                                  <button class="btn btn-warning btn-lg btn-block" data-bs-toggle="modal" data-bs-target="#basicasModal">
                                  <span class="mdi mdi-circle-edit-outline"></span>&nbsp;Basicas</button>
                                </div>
                                <div class="col-md-4">
                                  <button class="btn btn-warning btn-lg btn-block" data-bs-toggle="modal" data-bs-target="#cdModal">
                                  <span class="mdi mdi-circle-edit-outline"></span>&nbsp;Coreografía y dirección</button>
                                </div>
                                <div class="col-md-4">
                                  <button class="btn btn-warning btn-lg btn-block" data-bs-toggle="modal" data-bs-target="#pdModal">
                                  <span class="mdi mdi-circle-edit-outline"></span>&nbsp;Pedagogía de la danza</button>
                                </div>
                              </div>
                              <br>
                              <div class="row">
                                <div class="col-md-4">
                                  <button class="btn btn-warning btn-lg btn-block" data-bs-toggle="modal" data-bs-target="#dcModal">
                                  <span class="mdi mdi-circle-edit-outline"></span>&nbsp;Danza clásica</button>
                                </div>
                                <div class="col-md-4">
                                  <button class="btn btn-warning btn-lg btn-block" data-bs-toggle="modal" data-bs-target="#dfModal">
                                  <span class="mdi mdi-circle-edit-outline"></span>&nbsp;Danza folklórica</button>
                                </div>
                                <div class="col-md-4">
                                  <button class="btn btn-warning btn-lg btn-block" data-bs-toggle="modal" data-bs-target="#dmcModal">
                                  <span class="mdi mdi-circle-edit-outline"></span>&nbsp;Danza moderna-contemporánea</button>
                                </div>
                                <div class="col-md-2">
                                  
                                </div>
                              </div>
                            </div>
                          </div>                     
                      </div>
                  </div>          

                    <!-- Recent Order Table -->
                    <div class="card card-table-border-none" id="recent-orders">
                    <div class="card-header">
                          <div class="col-md-9"><h4 class="row">Tabla de materias en pensum de todas las carreras de la Intitución</h4></div>
                          <div class="col-md-3"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                              <span class="mdi mdi-comment-plus"></span>&nbsp;Agregar materia a pensum
                          </button></div>
                      </div>
                      <div class="card-body pt-0 pb-5">
                        <table id="pensums" class="table card-table table-responsive table-responsive-large" style="width:100%">
                          <thead>
                            <tr>
                              <th>Id</th>
                              <th>Especialidad</th>
                              <th>Carrera</th>
                              <th>Materia</th>
                              <th>Semestre</th>
                              <th style="display:none">Semestre</th>
                              <th style="display:none">pen_subd_estado</th>
                              <th style="width:200px">Acciones</th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach($aux[0] as $pensum)
                            <tr>
                                <td class="">{{ $pensum->pen_id}}</td>
                                @foreach ($aux[2] as $esp)
                                  @if ($esp->esp_id === $pensum->pen_esp_id)
                                    <td class="">{{ $esp->esp_nombre}}</td>
                                    @break
                                  @endif
                                @endforeach
                                @foreach ($aux[5] as $car)
                                  @if ($car->car_id === $pensum->pen_car_id)
                                    <td class="" >{{ $car->car_nombre}}</td>
                                    @break
                                  @endif
                                @endforeach
                                @foreach ($aux[3] as $materia)
                                  @if ($materia->mat_id === $pensum->pen_mat_id)
                                    <td class="">{{ $materia->mat_nombre }}</td>
                                    @break
                                  @endif
                                @endforeach
                                @foreach ($aux[4] as $semestre)
                                  @if ($semestre->sem_id === $pensum->pen_sem_id)
                                    <td class="">{{ $semestre->sem_nombre}}</td>
                                    @break
                                  @endif
                                @endforeach
                                <td class="" style="display:none">{{ $pensum->pen_sem_id}}</td>
                                <td class="" style="display:none">{{ $pensum->pen_subd_estado}}</td>
                                <td style="width:200px">
                                  <button class="btn btn-success edit">
                                    <span class="mdi mdi-circle-edit-outline"></span>&nbsp;Modificar</button>
                                  <button class="btn btn-danger delete">
                                    <span class="mdi mdi-circle-edit-outline"></span>&nbsp;Eliminar</button>
                                </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
            </div>

            <!-- Modal especialidad basicas-->
            <div class="modal fade" id="basicasModal" tabindex="-1" aria-labelledby="cdModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <div class="col-md-12">
                      <div class="card text-white mb-3 bg-primary">
                        <div class="bg-primary" style="font-size: 35px;text-align: center;">PENSUM DE LAS MATERIAS BASICAS</div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="col-md-12">
                          <div class="card text-white mb-3 bg-primary">
                            <div class="bg-primary" style="font-size: 30px;text-align: center;">PRIMER AÑO</div>
                          </div>
                        </div>
                        @foreach ($aux[6] as $materiasBas)
                          @foreach ($aux[3] as $materias)
                            @if ($materias->mat_id===$materiasBas->pen_mat_id)
                              <li type="disc" class="ml-4" style="font-size: 16px;">{{$materias->mat_nombre}}</li>
                            @endif
                          @endforeach
                        @endforeach
                      </div>
                      <div class="col-md-6">
                        <div class="col-md-12">
                          <div class="card text-white mb-3 bg-primary">
                            <div class="bg-primary" style="font-size: 30px;text-align: center;">SEGUNDO AÑO</div>
                          </div>
                        </div>
                        @foreach ($aux[7] as $materiasBas)
                          @foreach ($aux[3] as $materias)
                            @if ($materias->mat_id===$materiasBas->pen_mat_id)
                              <li type="disc" class="ml-4" style="font-size: 16px;">{{$materias->mat_nombre}}</li>
                            @endif
                          @endforeach
                        @endforeach
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="col-md-12">
                          <div class="card text-white mb-3 bg-primary">
                            <div class="bg-primary" style="font-size: 30px;text-align: center;">TERCER AÑO</div>
                          </div>
                        </div>
                        @foreach ($aux[8] as $materiasBas)
                        @foreach ($aux[3] as $materias)
                          @if ($materias->mat_id===$materiasBas->pen_mat_id)
                            <li type="disc" class="ml-4" style="font-size: 16px;">{{$materias->mat_nombre}}</li>
                          @endif
                        @endforeach
                        @endforeach
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal carrera CD-->
            <div class="modal fade" id="cdModal" tabindex="-1" aria-labelledby="cdModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <div class="col-md-12">
                      <div class="card text-white mb-3 bg-primary">
                        <div class="bg-primary" style="font-size: 35px;text-align: center;">PENSUM MENSION COREOGRAFÍA Y DIRECCIÓN</div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="col-md-12">
                          <div class="card text-white mb-3 bg-primary">
                            <div class="bg-primary" style="font-size: 30px;text-align: center;">CUARTO AÑO</div>
                          </div>
                        </div>
                        @foreach ($aux[9] as $materias_cd)
                          @foreach ($aux[3] as $materias)
                            @if ($materias->mat_id===$materias_cd->pen_mat_id)
                              <li type="disc" class="ml-4" style="font-size: 20px;">{{$materias->mat_nombre}}</li>
                            @endif
                          @endforeach
                        @endforeach
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>


            <!-- Modal carrera DC-->
            <div class="modal fade" id="dcModal" tabindex="-1" aria-labelledby="cdModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <div class="col-md-12">
                      <div class="card text-white mb-3 bg-primary">
                        <div class="bg-primary" style="font-size: 35px;text-align: center;">PENSUM - MENSION EN DANZA CLÁSICA</div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="col-md-12">
                          <div class="card text-white mb-3 bg-primary">
                            <div class="bg-primary" style="font-size: 30px;text-align: center;">CUARTO AÑO</div>
                          </div>
                        </div>
                        @foreach ($aux[10] as $materias_dc)
                          @foreach ($aux[3] as $materias)
                            @if ($materias->mat_id===$materias_dc->pen_mat_id)
                              <li type="disc" class="ml-4" style="font-size: 20px;">{{$materias->mat_nombre}}</li>
                            @endif
                          @endforeach
                        @endforeach
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal carrera DF-->
            <div class="modal fade" id="dfModal" tabindex="-1" aria-labelledby="cdModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <div class="col-md-12">
                      <div class="card text-white mb-3 bg-primary">
                        <div class="bg-primary" style="font-size: 35px;text-align: center;">PENSUM - MENSION EN DANZA FOLKLORICA</div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="col-md-12">
                          <div class="card text-white mb-3 bg-primary">
                            <div class="bg-primary" style="font-size: 30px;text-align: center;">CUARTO AÑO</div>
                          </div>
                        </div>
                        @foreach ($aux[11] as $materias_df)
                          @foreach ($aux[3] as $materias)
                            @if ($materias->mat_id===$materias_df->pen_mat_id)
                              <li type="disc" class="ml-4" style="font-size: 20px;">{{$materias->mat_nombre}}</li>
                            @endif
                          @endforeach
                        @endforeach
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal carrera DMC-->
            <div class="modal fade" id="dmcModal" tabindex="-1" aria-labelledby="cdModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <div class="col-md-12">
                      <div class="card text-white mb-3 bg-primary">
                        <div class="bg-primary" style="font-size: 35px;text-align: center;">PENSUM - MENSION EN DANZA MODERNA - CONTEMPORANEA</div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="col-md-12">
                          <div class="card text-white mb-3 bg-primary">
                            <div class="bg-primary" style="font-size: 30px;text-align: center;">CUARTO AÑO</div>
                          </div>
                        </div>
                        @foreach ($aux[12] as $materias_dmc)
                          @foreach ($aux[3] as $materias)
                            @if ($materias->mat_id===$materias_dmc->pen_mat_id)
                              <li type="disc" class="ml-4" style="font-size: 20px;">{{$materias->mat_nombre}}</li>
                            @endif
                          @endforeach
                        @endforeach
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal carrera PD-->
            <div class="modal fade" id="pdModal" tabindex="-1" aria-labelledby="cdModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <div class="col-md-12">
                      <div class="card text-white mb-3 bg-primary">
                        <div class="bg-primary" style="font-size: 35px;text-align: center;">PENSUM - MENSION EN PEDAGOGIA DE LA DANZA</div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="col-md-12">
                          <div class="card text-white mb-3 bg-primary">
                            <div class="bg-primary" style="font-size: 30px;text-align: center;">CUARTO AÑO</div>
                          </div>
                        </div>
                        @foreach ($aux[13] as $materias_pd)
                          @foreach ($aux[3] as $materias)
                            @if ($materias->mat_id === $materias_pd->pen_mat_id)
                              <li type="disc" class="ml-4" style="font-size: 20px;">{{$materias->mat_nombre}}</li>
                            @endif
                          @endforeach
                        @endforeach
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>
     
            <!-- Modal crear-->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar materia a un pensum</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="{{ route('Pensum.store') }}" method="POST">
                  {{ csrf_field() }}
                  <div class="modal-body">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Carrera</label>
                        <select class="form-select" aria-label="Default select example" name="pen_car_id" id="pen_car_id1">
                        @foreach($aux[5] as $carrera)               
                          <option value="{{$carrera->car_id}}">{{$carrera->car_nombre}}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="pen_esp_id" class="form-label">Especialidad</label>
                        <select class="form-select" aria-label="Default select example" name="pen_esp_id" id="pen_esp_id1">
                        @foreach($aux[2] as $esp)               
                          <option value="{{$esp->esp_id}}">{{$esp->esp_nombre}}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Materia</label>
                        <select class="form-select" aria-label="Default select example" name="pen_mat_id" id="pen_mat_id1">
                        @foreach($aux[3] as $materia)               
                          <option value="{{$materia->mat_id}}">{{$materia->mat_nombre}}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Semestre</label>
                        <select class="form-select" aria-label="Default select example" name="pen_sem_id" id="pen_sem_id1">
                        @foreach($aux[4] as $semestre)               
                          <option value="{{$semestre->sem_id}}">{{$semestre->sem_nombre}}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Estado</label>
                        <select class="form-select" aria-label="Default select example" name="pen_subd_estado" id="pen_subd_estado1">
                        @foreach($aux[1] as $subdominio)               
                          <option value="{{$subdominio->subd_id}}">{{$subdominio->subd_nombre}}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                      </div>
                    </div>
                    </form>
                </div>
              </div>
            </div>

            <!-- Modal editar-->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar materi en el Pensum</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="/Materia" method="POST" id="editForm"> <!-- {{route('Dominio.store')}} -->
                  {{ csrf_field() }}
                  {{ method_field('PUT') }}
                  <div class="modal-body">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Carrera</label>
                        <select class="form-select" aria-label="Default select example" name="pen_car_id" id="pen_car_id">
                        @foreach($aux[2] as $carrera)               
                          <option value="{{$carrera->car_id}}">{{$carrera->car_nombre}}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Materia</label>
                        <select class="form-select" aria-label="Default select example" name="pen_mat_id" id="pen_mat_id">
                        @foreach($aux[3] as $materia)               
                          <option value="{{$materia->mat_id}}">{{$materia->mat_nombre}}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Semestre</label>
                        <select class="form-select" aria-label="Default select example" name="pen_sem_id" id="pen_sem_id">
                        @foreach($aux[4] as $semestre)               
                          <option value="{{$semestre->sem_id}}">{{$semestre->sem_nombre}}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Estado</label>
                        <select class="form-select" aria-label="Default select example" name="pen_subd_estado" id="pen_subd_estado">
                        @foreach($aux[1] as $subdominio)               
                          <option value="{{$subdominio->subd_id}}">{{$subdominio->subd_nombre}}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                      </div>
                  </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- Modal eliminar-->
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar materia del pensum</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="/Materia" method="POST" id="deleteForm"> <!-- {{route('Dominio.store')}} -->
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <div class="modal-body">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Esta seguro de elimiar la materia del pensum?</label>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Borrar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                      </div>
                    </div>
                    </form>
                </div>
              </div>
            </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<script>
$(document).ready(function() {
  $('#pensums').DataTable({
        "lengthMenu":[[5, 10, 50, -1], [5, 10, 50, "All"]]
    });
} );
</script>

<!-- editar -->
<script type="text/javascript">
$(document).ready(function(){
  var table = $('#pensums').DataTable();
  table.on('click', '.edit', function(){
    $tr = $(this).closest('tr');
    if ($($tr).hasClass('child')) {
      $tr = $tr.prev('.parent');
    }
    var data = table.row($tr).data();
    console.log(data);
    $('#pen_car_id').val(data[2]);
    $('#pen_mat_id').val(data[4]);
    $('#pen_sem_id').val(data[6]);
    $('#pen_subd_estado').val(data[7]);

    $('#editForm').attr('action', '/Pensum/'+data[0]);
    $('#editModal').modal('show');
  })
});
</script>
<!-- eliminar -->
<script type="text/javascript">
$(document).ready(function(){
  var table = $('#pensums').DataTable();
  table.on('click', '.delete', function(){
    $tr = $(this).closest('tr');
    if ($($tr).hasClass('child')) {
      $tr = $tr.prev('.parent');
    }
    var data = table.row($tr).data();

    $('#deleteForm').attr('action', '/Pensum/'+data[0]);
    $('#deleteModal').modal('show');
  })
});
</script>

          
@endsection