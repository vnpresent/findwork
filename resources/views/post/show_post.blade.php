@extends('layouts.applicant')
@push('css')
    <link
        rel="stylesheet"
        href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">

@endpush
@push('title')
    Xem Bài Đăng Tuyển Dụng
@endpush
@section('content')
    <div class="container" style="background-color: #f0f0f0">
        <div class="row">
            <div class="col-12 mb-0">
                <div class="card box-profile card-body card-primary card-outline">
                    <!-- Profile Image -->
                    <div class="row">
                        <div class="col-3">
                            <div class="">
                                <div class="">
                                    <img class="profile-user-img rounded-circle"
                                         style="width: 200px;height: 200px;object-fit: cover;"
                                         onClick="triggerClick()"
                                         src="{{ asset($employer['avatar']) }}"
                                         alt="User profile picture">
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <div class="col-9">
                            <div class="card-body">
                                <dl class="row">
                                    <dt class="col-sm-4 h3">Tên Công Ty:</dt>
                                    <dd class="col-sm-8 h3">{{ $employer['name'] }}</dd>

                                    <dt class="col-sm-4">Giới Thiệu:</dt>
                                    <dd class="col-sm-8">{{ $employer['description'] }}</dd>

                                    <dt class="col-sm-4">Địa Chỉ:</dt>
                                    <dd class="col-sm-8">{{ $employer['address'] }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="background-color: #f0f0f0">
        <div class="title mt-5">
            <div class="col-8 mx-auto">
                <h3>
                    <div class="font-weight-bold text-center text-success">{{ $post['title'] }}</div>
                </h3>
            </div>
        </div>
        <div class="col-12">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="">
                            <i class="fas fa-text-width"></i>
                            Thông tin chung
                        </h2>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-4">Ngành nghề:</dt>
                            <dd class="col-sm-8">{{ $post['work'] }}</dd>

                            <dt class="col-sm-4">Cấp bậc:</dt>
                            <dd class="col-sm-8">{{ $post['level'] }}</dd>

                            <dt class="col-sm-4">Kinh nghiệm yêu cầu:</dt>
                            <dd class="col-sm-8">{{ $post['experience'] }}</dd>

                            <dt class="col-sm-4">Kĩ năng yêu cầu:</dt>
                            <dd class="col-sm-8">
                                @if(count($post['skills'])>0)
                                    @foreach($post['skills'] as $skill)
                                        {{ $skill['name'] }},
                                    @endforeach
                                @else
                                    Không
                                @endif
                            </dd>

                            <dt class="col-sm-4">Bằng cấp yêu cầu:</dt>
                            <dd class="col-sm-8">{{ $post['degree'] }}</dd>

                            <dt class="col-sm-4">Hình thức làm việc:</dt>
                            <dd class="col-sm-8">{{ $post['working_form'] }}</dd>

                            <dt class="col-sm-4">Giới tính:</dt>
                            <dd class="col-sm-8">{{ $post['txtsex'] }}</dd>

                            <dt class="col-sm-4">Vị trí làm việc:</dt>
                            <dd class="col-sm-8">{{ $post['address'] }}-{{ $post['city'] }}</dd>

                            <dt class="col-sm-4">Số lượng tuyển dụng:</dt>
                            <dd class="col-sm-8">{{ $post['number_applicants'] }}</dd>

                            <dt class="col-sm-4">Mức lương:</dt>
                            <dd class="col-sm-8">{{ $post['min_salary'] }}->{{ $post['max_salary'] }}tr</dd>

                            <dt class="col-sm-4">Hạn nộp:</dt>
                            <dd class="col-sm-8">{{ $post['end_date'] }}</dd>

                            <dt class="col-sm-4">
                                <button type="submit" class="btn btn-primary" data-toggle="modal"
                                        data-target="#modalApply" data-id="1">Ứng tuyển
                                </button>
                                @if(session('error'))
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </dt>
                        </dl>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

        <div class="col-12">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="">
                            <i class="fas fa-text-width"></i>
                            Mô tả công việc
                        </h2>
                    </div>
                    <div class="card-body">
                        <dl class="row">
                            <pre class="col-sm-12 font-weight-bold"
                                 style="white-space: pre-wrap;">{{ $post['description'] }}</pre>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="">
                            <i class="fas fa-text-width"></i>
                            Quyền lợi
                        </h2>
                    </div>
                    <div class="card-body">
                        <dl class="row">
                            <pre class="col-sm-12 font-weight-bold"
                                 style="white-space: pre-wrap;">{{ $post['benefit'] }}</pre>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalApply" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Ứng tuyển</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        @if(auth('applicant')->user()!=null)
                            <div class="table-responsive">
                                <table class="table">
                                    @foreach($cvs as $cv)
                                        <tr>
                                            <th style="width:50%">{{ $cv['name'] }}</th>
                                            <td>
                                                @if(in_array($cv['id'],$cvsOfPostId))
                                                    <form method="post"
                                                          action="{{ route('applicant.unapply-post',['id'=>$post['id']]) }}">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $cv['id'] }}">
                                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                                class="fas fa-times"></i>Hủy ứng tuyển
                                                        </button>

                                                    </form>
                                                @else
                                                    <form method="post"
                                                          action="{{ route('applicant.apply-post',['id'=>$post['id']]) }}">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $cv['id'] }}">
                                                        <button type="submit" class="btn btn-primary btn-sm"><i
                                                                class="fas fa-check"></i>Dùng ứng tuyển
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        @else
                            <p class="font-weight-bold">Bạn chưa đăng nhập,<a href="{{ route('applicant.login') }}"
                                                                              class="alert-link">đăng nhập ngay</a></p>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    {{--                        <button type="submit" class="btn btn-primary">Xóa</button>--}}
                </div>
            </div>
        </div>
    </div>
@endsection
