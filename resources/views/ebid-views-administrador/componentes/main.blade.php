@extends('ebid-views-administrador.componentes.link')
</head>
<body class="header-fixed sidebar-fixed sidebar-dark header-light" id="body">
  
  <div class="wrapper">
        <aside class="left-sidebar bg-sidebar">
          <div id="sidebar" class="sidebar sidebar-with-footer">
            <!-- Aplication Brand -->
            <div class="app-brand">
              <a href="/administracion" title="Sleek Dashboard">
                <svg
                  class="brand-icon"
                  preserveAspectRatio="xMidYMid"
                  width="30"
                  height="33"
                  viewBox="0 0 30 33"
                >
                  <g fill="none" fill-rule="evenodd">
                    <path
                      class="logo-fill-blue"
                      fill="#7DBCFF"
                      d="M0 4v25l8 4V0zM22 4v25l8 4V0z"
                    />
                    <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                  </g>
                </svg>
                <span class="brand-name text-truncate">Ebid</span>
              </a>
            </div>
            <!-- begin sidebar scrollbar -->
            <div class="sidebar-scrollbar">
              <!-- sidebar menu -->
              <ul class="nav sidebar-inner" id="sidebar-menu">
                  
                
                
                  <!----------------------------INICIO---------------------------------->
                  <li  class="has-sub" >
                    <a class="sidenav-item-link" href="">
                      <i class="mdi mdi-home"></i>
                      <span class="nav-text">Inicio</span>
                    </a>
                  </li>
                  <!----------------------------ROLES Y PERMISOS---------------------------------->
                  <li  class="has-sub" >
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#dashboard"
                      aria-expanded="false" aria-controls="dashboard">
                      <i class="mdi mdi-key"></i>
                      <span class="nav-text">Accesos</span> <b class="caret"></b>
                    </a>
                    <ul  class="collapse"  id="dashboard"
                      data-parent="#sidebar-menu">
                      <div class="sub-menu">
                            <li>
                              <a class="sidenav-item-link" href="index.html">
                                <span class="nav-text">Roles</span>
                                
                              </a>
                            </li>
                            <li >
                              <a class="sidenav-item-link" href="analytics.html">
                                <span class="nav-text">Permisos</span>                             
                              </a>
                            </li>   
                      </div>
                    </ul>
                  </li>
                  <!----------------------------PARAMETROS---------------------------------->
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
                              <a class="sidenav-item-link" href="index.html">
                                <span class="nav-text">Dominios</span>
                                
                              </a>
                            </li>
                            <li >
                              <a class="sidenav-item-link" href="analytics.html">
                                <span class="nav-text">Subdominios</span>                             
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
                      <span class="nav-text">Perfil</span> <b class="caret"></b>
                    </a>
                    <ul  class="collapse"  id="perfil"
                      data-parent="#sidebar-menu">
                      <div class="sub-menu">
                            <li>
                              <a class="sidenav-item-link" href="index.html">
                                <span class="nav-text">Personal</span>
                                
                              </a>
                            </li>
                            <li >
                              <a class="sidenav-item-link" href="analytics.html">
                                <span class="nav-text">Institucional</span>                             
                              </a>
                            </li>   
                      </div>
                    </ul>
                  </li>
                  <!----------------------------MODULO DE USUARIOS---------------------------------->
                  <li  class="has-sub" >
                    <a class="sidenav-item-link" href="">
                      <i class="mdi mdi-account-group"></i>
                      <span class="nav-text">USUARIOS</span>
                    </a>
                  </li>

                  <!----------------------------NOTAS---------------------------------->
                  <li  class="has-sub" >
                    <a class="sidenav-item-link" href="">
                      <i class="mdi mdi-notebook"></i>
                      <span class="nav-text">Notas</span>
                    </a>
                  </li>

                  <!----------------------------INSCRIPCION---------------------------------->
                  <li  class="has-sub" >
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#inscripcion"
                      aria-expanded="false" aria-controls="inscripcion">
                      <i class="mdi mdi-cash-multiple"></i>
                      <span class="nav-text">Inscripción</span> <b class="caret"></b>
                    </a>
                    <ul  class="collapse"  id="inscripcion"
                      data-parent="#sidebar-menu">
                      <div class="sub-menu">
                            <li>
                              <a class="sidenav-item-link" href="index.html">
                                <span class="nav-text">Historial Depositos</span>
                                
                              </a>
                            </li>
                            <li >
                              <a class="sidenav-item-link" href="analytics.html">
                                <span class="nav-text">Nuevo Deposito</span>                             
                              </a>
                            </li>   
                      </div>
                    </ul>
                  </li>

                  <!----------------------------ENSEÑANZA---------------------------------->
                  <li  class="has-sub" >
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#materias"
                      aria-expanded="false" aria-controls="materias">
                      <i class="mdi mdi-school"></i>
                      <span class="nav-text">Materias</span> <b class="caret"></b>
                    </a>
                    <ul  class="collapse"  id="materias"
                      data-parent="#sidebar-menu">
                      <div class="sub-menu">
                            <li>
                              <a class="sidenav-item-link" href="index.html">
                                <span class="nav-text">Especialidades</span>
                              </a>
                            </li>
                            <li >
                              <a class="sidenav-item-link" href="analytics.html">
                                <span class="nav-text">Semestres</span>                             
                              </a>
                            </li> 
                            <li >
                              <a class="sidenav-item-link" href="analytics.html">
                                <span class="nav-text">Materias</span>                             
                              </a>
                            </li>   
                      </div>
                    </ul>
                  </li>
                  <!----------------------------PORTAL---------------------------------->
                  <li  class="has-sub" >
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#portal"
                      aria-expanded="false" aria-controls="portal">
                      <i class="mdi mdi-monitor"></i>
                      <span class="nav-text">Portal</span> <b class="caret"></b>
                    </a>
                    <ul  class="collapse"  id="portal"
                      data-parent="#sidebar-menu">
                      <div class="sub-menu">
                            <li>
                              <a class="sidenav-item-link" href="index.html">
                                <span class="nav-text">Quienes Somos</span>
                              </a>
                            </li>
                            <li >
                              <a class="sidenav-item-link" href="analytics.html">
                                <span class="nav-text">Programa de enseñanza</span>                             
                              </a>
                            </li> 
                            <li >
                              <a class="sidenav-item-link" href="analytics.html">
                                <span class="nav-text">Galeria</span>                             
                              </a>
                            </li>  
                            <li >
                              <a class="sidenav-item-link" href="analytics.html">
                                <span class="nav-text">Noticias</span>                             
                              </a>
                            </li> 
                            <li >
                              <a class="sidenav-item-link" href="analytics.html">
                                <span class="nav-text">Contactos</span>                             
                              </a>
                            </li>   
                      </div>
                    </ul>
                  </li>
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
                  




                  <!--li  class="has-sub" >
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#documentation"
                      aria-expanded="false" aria-controls="documentation">
                      <i class="mdi mdi-book-open-page-variant"></i>
                      <span class="nav-text">Documentation</span> <b class="caret"></b>
                    </a>
                    <ul  class="collapse"  id="documentation"
                      data-parent="#sidebar-menu">
                      <div class="sub-menu">
                            <li class="section-title">
                              Getting Started
                            </li>
                            <li >
                              <a class="sidenav-item-link" href="introduction.html">
                                <span class="nav-text">Introduction</span>
                                
                              </a>
                            </li>
                            <li >
                              <a class="sidenav-item-link" href="quick-start.html">
                                <span class="nav-text">Quick Start</span>
                                
                              </a>
                            </li>
                            <li >
                              <a class="sidenav-item-link" href="customization.html">
                                <span class="nav-text">Customization</span>
                                
                              </a>
                            </li>
                            <li class="section-title">
                              Layouts
                            </li>
                          
    
                        <li  class="has-sub" >
                          <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#headers"
                            aria-expanded="false" aria-controls="headers">
                            <span class="nav-text">Header Variations</span> <b class="caret"></b>
                          </a>
                          <ul  class="collapse"  id="headers">
                            <div class="sub-menu">
                              
                              <li >
                                <a href="header-fixed.html">Header Fixed</a>
                              </li>
                              
                              <li >
                                <a href="header-static.html">Header Static</a>
                              </li>
                              
                              <li >
                                <a href="header-light.html">Header Light</a>
                              </li>
                              
                              <li >
                                <a href="header-dark.html">Header Dark</a>
                              </li>
                              
                            </div>
                          </ul>
                        </li>

                        <li  class="has-sub" >
                          <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#sidebar-navs"
                            aria-expanded="false" aria-controls="sidebar-navs">
                            <span class="nav-text">Sidebar Variations</span> <b class="caret"></b>
                          </a>
                          <ul  class="collapse"  id="sidebar-navs">
                            <div class="sub-menu">
                              
                              <li >
                                <a href="sidebar-fixed-default.html">Sidebar Fixed Default</a>
                              </li>
                              
                              <li >
                                <a href="sidebar-fixed-minified.html">Sidebar Fixed Minified</a>
                              </li>
                              
                              <li >
                                <a href="sidebar-fixed-offcanvas.html">Sidebar Fixed Offcanvas</a>
                              </li>
                              
                              <li >
                                <a href="sidebar-static-default.html">Sidebar Static Default</a>
                              </li>
                              
                              <li >
                                <a href="sidebar-static-minified.html">Sidebar Static Minified</a>
                              </li>
                              
                              <li >
                                <a href="sidebar-static-offcanvas.html">Sidebar Static Offcanvas</a>
                              </li>
                              
                              <li >
                                <a href="sidebar-with-footer.html">Sidebar With Footer</a>
                              </li>
                              
                              <li >
                                <a href="sidebar-without-footer.html">Sidebar Without Footer</a>
                              </li>
                              
                              <li >
                                <a href="right-sidebar.html">Right Sidebar</a>
                              </li>
                              
                            </div>
                          </ul>
                        </li>

                      </div>
                    </ul>
                  </li-->
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
                      <img src="assets/img/user/user.png" class="user-image" alt="User Image" />
                      <span class="d-none d-lg-inline-block">Yo</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                      <!-- User image -->
                      <li class="dropdown-header">
                        <img src="assets/img/user/user.png" class="img-circle" alt="User Image" />
                        <div class="d-inline-block">
                          Yo -- 
                          <small class="pt-1">yo@gmail.com</small>
                        </div>
                      </li>

                      <li>
                        <a href="user-profile.html">
                          <i class="mdi mdi-account"></i> Mi perfil
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
