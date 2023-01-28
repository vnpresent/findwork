<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@stack('title')</title>
    <link rel="icon" href="{{ asset('image/icon.png') }}" sizes="32x32" type="image/png">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    @stack('css')
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a class="brand-link">
            <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                 class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Quản Lý Website</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                         alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ auth('manager')->user()->name }}</a>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                           aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul
                    class="nav nav-pills nav-sidebar flex-column"
                    data-widget="treeview"
                    role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class with font-awesome or any
                    other icon font library -->
                    <li class="nav-item">
                        <a href="{{ route('manager.dashboard') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    @permission('read_post')
                    <li class="nav-item">
                        <a href="{{ route('manager.show-all-posts-form') }}" class="nav-link">
                            {{--                            <i class="nav-icon fas fa-search fa-fw"></i>--}}
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                                Quản lý bài đăng
                            </p>
                        </a>
                    </li>
                    @endpermission
                    @permission('read_payment')
                    <li class="nav-item">
                        <a href="{{ route('manager.show-all-payments-form') }}" class="nav-link">
                            {{--                            <i class="nav-icon fas fa-search fa-fw"></i>--}}
                            <i class="nav-icon fas fa-money-bill"></i>
                            <p>
                                Quản lý phiếu nạp
                            </p>
                        </a>
                    </li>
                    @endpermission
                    @permission('read_employer')
                    <li class="nav-item">
                        <a href="{{ route('manager.show-all-employers-form') }}" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Quản lý nhà tuyển dụng
                            </p>
                        </a>
                    </li>
                    @endpermission
                    @permission('read_cv')
                    <li class="nav-item">
                        <a href="{{ route('manager.show-all-cvs-form') }}" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Quản lý CV
                            </p>
                        </a>
                    </li>
                    @endpermission
                    @permission('read_manager')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Tài khoản Quản Lý
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('manager.show-create-manager-form') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Thêm mới Tài khoản</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('manager.show-all-managers-form') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh sách Tài khoản</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endpermission
                    @permission('read_role')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Vai trò
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('manager.show-create-role-form') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Thêm mới Vai trò</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('manager.show-all-roles-form') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh sách Vai trò</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endpermission
                    <li class="nav-item">
                        <a href="{{ route('manager.logout') }}" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>
                                Đăng xuất
                            </p>
                        </a>
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
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>@stack('title')</h1>
                    </div>
                    {{--                    <div class="col-sm-6">--}}
                    {{--                        <ol class="breadcrumb float-sm-right">--}}
                    {{--                            <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
                    {{--                            <li class="breadcrumb-item active">Blank Page</li>--}}
                    {{--                        </ol>--}}
                    {{--                    </div>--}}
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <strong>Copyright &copy; 2022-2032
            <a href="findword.com">FindWork.com</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b>
            1.0.0
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
@stack('js')
</body>
</html>
