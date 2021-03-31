@extends('ebid-views-administrador.componentes.link')
</head>
<body class="header-fixed sidebar-fixed sidebar-dark header-light sidebar-minified-out" id="body">
  
  <div class="wrapper">
        <aside class="left-sidebar bg-sidebar">
          <div id="sidebar" class="sidebar">
            <!-- Aplication Brand -->
            <div class="app-brand">
              <a href="/administracion" >
                <img src="{{ asset('assets/img/logo.png') }}" alt="" style="height: 50px;" class="img-fluid">
                <span class="brand-name text-truncate">EBID</span>
              </a>
            </div>
            <!-- begin sidebar scrollbar -->
            <div class="sidebar-scrollbar">
              <!-- sidebar menu -->
              <ul class="nav sidebar-inner" id="sidebar-menu">
                  <!----------------------------INICIO---------------------------------->
                  <li  class="has-sub" >
                    <a class="sidenav-item-link" href="/public/administracion">
                      <i class="mdi mdi-home"></i>
                      <span class="nav-text">Inicio</span>
                    </a>
                  </li>
                  <!----------------------------PORTAL---------------------------------->
                  @if (auth()->user()->per_rol == 1)
                  <li  class="has-sub" >
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#portal"
                      aria-expanded="false" aria-controls="portal">
                      <i class="mdi mdi-monitor"></i>
                      <span class="nav-text">Admín. Portal web</span> <b class="caret"></b>
                    </a>
                    <ul  class="collapse"  id="portal"
                      data-parent="#sidebar-menu">
                      <div class="sub-menu">
                            <li>
                              <a class="sidenav-item-link" href="{{ route('quienessomos.index') }}">
                                <span class="nav-text">Quienes Somos</span>
                              </a>
                            </li>
                            <li>
                              <a class="sidenav-item-link" href="{{ route('noticias.index') }}">
                                <span class="nav-text">Noticias</span>                             
                              </a>
                            </li> 
                            <li>
                              <a class="sidenav-item-link" href="{{ route('galeria.index') }}">
                                <span class="nav-text">Galeria</span>                             
                              </a>
                            </li>
                            <li>
                              <a class="sidenav-item-link" href="{{ route('videos.index') }}">
                                <span class="nav-text">Videos</span>                             
                              </a>
                            </li>
                            <li>
                              <a class="sidenav-item-link" href="{{ route('contactos.index') }}">
                                <span class="nav-text">Contactos</span>                             
                              </a>
                            </li>   
                      </div>
                    </ul>
                  </li>
                  
                  <!----------------------------ORGANIZACIÓN---------------------------------->
                  <li  class="has-sub" >
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#materias"
                      aria-expanded="false" aria-controls="materias">
                      <i class="mdi mdi-school"></i>
                      <span class="nav-text">Organización Académica</span> <b class="caret"></b>
                    </a>
                    <ul  class="collapse"  id="materias"
                      data-parent="#sidebar-menu">
                      <div class="sub-menu">
                            <li>
                              <a class="sidenav-item-link" href="{{ route('UnidadAcademica.index') }}">
                                <span class="nav-text">Unidad Académica</span>
                              </a>
                            </li>
                            <li>
                              <a class="sidenav-item-link" href="{{ route('Especialidad.index') }}">
                                <span class="nav-text">Especialidades</span>
                              </a>
                            </li>
                            <li>
                              <a class="sidenav-item-link" href="{{ route('Carrera.index') }}">
                                <span class="nav-text">Carreras</span>
                              </a>
                            </li>
                            <li >
                              <a class="sidenav-item-link" href="{{ route('Semestre.index') }}">
                                <span class="nav-text">Semestres</span>                             
                              </a>
                            </li> 
                            <li >
                              <a class="sidenav-item-link" href="{{ route('Materia.index') }}">
                                <span class="nav-text">Materias</span>                             
                              </a>
                            </li>   
                            <li >
                              <a class="sidenav-item-link" href="{{ route('Pensum.index') }}">
                                <span class="nav-text">Pensum</span>                             
                              </a>
                            </li>
                            <li >
                              <a class="sidenav-item-link" href="{{ route('CategoriaDocente.index') }}">
                                <span class="nav-text">Categoría docente</span>                             
                              </a>
                            </li>    
                      </div>
                    </ul>
                  </li>
                  
                  <!----------------------------PERFIL DEL USUARIO---------------------------------->
                  <li  class="has-sub" >
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#perfil"
                      aria-expanded="false" aria-controls="perfil">
                      <i class="mdi mdi-account"></i>
                      <span class="nav-text">Perfiles</span> <b class="caret"></b>
                    </a>
                    <ul  class="collapse"  id="perfil"
                      data-parent="#sidebar-menu">
                      <div class="sub-menu">
                            <li>
                              <a class="sidenav-item-link" href="{{route('Persona.index')}}">
                                <span class="nav-text">Personas</span>
                                
                              </a>
                            </li>
                            <li >
                              <a class="sidenav-item-link" href="{{route('PersonaInstitucional.index')}}">
                                <span class="nav-text">Institucional</span>                             
                              </a>
                            </li> 
                            <!--li >
                              <a class="sidenav-item-link" href="{{route('Contrasena.index')}}">
                                <span class="nav-text">Cambiar Contraseña</span>                             
                              </a>
                            </li--> 
                      </div>
                    </ul>
                  </li>
    
                  <!----------------------------MODULO DE USUARIOS---------------------------------->
                  <li  class="has-sub" >
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#usuarios"
                      aria-expanded="false" aria-controls="usuarios">
                      <i class="mdi mdi-account-group"></i>
                      <span class="nav-text">USUARIOS</span> <b class="caret"></b>
                    </a>
                    <ul  class="collapse"  id="usuarios"
                      data-parent="#sidebar-menu">
                      <div class="sub-menu">
                            <li>
                              <a class="sidenav-item-link" href="{{ route('estudiante-usuario.index') }}">
                                <span class="nav-text">Estudiantes</span>
                              </a>
                            </li>
                          <li>
                            <a class="sidenav-item-link" href="{{ route('Administrador.index') }}">
                              <span class="nav-text">Administrativo</span>                             
                            </a>
                          </li> 
                            <li >
                              <a class="sidenav-item-link" href="{{ route('Docente.index') }}">
                                <span class="nav-text">Docentes</span>                             
                              </a>
                            </li>
                      </div>
                    </ul>
                  </li>
                  
                  <!----------------------------ROLES Y PERMISOS---------------------------------->
                  <li  class="has-sub" >
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#dashboard"
                      aria-expanded="false" aria-controls="dashboard">
                      <i class="mdi mdi-key"></i>
                      <span class="nav-text">Parametros</span> <b class="caret"></b>
                    </a>
                    <ul  class="collapse"  id="dashboard"
                      data-parent="#sidebar-menu">
                      <div class="sub-menu">
                            <li>
                              <a class="sidenav-item-link" href="{{ route('Rol.index') }}">
                                <span class="nav-text">Roles</span>
                                
                              </a>
                            </li>
                            <li >
                              <a class="sidenav-item-link" href="analytics.html">
                                <span class="nav-text">Permisos</span>                             
                              </a>
                            </li>
                            <li>
                              <a class="sidenav-item-link" href="{{ route('Dominio.index') }}">
                                <span class="nav-text">Dominios</span>
                                
                              </a>
                            </li>
                            <li >
                              <a class="sidenav-item-link" href="{{ route('Subdominio.index') }}">
                                <span class="nav-text">Subdominios</span>                             
                              </a>
                            </li>   
                      </div>
                    </ul>
                  </li>

                  <!----------------------------POSTULANTES---------------------------------->  
                  <li  class="has-sub" >
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#nuevos"
                      aria-expanded="false" aria-controls="nuevos">
                      <i class="mdi mdi-account-key"></i>
                      <span class="nav-text">Postulantes</span> <b class="caret"></b>
                    </a>
                    <ul  class="collapse"  id="nuevos"
                      data-parent="#sidebar-menu">
                      <div class="sub-menu">
                        <li>
                          <a class="sidenav-item-link" href="{{ route('postulante.index') }}">
                            <span class="nav-text">Lista de postulantes</span>
                          </a>
                        </li>
                        <li>
                          <a class="sidenav-item-link" href="{{ route('postulante.create') }}">
                            <span class="nav-text">Inscripcion de postulantes</span>
                          </a>
                        </li>     
                        <li>
                          <a class="sidenav-item-link" href="{{ route('calendario-ingreso.index') }}">
                            <span class="nav-text">Programar examen de ingreso</span>                             
                          </a>
                        </li>  
                      </div>
                    </ul>
                  </li>
                 @endif
                  
                  <!----------------------------PARAMETROS---------------------------------->
                  <!--
                  <li  class="has-sub" >
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#parametros"
                      aria-expanded="false" aria-controls="parametros">
                      <i class="mdi mdi-checkbox-multiple-blank-outline"></i>
                      <span class="nav-text">Parametros</span> <b class="caret"></b>
                    </a>
                    <ul  class="collapse"  id="parametros"
                      data-parent="#sidebar-menu">
                      <div class="sub-menu">
                        
                            <li>
                              <a class="sidenav-item-link" href="{{ route('Dominio.index') }}">
                                <span class="nav-text">Dominios</span>
                                
                              </a>
                            </li>
                            <li >
                              <a class="sidenav-item-link" href="{{ route('Subdominio.index') }}">
                                <span class="nav-text">Subdominios</span>                             
                              </a>
                            </li>   
                      </div>
                    </ul>
                  </li>   -->
                  <!----------------------------ENSEÑANZA---------------------------------->
                  @if (auth()->user()->per_rol <= 2)
                    <li  class="has-sub" >
                      <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#cursos"
                        aria-expanded="false" aria-controls="cursos">
                        <i class="mdi mdi-book-open-page-variant"></i>
                        <span class="nav-text">Área académica</span> <b class="caret"></b>
                      </a>
                      <ul  class="collapse"  id="cursos"
                        data-parent="#sidebar-menu">
                        <div class="sub-menu">
                              <li>
                                <a class="sidenav-item-link" href="#">
                                  <span class="nav-text">Seguimiento de estudiantes</span>
                                  
                                </a>
                              </li>
                              <li >
                                <a class="sidenav-item-link" href="{{ route('MateriaDocente.index') }}">
                                  <span class="nav-text">Seguimiento de docentes</span>                             
                                </a>
                              </li>  
                        </div>
                      </ul>
                    </li>
                  @endif

                  {{-- @if (auth()->user()->per_rol <= 3)
                    <!----------------------------NOTAS---------------------------------->
                    <li  class="has-sub" >
                      <a class="sidenav-item-link" href="{{ route('Nota.index') }}">
                        <i class="mdi mdi-notebook"></i>
                        <span class="nav-text">Notas</span>
                      </a>
                    </li>
                  @endif --}}
                  @if (auth()->user()->per_rol <= 5)
                    <!----------------------------INSCRIPCION---------------------------------->
                    <li  class="has-sub" >
                      <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#inscripcion"
                        aria-expanded="false" aria-controls="inscripcion">
                        <i class="mdi mdi-cash-multiple"></i>
                        <span class="nav-text">Inscrip. estudiantes</span> <b class="caret"></b>
                      </a>
                      <ul  class="collapse"  id="inscripcion"
                        data-parent="#sidebar-menu">
                        <div class="sub-menu">
                          @if (auth()->user()->per_rol >= 3)
                          <li>
                            <a class="sidenav-item-link" href="{{ route('subir-comprobantes.index') }}">
                              <span class="nav-text">Subir Comprobante</span>
                            </a>
                          </li>
                          <li>
                            <a class="sidenav-item-link" href="{{ route('comprobante.index') }}">
                              <span class="nav-text">Ver mis comprobantes</span>                             
                            </a>
                          </li> 
                          @endif
                          @if (auth()->user()->per_rol == 5)
                            <li>
                              <a class="sidenav-item-link" href="{{ route('estudiante-nuevo.show', auth()->user()->per_id) }}">
                                <span class="nav-text">Registrar perfil de estudiante</span>
                              </a>
                            </li>
                          @endif
                          @if (auth()->user()->per_rol == 1)
                            <li>
                              <a class="sidenav-item-link" href="{{ route('estudiante.index') }}">
                                <span class="nav-text">Inscribir estudiantes</span>                             
                              </a>
                            </li>
                            <li>
                              <a class="sidenav-item-link" href="{{ route('comprobante.index') }}">
                                <span class="nav-text">Validar comprobantes</span>                             
                              </a>
                            </li>  
                            <li>
                              <a class="sidenav-item-link" href="{{ route('subir-comprobante.index') }}">
                                <span class="nav-text">Subir Comprobante</span>
                              </a>
                            </li>
                          @endif  
                        </div>
                      </ul>
                    </li>
                  @endif
                  
                  
                  
                  

                  
                  <!----------------------------SALIR---------------------------------->
                  <li  class="has-sub" >
                    <a class="sidenav-item-link" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                     
                        <i class="mdi mdi-power"></i>
                        <span class="nav-text">Salir</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                  </li>
              </ul>
            </div>
          </div>
        </aside>
    <div class="page-wrapper">
          <!-- Header -->
          <header class="main-header " id="header">
            <nav class="navbar navbar-static-top navbar-expand-lg">
              <!-- Sidebar toggle button -->
              <button id="sidebar-toggler" class="sidebar-toggle">
                <span class="sr-only">Toggle navigation</span>
              </button>
              <!-- search form -->
              <div class="search-form d-none d-lg-inline-block">
              </div>

              <div class="navbar-right ">
                <ul class="nav navbar-nav">
                  <li class="dropdown notifications-menu">
                    <button class="dropdown-toggle" data-toggle="dropdown">
                      <i class="mdi mdi-bell-outline"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                      <li>
                        <a href="#">
                          <i class="mdi mdi-server-network-off"></i> Server overloaded
                          <span class=" font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> 05 AM</span>
                        </a>
                      </li>
                      <li class="dropdown-footer">
                        <a class="text-center" href="#"> View All </a>
                      </li>
                    </ul>
                  </li>
                  <!--li class="right-sidebar-in right-sidebar-2-menu">
                    <i class="mdi mdi-settings mdi-spin"></i>
                  </li-->

                  <!-- User Account -->
                  <li class="dropdown user-menu">
                    <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                      <img src="http://ebid.edu.bo/public{{ auth()->user()->per_foto_personal }}" class="user-image" alt="User Image" />
                      <span class="d-none d-lg-inline-block">{{ auth()->user()->name}}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                      <!-- User image -->
                      <li class="dropdown-header">
                        <div class="d-inline-block">
                          {{ auth()->user()->name }}
                          <small class="pt-1">{{ auth()->user()->email }}</small>
                        </div>
                      </li>

                      <li>
                        <a href="{{route('PersonaPerfil.show',auth()->user()->per_id)}}">
                          <i class="mdi mdi-account"></i> Mi perfil
                        </a>
                      </li>

                      <li>
                        <a class="sidenav-item-link" href="{{route('Contrasena.index')}}">
                          <i class="mdi mdi-lock"></i> Cambiar contraseña                           
                        </a>
                      </li>

                      <li class="dropdown-footer">
                        <a class="sidenav-item-link" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        
                            <i class="mdi mdi-power"></i>
                            <span class="nav-text">Salir</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
            </nav>
          </header>


      <div class="content-wrapper">					 
          @yield('contenido')
      </div>
    </div>
  </div>
</body>
@extends('ebid-views-administrador.componentes.script')
</html>
