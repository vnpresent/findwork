@extends('layouts.manager')
@inject('GetStatusTrait', 'App\Repositories\Post\PostRepositoryInterface')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Danh sách bài đăng</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Mã Nạp</th>
                    <th>Loại Nạp</th>
                    <th>Số Tiền Nạp</th>
                    <th>Trạng thái</th>
                    <th style="width: 20%">Hành Động</th>
                </tr>
                </thead>
                <tbody>
                @foreach($payments as $payment)
                    <tr>
                        <td class="font-weight-bold">{{ $payment['order_id'] }}</td>
                        <td>{{ $payment['payment_type'] }}</td>
                        <td>{{ number_format($payment['amount']) }} đ</td>
                        <td class="font-weight-bold @if($payment['status']==2) text-primary @elseif($payment['status']==1) text-success @else text-danger @endif">{{ $payment['status_text'] }}</td>
                        <td class="project-actions text-center">
                            @permission('update_payment')
                            @if($payment['status']==2)
                                <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalConfirm"
                                   data-id="{{ $payment['id'] }}">
                                    <i class="fas fa-check">
                                    </i>
                                    Xác Nhận
                                </a>
                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalCancel"
                                   data-id="{{ $payment['id'] }}">
                                    <i class="fas fa-times">
                                    </i>
                                    Hủy Bỏ
                                </a>
                            @endif
                            @endpermission
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Mã Nạp</th>
                    <th>Loại Nạp</th>
                    <th>Số Tiền Nạp</th>
                    <th>Trạng thái</th>
                    <th style="width: 20%">Hành Động</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modalConfirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" action="{{ route('manager.confirm-payment') }}">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title text-success" id="exampleModalCenterTitle">Xác nhận duyệt</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body font-weight-bold">
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
                <form method="post" action="{{ route('manager.cancel-payment') }}">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title text-danger" id="exampleModalCenterTitle">Xác nhận hủy</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body font-weight-bold">
                        <input type="hidden" name="id">
                        Bạn có chắc chắn muốn hủy không ?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Hủy</button>
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
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js')}}"></script>
    <script>
        $(function () {
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
        });
        $('#modalConfirm').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-body input').val(id)
        })
        $('#modalCancel').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-body input').val(id)
        })
    </script>
@endpush
