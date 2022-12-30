@extends('layouts.employer')
@push('title')
    Tìm kiếm cv
@endpush
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
@endpush
@section('content')
    <section class="content">
        <div class="container">
            <form action="{{ route('employer.show-find-cv-form') }}" method="get">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="form-group">
                            <div class="input-group input-group-lg">
                                <input type="search" class="form-control form-control-lg" name="search"
                                       placeholder="Nhập tên công việc,vị trí" value="{{ $search }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-lg btn-default">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Thành phố:</label>
                                    <select class="select2" data-placeholder="Chọn" name="city"
                                            style="width: 100%;">
                                        @foreach($cities as $city)
                                            @if ($loop->first)
                                                <option selected value=" ">{{ $city['name'] }}</option>
                                            @else
                                                <option @if($city_find==$city['name']) selected
                                                        @endif value="{{ $city['name'] }}">{{ $city['name'] }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row mt-3">
                <div class="col-md-10 offset-md-1">
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
                    <div class="list-group">
                        @foreach($cvs as $cv)
                            <div class="list-group-item mt-1">
                                <div class="row">
                                    <div class="col px-4">
                                        <div>
                                            <div class="float-right">Ngày
                                                tạo:{{ \Carbon\Carbon::create($cv['created_at'])->toDateString() }}</div>
                                            <h3>{{ $cv['profile']['name'] }}</h3>
                                            <p class="mb-0">Vị trí: {{ $cv['position'] }}</p>
                                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Địa
                                                chỉ:{{ $cv['profile']['address'] }}</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="container-fluid">
                                    <div class="row mx-auto text-center ">
                                        <a class="btn btn-primary btn-sm" target="_blank"
                                           href="{{ route('applicant.show-cv-form',['id'=>$cv['id']]) }}">
                                            <i class="fas fa-folder">
                                            </i>
                                            Xem
                                        </a>
                                        @if($cv['purchased'])
                                            <a class="btn btn-muted btn-sm ml-1" target="_blank" href="">
                                                <i class="fas fa-plus">
                                                </i>
                                                Đã mua
                                            </a>
                                        @else
                                            <a class="btn btn-warning btn-sm ml-1" target="_blank" data-toggle="modal"
                                               data-target="#modalBuyCv" data-id="{{ $cv['id'] }}">
                                                <i class="fas fa-plus">
                                                </i>
                                                Mua
                                            </a>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item @if($page ==1) disabled @endif">
                <a class="page-link"
                   href="{{ route('employer.show-find-cv-form').'?page='.($page-1).'&city='.$city_find }}"
                   tabindex="-1">Previous</a>
            </li>
            @if($page > 2)
                <li class="page-item"><a class="page-link"
                                         href="{{ route('employer.show-find-cv-form').'?page='.($page-2).'&city='.$city_find }}">{{ $page-2 }}</a>
                </li>
            @endif
            @if($page > 1)
                <li class="page-item"><a class="page-link"
                                         href="{{ route('employer.show-find-cv-form').'?page='.($page-1).'&city='.$city_find }}">{{ $page-1 }}</a>
                </li>
            @endif
            <li class="page-item active"><a class="page-link">{{ $page }}</a></li>
            <li class="page-item"><a class="page-link"
                                     href="{{ route('employer.show-find-cv-form').'?page='.($page+1).'&city='.$city_find }}">{{ $page+1 }}</a>
            </li>
            <li class="page-item"><a class="page-link"
                                     href="{{ route('employer.show-find-cv-form').'?page='.($page+2).'&city='.$city_find }}">{{ $page+2 }}</a>
            </li>
            <li class="page-item">
                <a class="page-link"
                   href="{{ route('employer.show-find-cv-form').'?page='.($page+1).'&city='.$city_find }}">Next</a>
            </li>
        </ul>
    </nav>

    <div class="modal fade" id="modalBuyCv" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" action="{{ route('employer.buy-cv') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold" id="exampleModalCenterTitle">Xác nhận mua</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Giá Tiền:</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="text" class="form-control" disabled id="price"
                                           value="{{number_format($price) }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        Bạn có chắc chắn muốn mua không không ?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning">Mua Cv</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--    </div>--}}
@endsection
@push('js')
    {{--    <script src="../../plugins/jquery/jquery.min.js"></script>--}}
    {{--    <!-- Bootstrap 4 -->--}}
    {{--    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>--}}
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- AdminLTE App -->
    {{--    <script src="../../dist/js/adminlte.min.js"></script>--}}
    <script>
        $(function () {
            $('.select2').select2()
        });
        $('#modalBuyCv').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-body input#id').val(id)
        })
    </script>
@endpush
