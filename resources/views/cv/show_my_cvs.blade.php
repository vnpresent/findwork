@extends('layouts.applicant')
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
@endpush
@push('title')
    CV Của Tôi
@endpush
@section('content')
    <div class="container">
        <div class="card">
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
            <div class="card-body">
                <table id="all-cvs" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Tên CV</th>
                        <th>Tên</th>
                        <th>Vị trí</th>
                        <th>Xem</th>
                        <th>Xem Gợi Ý</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                        <th>Tải</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cvs as $cv)
                        <tr>
                            <td>{{ $cv['name'] }}</td>
                            <td>{{ $cv['profile']['name'] }}</td>
                            <td>{{ $cv['position'] }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" target="_blank"
                                   href="{{ route('applicant.show-cv-form',['id'=>$cv['id']]) }}">
                                    <i class="fas fa-folder">
                                    </i>
                                    Xem
                                </a>
                            </td>
                            <td>
                                <a class="btn btn-success btn-sm" target="_blank"
                                   href="{{ route('applicant.show-suggest-cv-form',['id'=>$cv['id']]) }}">
                                    <i class="fas fa-folder">
                                    </i>
                                    Xem Gợi Ý
                                </a>
                            </td>
                            <td>
                                <a class="btn btn-info btn-sm"
                                   href="{{ route('applicant.show-update-cv-form',['id'=>$cv['id']]) }}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Sửa
                                </a>
                            </td>
                            <td>
                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDelete"
                                   data-id="{{ $cv['id'] }}">
                                    <i class="fas fa-trash">
                                    </i>
                                    Xóa
                                </a>
                            </td>
                            <td>
                                <a class="btn btn-primary btn-sm" target="_blank"
                                   href="{{ route('applicant.download-cv',['id'=>$cv['id']]) }}">
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
                        <th>Tên CV</th>
                        <th>Tên</th>
                        <th>Vị trí</th>
                        <th>Xem</th>
                        <th>Xem Gợi Ý</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                        <th>Tải</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form method="post" action="{{ route('delete-cv') }}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title text-danger" id="exampleModalCenterTitle">Xác nhận xóa</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body font-weight-bold">
                            <input type="hidden" name="id">
                            Bạn có chắc chắn muốn xóa không ?
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Xóa</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <!-- AdminLTE App -->
    {{--    <script src="{{ asset('dist/js/adminlte.min.js')}}"></script>--}}
    <script>
        $(function () {
            $("#all-cvs").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "ordering": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-12:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            $('#modalDelete').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var modal = $(this);
                modal.find('.modal-body input').val(id);
            });
        });
    </script>
@endpush
