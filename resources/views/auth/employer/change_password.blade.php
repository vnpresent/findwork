@extends('layouts.employer')
@push('title')
    Đổi mật khẩu
@endpush
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row col-10 mx-auto">
                <form class="col-12 action="{{ route('employer.change-password') }}" method="post">
                @csrf
                <!-- About Me Box -->
                <div class="card card-primary col-12">
                    <div class="card-header">
                        <h3 class="card-title">Đổi mật khẩu</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Mật khẩu cũ</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Mật khẩu mới</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="new_password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Nhập lại mật khẩu cũ</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="new_password1">
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Cập Nhật</button>
                        </div>
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                    <!-- /.card-body -->
                </div>
                </form>
                <!-- /.card -->
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </section>
@endsection
@push('js')
@endpush
