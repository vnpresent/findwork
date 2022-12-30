@extends('layouts.applicant')
@push('title')
    Trang Chủ
@endpush
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
@endpush
@section('content')
    <div class="container h-auto pt-3 pb-3" style="background-color: #f0f0f0">
        <h3 class="my-3 ml-4"><i class="fas fa-search text-primary mr-1"></i>Tìm Kiếm Việc Làm</h3>
        <section class="content">
            <form action="{{ route('find-posts') }}" method="get">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <div class="input-group input-group">
                                        <input type="text" class="form-control" name="search"
                                               placeholder="Tên công việc, vị trí bạn muốn ứng tuyển ..."
                                               value="Thực tập sinh">
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <select class="select2 form-control" data-placeholder="Chọn" name="level"
                                            style="width: 100%;">
                                        @foreach($levels as $level)
                                            <option value="{{ $level['id'] }}">{{ $level['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <select class="select2 form-control" data-placeholder="Chọn" name="city"
                                            style="width: 100%;">
                                        @foreach($cities as $city)
                                            <option value="{{ $city['id'] }}">{{ $city['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group ">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-search"></i>Tìm Kiếm
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
    <div class="container h-auto pt-3 pb-3" style="background-color: #f0f0f0">
        <h3 class="my-3 ml-4 mt-3"><i class="fas fa-fire text-danger mr-1"></i>Việc Làm Hot</h3>
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @foreach( range(0,floor(count($pinnedPosts)/6)) as $i)
                    <div class="carousel-item @if ($loop->first)active @endif">
                        <div class="row col-12 mx-auto">
                            @foreach( array_slice($pinnedPosts,$i,6) as $post)
                                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                    <a href="{{ route('applicant.show-post-form',['id'=>$post['id']]) }}"
                                       target="_blank">
                                        <div class="card bg-light d-flex flex-fill">
                                            <div
                                                class="card-header border-bottom-0 font-weight-bold text-truncate text-center text-primary">
                                                {{ $post['title'] }}
                                            </div>
                                            <div class="card-body pt-0">
                                                <div class="row">
                                                    <div class="col-5 text-center">
                                                        <img src="{{ asset($post['avatar']) }}" alt="user-avatar"
                                                             style="width: 100px;height: 100px;object-fit: cover;"
                                                             class="img-circle img-fluid">
                                                    </div>
                                                    <div class="col-7">
                                                        <h2 class="lead text-truncate text-dark">
                                                            <b>{{ $post['work'] }}</b></h2>
                                                        <p class="text-sm text-truncate text-dark"><b>Cấp
                                                                bậc: </b>{{ $post['level'] }}
                                                        </p>
                                                        <ul class="ml-4 mb-0 fa-ul font-weight-bold text-success">
                                                            <li class="small"><span class="fa-li"><i
                                                                        class="fas fa-lg fa-map-marker"></i></span>{{ $post['city'] }}
                                                            </li>
                                                            <li class="small"><span class="fa-li"><i
                                                                        class="fas fa-lg fa-money-bill"></i></span>{{ $post['min_salary'] }}
                                                                - {{ $post['max_salary'] }}
                                                                tr
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon bg-dark w-25 h-25" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon bg-dark w-25 h-25" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div class="container h-auto pt-3 pb-3" style="background-color: #f0f0f0">
        <h3 class="my-3 ml-4 mt-3 d-inline-block"><i class="fas fa-briefcase text-success mr-1"></i>Việc Làm Mới Nhất</h3>
        <a class="d-inline-block justify-content-center" href="{{ route('show-latest-posts-form') }}">Xem thêm</a>
        <div class="row col-12 mx-auto">
            @foreach( $newest_posts as $post)
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                    <a href="{{ route('applicant.show-post-form',['id'=>$post['id']]) }}" target="_blank">
                        <div class="card bg-light d-flex flex-fill">
                            <div
                                class="card-header border-bottom-0 font-weight-bold text-truncate text-center text-primary">
                                {{ $post['title'] }}
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-5 text-center">
                                        <img src="{{ asset($post['avatar']) }}" alt="user-avatar"
                                             style="width: 100px;height: 100px;object-fit: cover;"
                                             class="img-circle img-fluid">
                                    </div>
                                    <div class="col-7">
                                        <h2 class="lead text-truncate text-dark"><b>{{ $post['work'] }}</b></h2>
                                        <p class="text-sm text-truncate text-dark"><b>Cấp bậc: </b>{{ $post['level'] }}
                                        </p>
                                        <ul class="ml-4 mb-0 fa-ul font-weight-bold text-success">
                                            <li class="small"><span class="fa-li"><i
                                                        class="fas fa-lg fa-map-marker"></i></span>{{ $post['city'] }}
                                            </li>
                                            <li class="small"><span class="fa-li"><i
                                                        class="fas fa-lg fa-money-bill"></i></span>{{ $post['min_salary'] }}
                                                - {{ $post['max_salary'] }}
                                                tr
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            {{--                            <div class="card-footer">--}}
                            {{--                                <div class="text-center">--}}
                            {{--                                    <a href="{{ route('applicant.show-post-form',['id'=>$post['id']]) }}"--}}
                            {{--                                       class="btn btn-sm btn-primary">--}}
                            {{--                                        <i class="fas fa-user"></i> Xem--}}
                            {{--                                    </a>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            $('.select2').select2()
        });
        $(document).ready(function () {
            $('.toast').toast('show');
        });
    </script>
@endpush
