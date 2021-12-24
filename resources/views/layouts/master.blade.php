<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Site Management - @yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('img/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('img/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('img/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('img/site.webmanifest')}}">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            {{--            <li class="nav-item d-none d-sm-inline-block">--}}
            {{--                <a href="{{route('home')}}" class="nav-link">Home</a>--}}
            {{--            </li>--}}
            <li class="nav-item d-none d-sm-inline-block">
                <img src="{{url('img/ethiologo.png')}}" alt="EthioTelecom Logo">
            </li>
        </ul>

        <!-- SEARCH FORM -->
    {{--        <form class="form-inline ml-3">--}}
    {{--            <div class="input-group input-group-sm">--}}
    {{--                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">--}}
    {{--                <div class="input-group-append">--}}
    {{--                    <button class="btn btn-navbar" type="submit">--}}
    {{--                        <i class="fas fa-search"></i>--}}
    {{--                    </button>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </form>--}}

    <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            <li class="nav-link">
                @canany(['user-list','user-create','user-edit','user-delete'])
                    <a class="btn btn-outline-primary btn-sm" role="button" href="{{route('users.index')}}">Manage
                        User</a>
                @endcanany
            </li>
            <li class="nav-link">
                @canany(['role-list','role-create','role-edit','role-delete'])
                    <a class="btn btn-outline-primary btn-sm" role="button" href="{{route('roles.index')}}">Manage
                        Role</a>
                @endcanany
            </li>
            <li class="nav-link">
                @can('audit-list')
                    <a class="btn btn-outline-primary btn-sm" role="button" href="{{route('audits')}}">View Log</a>
                @endcan
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link btn" data-toggle="dropdown" href="#">
                    <i class="fas fa-user fa-lg"></i>
                </a>

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">User Profile</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item" data-toggle="modal" data-target="#ModalLoginForm">
                        <i class="fas fa-user-edit mr-2"></i>Details
                        {{--                        <span class="float-right text-muted text-sm">3 mins</span>--}}
                    </a>
                    <div class="dropdown-divider"></div>
                    @can('user-edit')
                        <a href="{{route('users.edit', auth()->user()->id)}}" class="dropdown-item">
                            <i class="fas fa-edit mr-2"></i>Update
                        </a>
                    @endcan
                    <a class="dropdown-item" href="{{route('change.password')}}">
                        <i class="fas fa-key mr-2"></i>Change Password
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="fas fa-power-off mr-2"></i>{{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <div class="user-panel mt-3 d-flex">

            <a href="{{route('home')}}" class="brand-link logo-switch">
                {{--            <img src="{{url('img/ethiologo.png')}}" alt="EthioTelecom Logo" class="brand-image-xs logo-xl" style="opacity: .8">--}}
                <span class="brand-text font-weight-bold">Site Management</span>
            </a>
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            @if (Auth()->check())
                <div class="user-panel mt-2 d-flex">
                    <div class="info">
                        <a href="#" class="d-block">{{Auth()->user()->name}}</a>
                    </div>
                </div>
        @endif

        <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{route('home')}}" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            {{--                            <i class="icon fas fa-sitemap"></i>--}}
                            <i class="icon bi bi-person-lines-fill text-primary mr-2" style="font-size: 1.3em;"></i>
                            <p>
                                Contacts
                                <i class="bi-caret-left-fill text-primary right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @canany(['site-list','site-create','site-edit','site-delete'])
                                <li class="nav-item">
                                    <a href="{{route('customers.index')}}" class="nav-link">
                                        {{--                                        <i class="fas fa-eye nav-icon"></i>--}}
                                        <i class="bi bi-people-fill nav-icon text-primary mr-2"
                                           style="font-size: 1.2em;"></i>
                                        <p>Customers</p>
                                    </a>
                                </li>
                            @endcanany
                            @canany(['site-create','site-edit','site-delete'])
                                <li class="nav-item">
                                    <a href="{{route('customers.create')}}" class="nav-link">
                                        <i class="bi bi-stack text-primary mr-2" style="font-size: 1.2em;"></i>
                                        <p>Vendors</p>
                                    </a>
                                </li>
                            @endcanany
                            @canany(['site-list','site-create','site-edit','site-delete'])
                                <li class="nav-item">
                                    <a href="{{route('customers.create')}}" class="nav-link">
{{--                                        <i class="nav-icon bi-alarm"></i>--}}
                                        <span style="font-size: 1.2em; color: Dodgerblue;">
                                           <i class="fas fa-users"></i>
                                        </span>
                                        <p>Groups</p>
                                    </a>
                                </li>
                            @endcanany
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">
                            @yield('dashboard-content')
                        </h1>
                    </div><!-- /.col -->
                {{--                    <div class="col-sm-6">--}}
                {{--                        <ol class="breadcrumb float-sm-right">--}}
                {{--                            @yield('sitemap')--}}
                {{--                        </ol>--}}
                {{--                    </div>--}}
                <!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
        {{--            <div class="container-fluid">--}}
        @yield('content')
        {{--            </div>--}}
        <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2021 <a href="https://www.ethiotelecom.et/">EthioTelecom</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1
        </div>
    </footer>
</div>

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('js/app.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
        crossorigin="anonymous">
</script>

@yield('chart')
{{--<script src="{{asset('js/app.js')}}"></script>--}}

{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>--}}
{{--{!! $chart->script() !!}--}}
{{--{!! $chartRegion->script() !!}--}}

@yield('scripts')
<div class="modal fade" id="ModalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        {{--        <h1 class="card-img-top"><i class="fas fa-address-card fa-2x"></i></h1>--}}


        <div class="modal-content">
            <div class="modal-header bg-gradient-success text-center">
                <h4 class="modal-title w-100 font-weight-bold">Your Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @if (Auth()->check())
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-3">
                            <i class="fas fa-id-card-alt fa-3x" style="color: #0c84ff"></i>
                        </div>
                        <div class="col-3">{{auth()->user()->id}}
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-3">
                            <i class="fas fa-user fa-3x" style="color: #0c84ff"></i>
                        </div>
                        <div class="col-3">{{auth()->user()->name}}
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-3">
                            <i class="fas fa-envelope fa-3x" style="color: #0c84ff"></i>
                        </div>
                        <div class="col-3">
                            {{auth()->user()->email}}
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-3">
                            <i class="fab fa-critical-role fa-3x" style="color: #0c84ff"></i>
                        </div>
                        <div class="col-3">
                            @if(!empty(auth()->user()->getRoleNames()))
                                @foreach(auth()->user()->getRoleNames() as $v)
                                    {{ $v }}
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            @endif
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
