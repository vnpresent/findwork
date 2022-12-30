@extends('layouts.employer')
@push('title')
    Cập Nhật Thông Tin
@endpush
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row col-10 mx-auto">
                <div class="col-12 mb-0">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <form action="{{ route('employer.update-avatar') }}" method="post"
                                      id="update-avatar-form" enctype="multipart/form-data">
                                    @csrf
                                    <img class="profile-user-img rounded-circle"
                                         style="width: 200px;height: 200px;object-fit: cover;"
                                         onClick="triggerClick()"
                                         src="{{ asset(auth('employer')->user()->avatar) }}"
                                         alt="User profile picture">
                                    <input type="file" accept="image/png,image/jpeg" name="avatar" required="required"
                                           onChange="submitAvatar()"
                                           id="avatar" style="display: none;">
                                </form>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <form class="col-12 action="{{ route('employer.update-profile') }}" method="post">
                @csrf
                <div class="col-12 mt-0">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <input class="h3 profile-username text-center" name="name"
                                       value="{{ auth('employer')->user()->name }}">
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <div class="card card-primary col-12">
                    <div class="card-header">
                        <h3 class="card-title">Thông Tin Cá Nhân</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" disabled
                                       value="{{ auth('employer')->user()->email }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Số Dư</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" class="form-control" disabled
                                           value="{{ auth('employer')->user()->balance }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Giới Thiệu Về Công Ty</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="5" name="description"
                                          placeholder="Giới Thiệu Về Công Ty">{{ auth('employer')->user()->description }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Địa Chi Cụ Thể</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="address"
                                       value="{{ auth('employer')->user()->address }}">
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Cập Nhật</button>
                        </div>
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
