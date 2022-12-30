@extends('layouts.applicant')
@push('title')
    Danh sách bài đăng đã ứng tuyển
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
            {{--        <div class="card-header">--}}
            {{--            <h3 class="card-title">Danh sách bài đăng</h3>--}}
            {{--        </div>--}}
            <!-- /.card-header -->
            <div class="card-body">
                <table id="my_post" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Tên CV</th>
                        <th>Bài Đăng</th>
                        <th>Xem Bài Đăng</th>
                        <th>Hủy Ứng Tuyển</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post['cv_name'] }}</td>
                            <td>{{ $post['post_title'] }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" target="_blank"
                                   href="{{ route('applicant.show-post-form',['id'=>$post['post_id']]) }}">
                                    <i class="fas fa-folder">
                                    </i>
                                    Xem
                                </a>
                            </td>
                            <td>
                                <form method="post"
                                      action="{{ route('applicant.unapply-post',['id'=>$post['post_id']]) }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $post['cv_id'] }}">
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-times"></i>Hủy
                                    </button>
                                </form>
                                {{--                            <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalUnApply"--}}
                                {{--                               data-post_id="{{ $post['post_id'] }}" data-cv_id="{{ $post['cv_id'] }}">--}}
                                {{--                                <i class="fas fa-trash">--}}
                                {{--                                </i>--}}
                                {{--                                Hủy--}}
                                {{--                            </a>--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Tên CV</th>
                        <th>Bài Đăng</th>
                        <th>Xem Bài Đăng</th>
                        <th>Hủy Ứng Tuyển</th>
                    </tr>
                    </tfoot>
                </table>
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
    {{--        <script src="{{ asset('dist/js/adminlte.min.js')}}"></script>--}}
    <script>
        $(function () {
            $("#my_post").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "ordering": false,
                // "ordering": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#my_post .col-md-12:eq(0)');
            // $('#my_post').DataTable({
            //     "paging": true,
            //     "lengthChange": false,
            //     "searching": false,
            //     "ordering": true,
            //     "info": true,
            //     "autoWidth": false,
            //     "responsive": true,
            // });
        });
        $('#modalUnApply').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var post_id = button.data('post_id')
            var cv_id = button.data('cv_id')
            var modal = $(this)
            modal.find('.modal-body input').val(id)
        })
    </script>
@endpush
