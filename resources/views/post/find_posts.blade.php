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
                                               value="{{ $search }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <select class="select2 form-control" data-placeholder="Chọn" name="level"
                                            style="width: 100%;">
                                        @foreach($levels as $level)
                                            <option @if($level['id']==$level_find) selected
                                                    @endif value="{{ $level['id'] }}">{{ $level['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <select class="select2 form-control" data-placeholder="Chọn" name="city"
                                            style="width: 100%;">
                                        @foreach($cities as $city)
                                            <option @if($city['id']==$city_find) selected
                                                    @endif value="{{ $city['id'] }}">{{ $city['name'] }}</option>
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
        <h3 class="my-3 ml-4 mt-3"><i class="fas fa-briefcase text-success mr-1"></i>Kết quả</h3>
        <div class="row col-12 mx-auto">
            @foreach( $posts as $post)
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
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item @if($page ==1) disabled @endif">
                <a class="page-link"
                   href="{{ route('find-posts').'?search='.$search.'&level='.$level_find.'&city='.$city_find.'&page='.($page-1) }}"
                   tabindex="-1">Previous</a>
            </li>
            @if($page > 2)
                <li class="page-item"><a class="page-link"
                                         href="{{ route('find-posts').'?search='.$search.'&level='.$level_find.'&city='.$city_find.'&page='.($page-2) }}">{{ $page-2 }}</a>
                </li>
            @endif
            @if($page > 1)
                <li class="page-item"><a class="page-link"
                                         href="{{ route('find-posts').'?search='.$search.'&level='.$level_find.'&city='.$city_find.'&page='.($page-1) }}">{{ $page-1 }}</a>
                </li>
            @endif
            <li class="page-item active"><a class="page-link">{{ $page }}</a></li>
            <li class="page-item"><a class="page-link"
                                     href="{{ route('find-posts').'?search='.$search.'&level='.$level_find.'&city='.$city_find.'&page='.($page+1) }}">{{ $page+1 }}</a>
            </li>
            <li class="page-item"><a class="page-link"
                                     href="{{ route('find-posts').'?search='.$search.'&level='.$level_find.'&city='.$city_find.'&page='.($page+2) }}">{{ $page+2 }}</a>
            </li>
            <li class="page-item">
                <a class="page-link"
                   href="{{ route('find-posts').'?search='.$search.'&level='.$level_find.'&city='.$city_find.'&page='.($page+1) }}">Next</a>
            </li>
        </ul>
    </nav>
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
