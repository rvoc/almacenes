<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    {{--
    <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    {{--
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="hold-transition sidebar-collapse sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-ligth navbar-laravel border-bottom fixed-top">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
                </li>
                {{-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="../../index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li> --}}
            </ul>

            <!-- SEARCH FORM -->

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->

                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ url('users') }}" data-toggle="tooltip" data-placement="bottom" title="Gestion de Usuarios">
                        <i class="fa fa-users"></i>
                    </a>
                </li>
                 --}}
                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-store-alt"></i> {{Auth::user()->getStorage()->name}}
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                            <img src="{{Auth::user()->path_avatar?url('../'.substr(Auth::user()->path_avatar,7)):url('/img/user.jpg')}}" class="navbar-img img-circle elevation-2"  alt="User Image"> {{Auth::user()->usr_usuario}}
                    </a>
                    {{-- <div > --}}
                        {{-- <span class="dropdown-item dropdown-header">15 Notifications</span> --}}
                        <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                            <li class="dropdown-item" id="perfil">
                                <i class="fa fa-user mr-4"></i> Perfil
                                <span class="float-right"></span>
                            </li>
                            <li class="dropdown-item" id="config">
                                <i class="fa fa-user-cog mr-4"></i> Configuracion
                                <span class="float-right"></span>
                            </li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item" id="logout" data-toggle="modal" data-target="#logoutModal">
                                <i class="fa fa-sign-out-alt mr-4"></i> Salir
                                <span class="float-right"></span>
                            </li>
                        </ul>
                        {{-- <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                                <i class="fa fa-user mr-4"></i> Perfil
                            <span class="float-right"></span>
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="fa fa-cogs mr-4"></i>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fa fa-sign-out mr-4"></i> Salir
                        </a> --}}
                        {{-- <div class="dropdown-divider"></div> --}}
                        {{-- <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a> --}}
                    {{-- </div> --}}
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar elevation-4 sidebar-dark-success">
            <!-- Brand Logo -->
            <a href="#" class="brand-link ">
                <img src="{!!url('/img/logo_eba_blanck.png')!!}" alt="Eba Logo" class="brand-image " style="opacity: .8; margin-left: 0.2rem">
                <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar ">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex ">
                    <div class="image">
                        <img src="{{Auth::user()->path_avatar?url('../'.substr(Auth::user()->path_avatar,7)):url('/img/user.jpg')}}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                            <a href="#" class="d-block"> {{Auth::user()->getFullName()}}</a>

                        {{-- <nav class="mt-2">
                                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                    <!-- Add icons to the links using the .nav-icon class
                               with font-awesome or any other icon font library -->
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link d-block">
                                        <p>
                                            {{Auth::user()->name}}
                                            <i class="right fa fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="fa fa-user nav-icon"></i>
                                                <p>Perfil</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('logout') }}" class="nav-link"
                                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                                <i class="fa fa-sign-out nav-icon"></i>
                                                <p>Salir</p>
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                        </li>
                                    </ul>
                                </li>
                                </ul>
                        </nav> --}}
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->

                        <li class="nav-item">
                            <a href="{{ url('home') }}" class="nav-link {{ Navigation::isActiveRoute('home') }}">
                                <i class="nav-icon fa fa-tachometer-alt"></i>
                                <p>Inicio</p>
                            </a>
                        </li>

                        {{-- <li class="nav-item">
                            <a href="{{ url('article') }}" class="nav-link {{ Navigation::isActiveRoute('article.index') }}">
                                <i class="nav-icon fa fa-box"></i>
                                <p>Articulos</p>
                            </a>
                        </li> --}}

                        <li class="nav-item">
                            <a href="{{ url('stock') }}" class="nav-link {{ Navigation::isActiveRoute('stock.index') }}">
                                <i class="nav-icon fa fa-cubes"></i>
                                <p>Stock</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('income') }}" class="nav-link {{ Navigation::isActiveRoute('income.index') }}">
                                <i class="nav-icon fa fa-parachute-box"></i>
                                <p>Ingresos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('request_person') }}" class="nav-link {{ Navigation::isActiveRoute('request.index_person') }}">
                                <i class="nav-icon fa fa-boxes"></i>
                                <p>Mis Solicitudes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('request') }}" class="nav-link {{ Navigation::isActiveRoute('request.index') }}">
                                <i class="nav-icon fa fa-truck-loading"></i>
                                <p>Solicitudes Realizadas</p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview menu-close">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-people-carry"></i>
                                <p>
                                    Traspaso
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('request_storage') }}" class="nav-link {{ Navigation::isActiveRoute('request.index_storage') }}">
                                        <i class="nav-icon fa fa-file-import"></i>
                                        <p>Solicitudes recibidas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('request_storage_done') }}" class="nav-link {{ Navigation::isActiveRoute('request.index_storage') }}">
                                        <i class="nav-icon fa fa-inbox"></i>
                                        <p>Solicitudes Realizadas</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview menu-close">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-window-restore"></i>
                                <p>
                                    Datos
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('storage') }}" class="nav-link  {{ Navigation::isActiveRoute('storage.index') }}">
                                        <i class="nav-icon fa fa-store-alt"></i>
                                        <p>Alamcenes</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('provider') }}" class="nav-link {{ Navigation::isActiveRoute('provider.index') }}">
                                        <i class="fa fa-address-book nav-icon"></i>
                                        <p>Proveedores</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('category') }}" class="nav-link {{ Navigation::isActiveRoute('category.index') }}">
                                        <i class="fa fa-boxes nav-icon"></i>
                                        <p>Categorias</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('unit') }}" class="nav-link {{ Navigation::isActiveRoute('unit.index') }}">
                                        <i class="fa fa-ruler nav-icon"></i>
                                        <p>Unidades</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('budge_item') }}" class="nav-link {{ Navigation::isActiveRoute('budge_item.index') }}">
                                        <i class="fas fa-archive nav-icon"></i>
                                        <p>Partidas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('article') }}" class="nav-link {{ Navigation::isActiveRoute('budge_item.index') }}">
                                        <i class="fas fa-box nav-icon"></i>
                                        <p>Articulos</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('report_excel') }}" class="nav-link {{ Navigation::isActiveRoute('stock.index') }}">
                                <i class="nav-icon far fa-file-alt"></i>
                                <p>
                                Reportes
                                 <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('report_excel') }}" class="nav-link  {{ Navigation::isActiveRoute('storage.index') }}">
                                        <i class="nav-icon fa fa-file-excel"></i>
                                        <p>Reporte Generales</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('listalmacenes') }}" class="nav-link  {{ Navigation::isActiveRoute('storage.index') }}">
                                        <i class="nav-icon fa fa-file-excel"></i>
                                        <p>Reporte Alamacenes</p>
                                    </a>
                                </li>
                            </ul>
                        </li>



                        

                        {{-- <li class="nav-item">
                            <a href="{{ url('category') }}" class="nav-link {{ Navigation::isActiveRoute('category.index') }}">
                                <i class="nav-icon fa fa-boxes"></i>
                                <p>
                                    Categorias
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('unit') }}" class="nav-link {{ Navigation::isActiveRoute('unit.index') }}">
                                <i class="nav-icon fa fa-ruler"></i>
                                <p>
                                    Unidades
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('budge_item') }}" class="nav-link {{ Navigation::isActiveRoute('budge_item.index') }}">
                                <i class="nav-icon fas fa-archive"></i>
                                <p>
                                    Partidas
                                </p>
                            </a>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a href="{{ url('chart') }}" class="nav-link">
                                <i class="nav-icon fas fa-chart-area"></i>
                                <p>
                                    Graficos
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('configuration') }}" class="nav-link">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>
                                    Configuracion
                                </p>
                            </a>
                        </li> --}}

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->

            <section class="content-header "style=" padding-top: 60px;">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1> @yield('title')</h1>
                        </div>
                        <nav class="col-sm-6" aria-label="breadcrumb">
                            <ol class="breadcrumb float-sm-right">
                                @yield('breadcrums')
                                {{-- <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Blank Page</li> --}}
                            </ol>
                        </nav>

                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="container-fluid">

                <div id="app">
                    @yield('content')
                    {{-- adicionando modal change --}}
                    <change-storage
                        url='{{url('change_storage')}}'
                        csrf='{!! csrf_field('POST') !!}'
                        :storages="{{Auth::user()->getStorages()}}"
                        :storage= "{{ Auth::user()->getStorage()}}"
                    ></change-storage>
                </div>

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        {{-- <footer class="main-footer fixed-bottom">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.0.0-alpha
            </div>
            <strong>Copyright &copy; 2019 <a href="http://adminlte.io">EBA</a>.</strong> Todos los derechos reservados.
        </footer> --}}


    </div>
    <!-- Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header laravel-modal-bg">
                    <h5 class="modal-title" id="logoutModalLabel">Cerrar Sesion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Esta seguro de cerrar session ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success"><i class="nav-icon fa fa-sign-out-alt"></i>Si </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ./wrapper -->
    <script>
        window.onload = function () {
            // $.extend( $.fn.dataTable.defaults, {
            //     responsive: true
            // } );
            // console.log(spanish_lang);
            $('#lista').DataTable({
                responsive: true,
                columnDefs: [
                    { responsivePriority: 1, targets: 0 },
                    { responsivePriority: 10002, targets: 2 },
                    { responsivePriority: 2, targets: -1 }
                ],
                language: spanish_lang
            });
            var message =@json(session('message'));
            var deleteMessage = @json(session('delete'));
            var error = @json(session('error'));
            var info = @json(session('info'));
            if(message){
                toastr.success(message,'Registro Exitoso');
            }
            if(deleteMessage){
                toastr.warning(deleteMessage,'Registro Eliminado');
            }
            if(error){
                toastr.error( error,'Error');
            }
            if(info){
                toastr.info(info, 'Alerta' );
            }
            $('#perfil').click(function(){
                console.log('perfil click');
            });
            $('#config').click(function(){
                console.log('config click');
            });
            $('#logout').click(function(){
                console.log('logout click');
            });
            @yield('script')
        };
    </script>
</body>

</html>