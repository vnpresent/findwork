@extends('layouts.manager')
@inject('GetStatusTrait', 'App\Repositories\Post\PostRepositoryInterface')
@push('title')
    Danh sách bài đăng
@endpush
@section('content')
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
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Tiêu đề</th>
                    <th>Ngành nghề</th>
                    <th>Cấp bậc</th>
                    <th>Trạng thái</th>
                    <th>Xem</th>
                    <th>Duyệt</th>
                    <th>Hủy</th>
                    <th>Xóa</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $post['title'] }}</td>
                        <td>{{ $post['work'] }}</td>
                        <td>{{ $post['level'] }}</td>
                        <td class="@if($post['status']==2) text-primary @elseif($post['status']==1) text-success @else text-danger @endif">{{ $GetStatusTrait->getStatusById($post['status']) }}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" target="_blank"
                               href="{{ route('applicant.show-post-form',['id'=>$post['id']]) }}">
                                <i class="fas fa-folder">
                                </i>
                                Xem
                            </a>
                        </td>
                        @if( $post['status'] == $GetStatusTrait->getStatusPending())
                            <td>
                                @permission('update_post')
                                <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalConfirm"
                                   data-id="{{ $post['id'] }}">
                                    <i class="fas fa-check">
                                    </i>
                                    Duyệt
                                </a>
                                @endpermission
                            </td>
                            <td>
                                @permission('update_post')
                                <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalCancel"
                                   data-id="{{ $post['id'] }}">
                                    <i class="fas fa-times">
                                    </i>
                                    Hủy
                                </a>
                                @endpermission
                            </td>
                        @else
                            <td></td>
                            <td></td>
                        @endif
                        @if( $post['status'] != $GetStatusTrait->getStatusDelete())
                            <td>
                                @permission('delete_post')
                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDelete"
                                   data-id="{{ $post['id'] }}">
                                    <i class="fas fa-trash">
                                    </i>
                                    Xóa
                                </a>
                                @endpermission
                            </td>
                        @else
                            <td></td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Tiêu đề</th>
                    <th>Ngành nghề</th>
                    <th>Cấp bậc</th>
                    <th>Trạng thái</th>
                    <th>Xem</th>
                    <th>Duyệt</th>
                    <th>Hủy</th>
                    <th>Xóa</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modalConfirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" action="{{ route('manager.confirm-post') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Xác nhận duyệt</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id">
                        Bạn có chắc chắn muốn duyệt không ?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Duyệt</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCancel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" action="{{ route('manager.cancel-post') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Xác nhận hủy</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id">
                        Bạn có chắc chắn muốn hủy không ?
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Lý do hủy:</label>
                            <textarea class="form-control" name="note"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning">Hủy</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" action="{{ route('delete-post') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Xác nhận xóa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
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
    <script>
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "ordering": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-12:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
        });
        $('#modalConfirm').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var modal = $(this);
            modal.find('.modal-body input').val(id);
        });
        $('#modalCancel').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var modal = $(this);
            modal.find('.modal-body input').val(id);
        });
        $('#modalDelete').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var modal = $(this);
            modal.find('.modal-body input').val(id);
        });
    </script>
@endpush
