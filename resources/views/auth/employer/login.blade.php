@extends('layouts.master')
@push('title')
    <title>Login | FindWork</title>
@endpush
@push('css')
    <link rel="icon" href="{{ asset('image/icon.png') }}" sizes="32x32" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/auth/employer/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth/employer/owl.carousel.min.css') }}">
@endpush
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('image/auth/employer/undraw_remotely_2j6y.svg') }}" alt="Image"
                         class="img-fluid">
                </div>
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h3>Đăng nhập</h3>
                                <h3 class="mb-4">Nhà Tuyển Dụng FindWork</h3>
                            </div>
                            <form action="{{ route('employer.login') }}" method="post">
                                @csrf
                                <div class="form-group mb-4">
                                    <input type="email" id="form2Example11" name="email" class="form-control"
                                           placeholder=""/>
                                    <label class="form-label" for="form2Example11">Email</label>
                                </div>

                                <div class="form-group mb-1">
                                    <input type="password" id="form2Example22" name="password"
                                           class="form-control"/>
                                    <label class="form-label" for="form2Example22">Password</label>
                                </div>

                                <div class="d-flex mb-5 align-items-center">
                                    <label class="control control--checkbox mb-0"><span
                                            class="caption">Remember me</span>
                                        <input type="checkbox" checked="checked"/>
                                        <div class="control__indicator"></div>
                                    </label>
                                    <span class="ml-auto"><a href="{{ route('employer.register') }}" class="forgot-pass">Đăng Ký</a></span>
                                </div>

                                <input type="submit" value="Log In" class="btn btn-block btn-primary">
                                @if(session('error'))
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
