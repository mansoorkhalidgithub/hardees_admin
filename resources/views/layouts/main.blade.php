<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Hardees</title>

    <!-- Custom fonts for this template-->
    <script src="{{ asset('admin/js/all.min.js') }}" defer></script>
    <link href="{{ asset('admin/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/sb-admin-2.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('admin/extra') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="{{ asset('admin/extra') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!--link rel="stylesheet" href="{{ asset('admin/admin') }}/dist/css/adminlte.min.css"-->


</head>

<body>

    <main id="py-4">
        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav sidebar sidebar-dark accordion" style="background-color: #404e67; overflow: hidden " id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                    <!--div class="sidebar-brand-icon rotate-n-15">
					<i class="fas fa-3x fa-laugh-wink"></i>
				</div-->
                    <div class="sidebar-brand-text mx-3">
                        Hardees
                    </div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                @can('dashboard')
                <li class="nav-item active">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ (request()->is('dashboard')) ? 'active' : '' }}">
                        <i class="fas fa-fw fa-tachometer-alt">
                        </i>
                        <span>{{Auth::user()->username}}</span>
                    </a>
                </li>
                @endcan


                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">Admin Dashboard</div>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a href="{{ route('booking.index') }}" class="nav-link {{ (request()->is('restaurants')) ? 'active' : '' }}">
                        <i class="fas fa-fw fa-location-arrow"></i>
                        <span>Delivery Booking</span>
                    </a>
                </li>
                @can('restaurants')
                <li class="nav-item">
                    <a href="{{ route('restaurants') }}" class="nav-link {{ (request()->is('restaurants')) ? 'active' : '' }}">
                        <i class="fas fa-fw fa-list"></i>
                        <span>Hardees Branches</span>
                    </a>
                </li>
                @endcan
                <li class="nav-item"><a class="nav-link" href="#"> <i class="fas fa-fw fa-bicycle"></i> <span>Trips to Delivery</span></a></li>

                <li class="nav-item">
                    <a href="#" class="nav-link {{ (request()->is('ridestatment')) ? 'active' : '' }}">
                        <i class="fas fa-fw fa-book"></i>
                        <span>Ride Statement</span>
                    </a>
                </li>
                @can('menu-categories')
                <li class="nav-item">
                    <a href="{{ route('menu-categories') }}" class="nav-link {{ (request()->is('menu-categories')) ? 'active' : '' }}">
                        <i class="fas fa-fw fa-clipboard-list"></i>
                        <span>Menu Categories</span>
                    </a>
                </li>
                @endcan
                @can('menu')
                <li class="nav-item">
                    <a href="{{ route('menu') }}" class="nav-link {{ (request()->is('menu')) ? 'active' : '' }}">
                        <i class="fas fa-fw fa-list"></i>
                        <span>Menu Items</span>
                    </a>
                </li>
                @endcan

                @can('dashboard')
                <li class="nav-item">
                    <a href="{{ route('users') }}" class="nav-link {{ (request()->is('customers')) ? 'active' : '' }}">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Sub Admins</span>
                    </a>
                </li>
                @endcan
                @can('customers')
                <li class="nav-item">
                    <a href="{{ route('users','page=user') }}" class="nav-link {{ (request()->is('customers')) ? 'active' : '' }}">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Users</span>
                    </a>
                </li>
                @endcan
                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <div class="sidebar-heading">Reporting</div>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item"><a class="nav-link" href="#"> <i class="fas fa-fw fa-clipboard-list"></i> <span>Reports</span></a></li>

                <li class="nav-item"><a class="nav-link" href="#formsDropdown" aria-expanded="true" data-toggle="collapse"> <i class="fas fa-fw fa-car"></i> <span>Delivery Management</span></a>

                    <ul id="formsDropdown" style="margin-left: 20px;" class="list-unstyled collapse in" aria-expanded="true">
                        <li class="nav-item"><a class="nav-link" href="#">
                                <i class="fa fa-tasks"></i> <span style="margin-left: 5px;">Completed </span></a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#">
                                <i class="fa fa-tasks"></i> <span style="margin-left: 5px;">Inprogress </span></a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#">
                                <i class="fa fa-tasks"></i> <span style="margin-left: 5px;">Rejected </span></a>
                        </li>
                    </ul>
                </li>

                <!--li class="nav-item"><a class="nav-link" href="#"> <i
					class="fas fa-fw fa-user"></i> <span>Customer Management</span></a></li-->

                <li class="nav-item"><a class="nav-link" href="#"> <i class="fas fa-fw fa-list"></i> <span>Hardees Branches</span></a></li>

                <hr class="sidebar-divider d-none d-md-block">

                <div class="sidebar-heading">Members</div>
                @can('riders')
                <li class="nav-item">
                    <a href="{{ route('users','page=rider') }}" class="nav-link {{ (request()->is('riders')) ? 'active' : '' }}">
                        <i class="fas fa-fw fa-motorcycle"></i>
                        <span>Riders</span>
                    </a>
                </li>
                @endcan
                <li class="nav-item"><a class="nav-link" href="#"> <i class="fas fa-fw fa-dollar-sign"></i> <span>Payment Setting</span></a></li>

                <li class="nav-item"><a class="nav-link" href="#"> <i class="fas fa-fw fa-bookmark"></i> <span>Tax Setting</span></a></li>

                <li class="nav-item"><a class="nav-link" href="#"> <i class="fas fa-fw fa-rupee-sign"></i> <span>Manage Currency</span></a></li>

                <hr class="sidebar-divider d-none d-md-block">

                <div class="sidebar-heading">General</div>

                <li class="nav-item"><a class="nav-link" href="#"> <i class="fas fa-fw fa-bell"></i> <span>Push Notification</span></a></li>

                <li class="nav-item"><a class="nav-link" href="#"> <i class="fas fa-fw fa-table"></i> <span>Service Types</span></a></li>

                <li class="nav-item"><a class="nav-link" href="#"> <i class="fas fa-fw fa-chart-area"></i> <span>Service Area</span></a></li>

                <li class="nav-item"><a class="nav-link" href="#"> <i class="fas fa-fw fa-star-half"></i> <span>Review &AMP; Rating</span></a></li>

                <li class="nav-item"><a class="nav-link" href="#"> <i class="fas fa-fw fa-globe"></i> <span>State</span></a></li>

                <li class="nav-item"><a class="nav-link" href="#"> <i class="fas fa-fw fa-globe"></i> <span>City</span></a></li>

                <hr class="sidebar-divider d-none d-md-block">

                <li class="nav-item"><a class="nav-link" href="#"> <i class="fas fa-fw fa-sign-out-alt"></i> <span>Logout</span></a></li>
                <!-- Sidebar Toggler (Sidebar) -->
                <!--div class="text-center d-none d-md-inline">
				<button class="rounded-circle border-0" id="sidebarToggle"><i class="fa fa-bars" style="color: #404e67;"></i></button>
			</div-->


                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-laugh-wink"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">
                        Affiliate
                    </div>
                </a>
                <li class="nav-item"><a class="nav-link" href="#"> <i class="fas fa-fw fa-tachometer-alt"></i> <span>Dashboard</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">Data</div>

                <!--li class="nav-item"><a class="nav-link active" href=""> <i
					class="fas fa-fw fa-edit"></i> <span>Edit Profile</span></a></li-->

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item active"><a class="nav-link active" href="#"> <i class="fas fa-fw fa-table"></i> <span>Product Lists</span></a></li>
                <li class="nav-item active"><a class="nav-link active" href="#"> <i class="fas fa-fw fa-table"></i> <span>Brand Lists</span></a></li>

                <li class="nav-item"><a class="nav-link active" href="#"> <i class="fas fa-fw fa-table"></i> <span>Links Lists</span></a></li>
                <li class="nav-item"><a class="nav-link active" href="#"> <i class="fas fa-fw fa-table"></i> <span>Brand Links Lists</span></a></li>

                <hr class="sidebar-divider">

                <!--li class="nav-item"><a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                    <i class="zmdi zmdi-power fas fa-fw fa-power-off"></i>Logout</a>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                        </li-->




            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" style="height: 50px">

                        <!-- Sidebar Toggle (Topbar) -->
                        <!--button id="sidebarToggleTop"
						class="btn btn-link d-md-none rounded-circle mr-3">
						<i class="fa fa-bars"></i>
					</button-->
                        <button id="sidebarToggleTop" style="background: transparent; border: none;"><i class="fa fa-bars" style="color: #404e67;"></i></button>
                        <!-- Topbar Search -->
                        <!--form
						class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
						<div class="input-group">
							<input type="text" class="form-control bg-light border-2 small"
								placeholder="Search for..." aria-label="Search"
                                                                aria-describedby="basic-addon2" style="height: 38px;">
							<div class="input-group-append">
                                                            <button class="btn" style="background-color: #212529" type="button">
                                                                <i class="fas fa-search fa-sm" style="color: white"></i>
								</button>
							</div>
						</div>
					</form-->

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                            <li class="nav-item dropdown no-arrow "><a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-search fa-fw" style="color: #404e67"></i>
                                </a> <!-- Dropdown - Messages -->
                                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-light border-2 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" style="height: 38px;">
                                            <div class="input-group-append">
                                                <button class="btn" style="background-color: #212529" type="button">
                                                    <i class="fas fa-search fa-sm" style="color: white"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>

                            <!-- Nav Item - Alerts -->
                            <li class="nav-item dropdown no-arrow mx-1"><a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-bell fa-fw" style="color: #404e67"></i> <!-- Counter - Alerts -->
                                    <span class="badge badge-danger badge-counter">3+</span>
                                </a> <!-- Dropdown - Alerts -->
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                    <h6 class="dropdown-header">Alerts Center</h6>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-primary">
                                                <i class="fas fa-file-alt text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">December 12, 2019</div>
                                            <span class="font-weight-bold">A new monthly report is ready
                                                to download!</span>
                                        </div>
                                    </a> <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-success">
                                                <i class="fas fa-donate text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">December 7, 2019</div>
                                            $290.29 has been deposited into your account!
                                        </div>
                                    </a> <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-warning">
                                                <i class="fas fa-exclamation-triangle text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">December 2, 2019</div>
                                            Spending Alert: We have noticed unusually high spending for
                                            your account.
                                        </div>
                                    </a> <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                                </div>
                            </li>

                            <!-- Nav Item - Messages -->
                            <li class="nav-item dropdown no-arrow mx-1"><a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-envelope fa-fw" style="color: #404e67"></i> <!-- Counter - Messages -->
                                    <span class="badge badge-danger badge-counter">7</span>
                                </a> <!-- Dropdown - Messages -->
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                    <h6 class="dropdown-header">Message Center</h6>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                                            <div class="status-indicator bg-success"></div>
                                        </div>
                                        <div class="font-weight-bold">
                                            <div class="text-truncate">Hi there! I am wondering you can
                                                help me with a problem I have been having.</div>
                                            <div class="small text-gray-500">Emily Fowler � 58m</div>
                                        </div>
                                    </a> <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                                            <div class="status-indicator"></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">I have the photos that you ordered
                                                last month, how would you like them sent to you?</div>
                                            <div class="small text-gray-500">Jae Chun � 1d</div>
                                        </div>
                                    </a> <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                                            <div class="status-indicator bg-warning"></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">Last month report looks great, I am
                                                very happy with the progress so far, keep up the good work!</div>
                                            <div class="small text-gray-500">Morgan Alvarez � 2d</div>
                                        </div>
                                    </a> <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                                            <div class="status-indicator bg-success"></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">Am I a good boy? The reason I ask
                                                is because someone told me that people say this to all dogs,
                                                even if they are not good...</div>
                                            <div class="small text-gray-500">Chicken the Dog � 2w</div>
                                        </div>
                                    </a> <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                                </div>
                            </li>

                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow"><a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="mr-2 d-none d-lg-inline " style="color: #404e67">{{ Auth::user()->username }} </span>
                                    <img class="img-profile rounded-circle" src="{{ asset('https://source.unsplash.com/QAB-WJcbgJk/60x60') }}">
                                </a> <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="#"> <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Edit Profile
                                    </a> <a class="dropdown-item" href="#"> <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Settings
                                    </a> <a class="dropdown-item" href="#"> <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Activity Log
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="zmdi zmdi-power"></i>Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                                </div>
                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->
                    @yield('content')

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <!--footer class="sticky-footer bg-white">
				<div class="container my-auto">
					<div class="copyright text-center my-auto">
						<span>Copyright &copy; Your Website 2019</span>
					</div>
				</div>
			</footer-->
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->
        <!-- Scroll to Top Button--> <a class="scroll-to-top rounded" href="#page-top"> <i class="fas fa-angle-up"></i>
        </a> <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">�</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to
                        end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="login.html">Logout</a>
                    </div>
                </div>
            </div>
        </div>

    </main>



    <script src="{{ asset('admin/js/jquery.min.js') }}" defer></script>
    <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('admin/js/jquery.easing.min.js') }}" defer></script>
    <script src="{{ asset('admin/js/sb-admin-2.js') }}" defer></script>
    <script src="{{ asset('admin/js/Chart.min.js') }}" defer></script>
    <script src="{{ asset('admin/js/chart-area-demo.js') }}" defer></script>
    <script src="{{ asset('admin/js/chart-pie-demo.js') }}" defer></script>
    <script src="{{ asset('admin/extra') }}/plugins/datatables/jquery.dataTables.js"></script>
    <script src="{{ asset('admin/extra') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <script src="{{ asset('admin') }}/dist/js/custom.js"></script>
    <!-- jQuery UI 1.11.4 -->

</body>

</html>