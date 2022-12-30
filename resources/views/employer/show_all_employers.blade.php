@extends('layouts.manager')
@push('title')
    Danh sách tài khoản Nhà Tuyển Dụng
@endpush
@section('content')
    <div class="card">
        <div class="card-body">
            <table id="all-managers" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Xem</th>
                    <th>Xóa</th>
                </tr>
                </thead>
                <tbody>
                @foreach($employers as $employer)
                    <tr>
                        <td>{{ $employer['name'] }}</td>
                        <td>{{ $employer['email'] }}</td>
                        <td>
                            <a class="btn btn-info btn-sm"
                               href="{{ route('manager.show-employer-form',['id'=>$employer['id']]) }}" target="_blank">
                                <i class="fas fa-folder">
                                </i>
                                Xem
                            </a>
                        </td>
                        <td>
                            @permission('delete_employer')
                            <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDelete"
                               data-id="{{ $employer['id'] }}">
                                <i class="fas fa-trash">
                                </i>
                                Xóa
                            </a>
                            @endpermission
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Vai trò</th>
                    <th>Xóa</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" action="{{ route('manager.delete-employer') }}">
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-danger">Xóa</button>
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
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js')}}"></script>
    <script>
        $(function () {
            $("#all-managers").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "ordering": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-12:eq(0)');
            // $('#example2').DataTable({
            //     "paging": true,
            //     "lengthChange": false,
            //     "searching": false,
            //     "ordering": true,
            //     "info": true,
            //     "autoWidth": false,
            //     "responsive": true,
            // });
        });
        $('#modalDelete').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-body input').val(id)
        })
    </script>
@endpush
