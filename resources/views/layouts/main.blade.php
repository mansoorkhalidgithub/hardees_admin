<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME') }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin') }}/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.css">

    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <style>
        .help-block.error-help-block {
            color: red;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('restaurants')) ? 'active' : '' }}" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="{{ asset('/') }}images/logo/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"> {{ env('APP_NAME') }} </span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('admin') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview menu-open">

                            <ul class="nav nav-treeview">
                                @can('dashboard')
									<li class="nav-item">
										<a href="{{ route('dashboard') }}" class="nav-link {{ (request()->is('dashboard')) ? 'active' : '' }}">
											<i class="fas fa-list"></i>
											<p class="ml-2"> Dashboard </p>
										</a>
									</li>
								@endcan
								
								@can('restaurants')
									<li class="nav-item">
										<a href="{{ route('restaurants') }}" class="nav-link {{ (request()->is('restaurants')) ? 'active' : '' }}">
											<i class="fa fa-utensils"></i>
											<p class="ml-2"> Restaurants </p>
										</a>
									</li>
								@endcan
								
								@can('users')
									<li class="nav-item">
										<a href="{{ route('auth-users') }}" class="nav-link {{ (request()->is('auth-users')) ? 'active' : '' }}">
											<i class="fas fa-users"></i>
											<p class="ml-2">  Users </p>
										</a>
									</li>
								@endcan
								
								@can('menu-categories')
									<li class="nav-item">
										<a href="{{ route('menu-categories') }}" class="nav-link {{ (request()->is('menu-categories')) ? 'active' : '' }}">
											<i class="fab fa-product-hunt"></i>
											<p class="ml-2"> Menu Categories </p>
										</a>
									</li>
								@endcan
								
								@can('menu')
									<li class="nav-item">
										<a href="{{ route('menu') }}" class="nav-link {{ (request()->is('menu')) ? 'active' : '' }}">
											<i class="fab fa-product-hunt"></i>
											<p class="ml-2"> Menu </p>
										</a>
									</li>
								@endcan
								
								@can('orders')
									<li class="nav-item">
										<a href="{{ route('orders') }}" class="nav-link {{ (request()->is('manage-orders')) ? 'active' : '' }}">
											<i class="fa fa-stream"></i>
											<p class="ml-2">Orders </p>
										</a>
									</li>
								@endcan
								
								@can('customers')
									<li class="nav-item">
										<a href="{{ route('customers') }}" class="nav-link {{ (request()->is('customers')) ? 'active' : '' }}">
											<i class="fa fa-user"></i>
											<p class="ml-2">Customers </p>
										</a>
									</li>
                                @endcan
								
								@can('riders')
									<li class="nav-item">
										<a href="{{ route('riders') }}" class="nav-link {{ (request()->is('riders')) ? 'active' : '' }}">
											<i class="fa fa-biking"></i>
											<p class="ml-2"> Riders </p>
										</a>
									</li>
								@endcan
								
								@can('product-categories')
									<li class="nav-item">
										<a href="{{ route('product-categories') }}" class="nav-link {{ (request()->is('product-categories')) ? 'active' : '' }}">
											<i class="fa fa-inbox"></i>
											<p class="ml-2"> Inbox </p>
										</a>
									</li>
								@endcan
								
								@can('app-sliders')
									<li class="nav-item">
										<a href="{{ route('app-sliders') }}" class="nav-link {{ (request()->is('app-sliders')) ? 'active' : '' }}">
											<i class="fa fa-image"></i>
											<p class="ml-2"> App Sliders </p>
										</a>
									</li>
								@endcan
								
								@can('tax-setting')
									<li class="nav-item">
										<a href="{{ route('tax-setting') }}" class="nav-link {{ (request()->is('tax-setting')) ? 'active' : '' }}">
											<i class="fa fa-hand-holding-usd"></i>
											<p class="ml-2"> Tax Setting </p>
										</a>
									</li>
								@endcan
								
								@can('manage-currency')
									<li class="nav-item">
										<a href="{{ route('manage-currency') }}" class="nav-link {{ (request()->is('manage-currency')) ? 'active' : '' }}">
											<i class="fas fa-dollar-sign"></i>
											<p class="ml-2"> Manage Currency </p>
										</a>
									</li>
								@endcan
								
								@can('rider-request')
									<li class="nav-item">
										<a href="{{ route('rider-request') }}" class="nav-link {{ (request()->is('rider-request')) ? 'active' : '' }}">
											<i class="fas fa-window-maximize"></i>
											<p class="ml-2"> Riders Request </p>
										</a>
									</li>
                                @endcan
								
								@can('push-notifications')
									<li class="nav-item">
										<a href="{{ route('push-notifications') }}" class="nav-link {{ (request()->is('push-notifications')) ? 'active' : '' }}">
											<i class="fas fa-bell"></i>
											<p class="ml-2"> Push Notification </p>
										</a>
									</li>
								@endcan
								
								@can('earnings')
									<li class="nav-item">
										<a href="{{ route('earnings') }}" class="nav-link {{ (request()->is('earnings')) ? 'active' : '' }}">
											<i class="fas fa-dollar-sign"></i>
											<p class="ml-2"> Earnings </p>
										</a>
									</li>
								@endcan
								@can('transactions')
									<li class="nav-item">
										<a href="{{ route('transactions') }}" class="nav-link {{ (request()->is('transactions')) ? 'active' : '' }}">
											<i class="fas fa-file-invoice"></i>
											<p class="ml-2"> Transactions </p>
										</a>
									</li>
								@endcan
								@can('change-password')
									<li class="nav-item">
										<a href="{{ route('change-password') }}" class="nav-link {{ (request()->is('change-password')) ? 'active' : '' }}">
											<i class="fa fa-unlock-alt"></i>
											<p class="ml-2"> Change Password </p>
										</a>
									</li>
								@endcan
								
								<li class="nav-item">
									<a href="#" class="nav-link">
										<i class="right-align fa fa-sign-out-alt"></i>
										<p class="ml-2"> Logout </p>
									</a>
								</li>
								
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
                            <h1 class="m-0 text-dark"> @yield('title') </h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active"> @yield('title')</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <section class="content">
                <div class="container-fluid">
                    <div class="">
                        @yield('content')
                    </div>
                </div>
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">{{ env('APP_NAME') }}</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.0.2
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    </div>
    </div>
    <!-- ./wrapper -->
    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

    @if(request()->is('add-restaurant'))
    {!! JsValidator::formRequest('App\Http\Requests\RestaurantRequest') !!}
    @elseif(request()->is('add-user'))
    {!! JsValidator::formRequest('App\Http\Requests\UserRequest') !!}
    @endif
    <!-- jQuery UI 1.11.4 -->

    <script src="{{ asset('admin') }}/plugins/jquery/jquery.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/datatables/jquery.dataTables.js"></script>
    <script src="{{ asset('admin') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('admin') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="{{ asset('admin') }}/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="{{ asset('admin') }}/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="{{ asset('admin') }}/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('admin') }}/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('admin') }}/plugins/moment/moment.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('admin') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="{{ asset('admin') }}/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('admin') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin') }}/dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('admin') }}/dist/js/custom.js"></script>
    <script src="{{ asset('admin') }}/dist/js/demo.js"></script>

</body>

</html>