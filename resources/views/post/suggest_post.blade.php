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
                <!-- /.card -->
            </div>
        </div>
    </section>
@endsection
