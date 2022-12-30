@extends('layouts.applicant')
@push('css')
    <link
        rel="stylesheet"
        href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">

@endpush
@section('content')
    <div class="container">
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
    <div class="container">
        <div class="row col-12 mx-auto">
            @foreach( $posts as $post)
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                    <div class="card bg-light d-flex flex-fill">
                        <div class="card-header text-black border-bottom-0 font-weight-bold">
                            {{ $post['title'] }}
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="lead"><b>{{ $post['work'] }}</b></h2>
                                    <p class="text-muted text-sm"><b>Vị Trí: </b>{{ $post['level'] }}
                                    </p>
                                </div>
                                <div class="col-5 text-center">
                                    <ul class="ml-4 mb-0 fa-ul">
                                        <li class="small"><span class="fa-li"><i
                                                    class="fas fa-lg fa-building"></i></span> {{ $post['city'] }}
                                        </li>
                                        <li class="small"><span class="fa-li"><i
                                                    class="fas fa-lg fa-money-bill"></i></span>
                                            Lương: {{ $post['min_salary'] }} - {{ $post['max_salary'] }}
                                            tr
                                        </li>
                                    </ul>
{{--                                    <img src="{{ asset($post['avatar']) }}" alt="user-avatar"--}}
{{--                                         style="width: 100px;height: 100px;object-fit: cover;"--}}
{{--                                         class="img-circle img-fluid">--}}
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-center">
                                <a href="{{ route('applicant.show-post-form',['id'=>$post['id']]) }}" target="_blank"
                                   class="btn btn-sm btn-primary">
                                    <i class="fas fa-user"></i> Xem
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{--        <div class="col-12">--}}
    {{--            <div class="col-md-12">--}}
    {{--                <div class="card">--}}
    {{--                    <div class="card-header">--}}
    {{--                        <h3 class="card-title">--}}
    {{--                            <i class="fas fa-text-width"></i>--}}
    {{--                            Mô tả công việc--}}
    {{--                        </h3>--}}
    {{--                    </div>--}}
    {{--                    <div class="card-body">--}}
    {{--                        <dl class="row">--}}
    {{--                            <pre class="col-sm-12 font-weight-bold">{{ $post['description'] }}</pre>--}}
    {{--                        </dl>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}

    {{--        <div class="col-12">--}}
    {{--            <div class="col-md-12">--}}
    {{--                <div class="card">--}}
    {{--                    <div class="card-header">--}}
    {{--                        <h3 class="card-title">--}}
    {{--                            <i class="fas fa-text-width"></i>--}}
    {{--                            Quyền lợi--}}
    {{--                        </h3>--}}
    {{--                    </div>--}}
    {{--                    <div class="card-body">--}}
    {{--                        <dl class="row">--}}
    {{--                            <pre class="col-sm-12 font-weight-bold">{{ $post['benefit'] }}</pre>--}}
    {{--                        </dl>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}


    {{--    <div class="modal fade" id="modalApply" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"--}}
    {{--         aria-hidden="true">--}}
    {{--        <div class="modal-dialog modal-dialog-top modal-lg" role="document">--}}
    {{--            <div class="modal-content">--}}
    {{--                <div class="modal-header">--}}
    {{--                    <h5 class="modal-title" id="exampleModalCenterTitle">Ứng tuyển</h5>--}}
    {{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
    {{--                        <span aria-hidden="true">&times;</span>--}}
    {{--                    </button>--}}
    {{--                </div>--}}
    {{--                <div class="modal-body">--}}
    {{--                    <div class="col-12">--}}
    {{--                        <div class="table-responsive">--}}
    {{--                            <table class="table">--}}
    {{--                                @foreach($cvs as $cv)--}}
    {{--                                    <tr>--}}
    {{--                                        <th style="width:50%">{{ $cv['name'] }}</th>--}}
    {{--                                        <td>--}}
    {{--                                            @if(in_array($cv['id'],$cvsOfPostId))--}}
    {{--                                                <form method="post"--}}
    {{--                                                      action="{{ route('applicant.unapply-post',['id'=>$post['id']]) }}">--}}
    {{--                                                    @csrf--}}
    {{--                                                    <input type="hidden" name="id" value="{{ $cv['id'] }}">--}}
    {{--                                                    <button type="submit" class="btn btn-danger">Hủy ứng tuyển</button>--}}

    {{--                                                </form>--}}
    {{--                                            @else--}}
    {{--                                                <form method="post"--}}
    {{--                                                      action="{{ route('applicant.apply-post',['id'=>$post['id']]) }}">--}}
    {{--                                                    @csrf--}}
    {{--                                                    <input type="hidden" name="id" value="{{ $cv['id'] }}">--}}
    {{--                                                    <button type="submit" class="btn btn-primary">Dùng ứng tuyển--}}
    {{--                                                    </button>--}}
    {{--                                                </form>--}}
    {{--                                            @endif--}}
    {{--                                        </td>--}}
    {{--                                    </tr>--}}
    {{--                                @endforeach--}}
    {{--                            </table>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="modal-footer">--}}
    {{--                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>--}}
    {{--                    --}}{{--                        <button type="submit" class="btn btn-primary">Xóa</button>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
@endsection
