@extends('layouts.employer')
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
@endpush
@push('title')
    Danh sách cv đã mua
@endpush
@section('content')
    <div class="card">
        <div class="card-body">
            <table id="my_post" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Tên ứng viên</th>
                    <th>Vị trí ứng tuyển</th>
                    <th>Xem</th>
                    <th>Tải</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cvs as $cv)
                    <tr>
                        <td>{{ $cv['profile']['name'] }}</td>
                        <td>{{ $cv['position'] }}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" target="_blank" href="{{ route('applicant.show-cv-form',['id'=>$cv['id']]) }}">
                                <i class="fas fa-folder">
                                </i>
                                Xem
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm" target="_blank" href="{{ route('applicant.download-cv',['id'=>$cv['id']]) }}">
                                <i class="fas fa-download">
                                </i>
                                Tải pdf
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Tên</th>
                    <th>Vị trí</th>
                    <th>Xem</th>
                    <th>Tải</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
@push('js')
    <!-- Select2 -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
@endpush
