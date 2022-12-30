@extends('layouts.applicant')
@section('content')
    <section class="content">
        <div class="container">
            <!-- Default box -->
            <div class="card card-solid">
                <div class="card-body pb-0">
                    <div class="row">
                        @foreach($posts as $post)
                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                <div class="card bg-light d-flex flex-fill">
                                    <div class="card-header text-muted border-bottom-0">
                                        {{ $post['title'] }}
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="lead"><b>{{ $post['work'] }}</b></h2>
                                                <p class="text-muted text-sm"><b>Vị Trí: </b>{{ $post['level'] }} </p>
                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                    <li class="small"><span class="fa-li"><i
                                                                class="fas fa-lg fa-building"></i></span> Thành
                                                        Phố: {{ $post['city'] }}
                                                    </li>
                                                    <li class="small"><span class="fa-li"><i
                                                                class="fas fa-lg fa-money-bill"></i></span>
                                                        Lương #: {{ $post['min_salary'] }} - {{ $post['max_salary'] }} tr
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-5 text-center">
                                                <img src="{{ asset('image/default-avatar.jpg') }}" alt="user-avatar"
                                                     class="img-circle img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-right">
                                            {{--                                            <a href="#" class="btn btn-sm bg-teal">--}}
                                            {{--                                                <i class="fas fa-comments"></i>--}}
                                            {{--                                            </a>--}}
                                            <a href="{{ route('applicant.show-post-form',['id'=>$post['id']]) }}"
                                               class="btn btn-sm btn-primary">
                                                <i class="fas fa-user"></i> Xem
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- /.card-body -->
                    {{--                <div class="card-footer">--}}
                    {{--                    <nav aria-label="Contacts Page Navigation">--}}
                    {{--                        <ul class="pagination justify-content-center m-0">--}}
                    {{--                            <li class="page-item active"><a class="page-link" href="#">1</a></li>--}}
                    {{--                            <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
                    {{--                            <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
                    {{--                            <li class="page-item"><a class="page-link" href="#">4</a></li>--}}
                    {{--                            <li class="page-item"><a class="page-link" href="#">5</a></li>--}}
                    {{--                            <li class="page-item"><a class="page-link" href="#">6</a></li>--}}
                    {{--                            <li class="page-item"><a class="page-link" href="#">7</a></li>--}}
                    {{--                            <li class="page-item"><a class="page-link" href="#">8</a></li>--}}
                    {{--                        </ul>--}}
                    {{--                    </nav>--}}
                    {{--                </div>--}}
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
@endsection
