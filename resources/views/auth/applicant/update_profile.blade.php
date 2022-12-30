@extends('layouts.applicant')
@push('title')
    Cập Nhật Thông Tin
@endpush
@section('content')
    <section class="content">
        <div class="container">
            <div class="row col-10 mx-auto">
                <form class="col-12 action="{{ route('applicant.update-profile') }}" method="post">
                @csrf
                <div class="card card-primary col-12">
                    <div class="card-header">
                        <h3 class="h3">Thông Tin Cá Nhân</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" disabled
                                       value="{{ auth('applicant')->user()->email }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Tên</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control font-weight-bold" name="name" placeholder="Tên"
                                       value="{{ auth('applicant')->user()->name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Số điện thoại</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control font-weight-bold" name="phone"
                                       placeholder="Số điện thoại"
                                       value="{{ auth('applicant')->user()->phone }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Ngày sinh</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control font-weight-bold" name="birthday"
                                       value="{{ auth('applicant')->user()->birthday?auth('applicant')->user()->birthday:'' }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Địa Chi Cụ Thể</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control font-weight-bold" name="address"
                                       value="{{ auth('applicant')->user()->address }}" placeholder="Địa Chi Cụ Thể">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Đổi Mật Khẩu</label>
                            <div class="col-sm-10 row pr-0 mr-0">
                                <div class="col-sm-4">
                                    <input type="password" class="form-control font-weight-bold" name="password"
                                           value="" placeholder="Mật Khẩu Cũ">
                                </div>
                                <div class="col-sm-4">
                                    <input type="password" class="form-control font-weight-bold" name="new_password"
                                           value="" placeholder="Mật Khẩu Mới">
                                </div>
                                <div class="col-sm-4 pr-0">
                                    <input type="password" class="form-control font-weight-bold mr-0"
                                           name="new_password1"
                                           value="" placeholder="Nhập Lại Mật Khẩu Mới">
                                </div>
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
    <script>
        function triggerClick(e) {
            document.querySelector('#avatar').click();
        }

        function submitAvatar() {
            document.getElementById("update-avatar-form").submit();
        }
    </script>
@endpush
