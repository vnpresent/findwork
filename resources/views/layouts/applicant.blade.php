<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@stack('title')</title>

    <link rel="icon" href="{{ asset('image/icon.png') }}" sizes="32x32" type="image/png">

    @stack('css')
    <!-- Google Font: Source Sans Pro -->
    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link
        rel="stylesheet"
        href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- IonIcons -->
    <link
        rel="stylesheet"
        href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">
</head>
<!-- `body` tag options: Apply one or more of the following classes to to the
body tag to get the desired effect * sidebar-collapse * sidebar-mini -->
<body class="hold-transition sidebar-mini">
<nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
    <a class="navbar-brand" href="{{ route('index') }}">
        <img src="{{ asset('image/icon.png') }}" width="30" height="30" class="d-inline-block align-top"
             alt="">
        FindWork
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        </ul>
        <form class="form-inline my-2 my-lg-0">
            @if(auth('employer')->user()==null &&  auth('applicant')->user()==null)
                <div class=" dropdown m-0 p-0">
                    <a class="nav-link dropdown-toggle btn m-0 text-danger" id="navbarDropdownLogin" role="button"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        Đăng Nhập
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownLogin">
                        <a class="dropdown-item" href="{{ route('applicant.show-login-form') }}">Ứng Viên</a>
                        <a class="dropdown-item" href="{{ route('employer.show-login-form') }}">Nhà Tuyển Dụng</a>
                    </div>
                </div>
                <div class=" dropdown m-0 p-0">
                    <a class="nav-link dropdown-toggle btn m-0 text-danger" id="navbarDropdownRegister" role="button"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        Đăng Ký
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownRegister">
                        <a class="dropdown-item" href="{{ route('applicant.show-register-form') }}">Ứng Viên</a>
                        <a class="dropdown-item" href="{{ route('employer.show-register-form') }}">Nhà Tuyển Dụng</a>
                    </div>
                </div>
            @elseif(auth('employer')->user()!=null)
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle btn" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        Quản Lý Nhà Tuyển Dụng
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('employer.dashboard') }}">Quản Lý Chung</a>
                        <a class="dropdown-item" href="{{ route('employer.show-create-post-form') }}">Đăng Tin</a>
                        <a class="dropdown-item" href="{{ route('employer.show-my-posts-form') }}">Tin Đã Đăng</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('employer.logout') }}">Đăng Xuất</a>
                    </div>
                </div>
            @endif
            @if(auth('applicant')->user()!=null)
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle btn" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        Ứng Viên
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('applicant.show-create-cv-form') }}">Tạo CV</a>
                        <a class="dropdown-item" href="{{ route('applicant.my-cvs-form') }}">Danh Sách CV Đã Tạo</a>
                        <a class="dropdown-item" href="{{ route('applicant.show-applied-posts-form') }}">Bài Đăng Đã Ứng
                            Tuyển</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('applicant.show-update-profile-form') }}">Thông tin cá nhân</a>
                        <a class="dropdown-item" href="{{ route('applicant.logout') }}">Đăng Xuất</a>
                    </div>
                </div>
            @endif
        </form>
    </div>
</nav>
@yield('content')

<div class="container-fluid justify-content-center">
    <hr class="mx-0 px-0">
    <footer>
        <div class="row justify-content-around mb-0 pt-5 pb-0 ">
            <div class=" col-11">
                <div class="row justify-content-center">
                    <div class="col-md-3 col-12 font-italic align-items-center  mt-md-3 mt-4"><h5><span> <img
                                    src="{{ asset('image/icon.png') }}" class="img-fluid mb-1 "></span><b
                                class="text-dark">Find<span class="text-muted">Work</span></b></h5>
                        <p class="social mt-md-3 mt-2"><span><i class="fa fa-facebook " aria-hidden="true"></i></span>
                            <span><i class="fa fa-linkedin" aria-hidden="true"></i></span> <span><i
                                    class="fa fa-twitter" aria-hidden="true"></i></span></p>
                        <small class="copy-rights cursor-pointer">&#9400; 2022 FindWork.com</small><br>
                        <small>Copyright.All Rights Resered. </small>

                    </div>
                    <div class="col-md-3 col-12  my-sm-0 mt-5">
                        <ul class="list-unstyled">
                            <li class="mt-md-3 mt-4">Giới thiệu chung</li>
                            <li>Thông tin cần biết</li>
                            <li>Thỏa thuận sử dụng</li>
                            <li>Quy định bảo mật</li>
                            <li>Quy trình giải quyết tranh chấp</li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-12 my-sm-0 mt-5">
                        <ul class="list-unstyled">
                            <li class="mt-md-3 mt-4">Địa chỉ: 175 Tây Sơn, Đống Đa, Hà Nội</li>
                            <li>Chính sách bảo mật</li>
                            <li>Điều khoản dịch vụ</li>
                            <li>Quy chế hoạt động</li>
                            <li>Hỏi đáp</li>
                        </ul>
                    </div>
                    <div class="col-xl-auto col-md-3 col-12 my-sm-0 mt-5">
                        <ul class="list-unstyled">
{{--                            <li class="mt-md-3 mt-4">Offer</li>--}}
{{--                            <li>Intergrated Security Platform</li>--}}
{{--                            <li>Core Features</li>--}}
{{--                            <li>Product Features</li>--}}
{{--                            <li>Pricing</li>--}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE -->
<script src="{{ asset('dist/js/adminlte.js')}}"></script>
<!-- OPTIONAL SCRIPTS -->
{{--<script src="{{ asset('dist/js/pages/dashboard3.js')}}"></script>--}}
@stack('js')
</body>
</html>
