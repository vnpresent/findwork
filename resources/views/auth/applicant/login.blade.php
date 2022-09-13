@extends('layouts.master')
@push('title')
    <title>Login | FindWork</title>
@endpush
@push('css')
    <link rel="stylesheet" href="{{ asset('css/auth/applicant/login.css') }}">
@endpush
@section('content')
    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        {{--                                        <img--}}
                                        {{--                                            src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/lotus.webp"--}}
                                        {{--                                            style="width: 185px;" alt="logo">--}}
                                        <h4 class="mt-1 mb-5 pb-1">Đăng nhập vào FindWork</h4>
                                    </div>

                                    <form method="post" action="{{ route('applicant.login') }}">
                                        <p>Điền thông tin đăng nhập</p>
                                        @csrf
                                        <div class="form-outline mb-4">
                                            <input type="email" id="form2Example11" name="email" class="form-control"
                                                   placeholder=""/>
                                            <label class="form-label" for="form2Example11">Email</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" id="form2Example22" name="password"
                                                   class="form-control"/>
                                            <label class="form-label" for="form2Example22">Password</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" name="remember" id="form1Example3" checked />
                                                <label class="form-check-label" for="form1Example3"> Remember me </label>
                                            </div>
                                        </div>

                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3"
                                                    type="submit">Đăng nhập
                                            </button>
                                            @if(session('success'))
                                                <div class="alert alert-success" role="alert">
                                                    {{ session('success') }}
                                                </div>
                                            @endif
                                            @if(session('error'))
                                                <div class="alert alert-danger" role="alert">
                                                    {{ session('error') }}
                                                </div>
                                            @endif
                                            <a class="text-muted" href="#!">Quên mật khẩu?</a>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2 mr-1">Chưa có tài khoản?</p>
                                            <a href="{{ route('applicant.show-register-form') }}" type="button"
                                               class="btn btn-outline-danger">Đăng ký</a>
                                        </div>

                                    </form>

                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">We are more than just a company</h4>
                                    <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                                        do
                                        eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                        quis
                                        nostrud
                                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
