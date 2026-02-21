<html>
{{-- * Installer Dashboard --}}

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ URL::to('/') }}/img/bright.jpg" rel="icon">
    <title>@yield('page-title') </title>
    <!-- Bootstrap -->
    <link href="{{ URL::to('/') }}/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ URL::to('/') }}/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ URL::to('/') }}/vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ URL::to('/') }}/build/css/custom.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap5-toggle@5.0.4/css/bootstrap5-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <link href="{{ URL::to('/') }}/styles.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="nav-md footer_fixed">
    @php
        // $admin = session()->get('admin');
        // $employee = session()->get('employee');
        // $dealer = session()->get('dealer');
        $installer = session()->get('installer');

        // $adminToken = session()->get('adminToken');
        // $employeeToken = session()->get('employeeToken');
        // $dealerToken = session()->get('dealerToken');
        $installerToken = session()->get('installerToken');
    @endphp

    <div class="container body">
        @php
            use App\Models\User;
            $email = session()->get('installer');
            $data = User::query()->where('email', $email)->first();
        @endphp
        <div class="main_container">
            <div class="col-md-3 left_col menu_fixed">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        @if ($installer)
                            <a href="{{ route('installer.dashboard') }}" class="site_title">
                                <i class="fa fa-sun-o" aria-hidden="true"></i>
                                <span>Beliance Energy</span>
                            </a>
                        @endif
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            {{-- <img src="{{ URL::to('/') }}/testimonial-1.jpg" alt="..."
                                class="img-circle profile_img"> --}}

                            <img src="{{ URL::to('/') }}/testimonial-1.jpeg" alt="..."
                                class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2>
                                {{ $data->name }}
                                {{-- @if ($installer)
                                    Installer
                                @endif --}}
                            </h2>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <hr style="background: white">
                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <ul class="nav side-menu">
                                {{-- @if ($installer) --}}
                                <li class="{{ request()->routeIs('installer.dashboard') ? 'active ' : '' }}">
                                    <a href="{{ route('installer.dashboard') }}"><i class="fa fa-dashboard"></i>
                                        Dashboard</a>
                                </li>
                                <li class="{{ request()->routeIs('installer.installer_manage_stock') ? 'active ' : '' }}">
                                    <a href="{{ route('installer.installer_manage_stock') }}">
                                        <i class="fa fa-cubes" aria-hidden="true"></i>
                                        Stock
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('installer.manage_sell_product') ? 'active ' : '' }}">
                                    <a href="{{ route('installer.manage_sell_product') }}"><i class="fa fa-user"></i>
                                        Sell Product (Client)</a>
                                </li>

                                <li>
                                    <a href="{{ route('InstallerLogout') }}">
                                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                                        Logout
                                    </a>
                                </li>
                                {{-- @endif --}}

                            </ul>
                        </div>

                    </div>
                    <!-- /sidebar menu -->

                </div>
            </div>


            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle mb-2">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                </div>
            </div>
            <!-- /top navigation -->


            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>@yield('title')</h3>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12  ">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page content -->

            <footer>
                <div class="pull-right">
                    Beliance Energy
                </div>
                <div class="clearfix"></div>
            </footer>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ URL::to('/') }}/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{ URL::to('/') }}/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="{{ URL::to('/') }}/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="{{ URL::to('/') }}/vendors/nprogress/nprogress.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{ URL::to('/') }}/build/js/custom.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap5-toggle@5.0.4/js/bootstrap5-toggle.jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

    {{-- *DataTable --}}
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script> --}}
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>

    <script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @yield('script')

</body>

</html>
