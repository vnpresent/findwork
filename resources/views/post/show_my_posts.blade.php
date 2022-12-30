@extends('layouts.employer')
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
        {{--        <div class="card-header">--}}
        {{--            <h3 class="card-title">Danh sách bài đăng</h3>--}}
        {{--        </div>--}}
        <!-- /.card-header -->
        <div class="card-body">
            <table id="my_post" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Tiêu đề</th>
                    <th>Ngành nghề</th>
                    <th>Cấp bậc</th>
                    <th>Trạng thái</th>
                    <th>Note</th>
                    <th>Mua ghim</th>
                    <th>Xem</th>
                    <th>Danh sách ứng tuyển</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $post['title'] }}</td>
                        <td>{{ $post['work'] }}</td>
                        <td>{{ $post['level'] }}</td>
                        <td class="font-weight-bold">{{ $post['status_text'] }}</td>
                        <td>{{ $post['note'] }}</td>
                        <td>
                            @if(!$post['is_pinned'])
                                @if($post['status']==1)
                                    <a type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                       data-target="#modalBuyPin"
                                       data-id="{{ $post['id'] }}" data-price="{{ number_format($post['price']) }}">
                                        Mua ghim</a>
                                @endif
                            @else
                                <a type="button" class="btn btn-muted btn-sm">
                                    Đã mua</a>
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm" target="_blank"
                               href="{{ route('applicant.show-post-form',['id'=>$post['id']]) }}">
                                <i class="fas fa-folder">
                                </i>
                                Xem
                            </a>
                        </td>
                        <td><a type="button" href="{{ route('employer.show-apply-cvs-form',['id'=>$post['id']]) }}"
                               class="btn btn-secondary btn-sm"><i class="fas fa-eye">
                                </i>Xem danh sách</a></td>
                        <td>
                            <a class="btn btn-info btn-sm"
                               href="{{ route('employer.show-update-post-form',['id'=>$post['id']]) }}">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Sửa
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDelete"
                               data-id="{{ $post['id'] }}">
                                <i class="fas fa-trash">
                                </i>
                                Xóa
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Tiêu đề</th>
                    <th>Ngành nghề</th>
                    <th>Cấp bậc</th>
                    <th>Trạng thái</th>
                    <th>Note</th>
                    <th>Mua ghim</th>
                    <th>Xem</th>
                    <th>Danh sách ứng tuyển</th>
                    <th>Sửa</th>
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
                <form method="post" action="{{ route('delete-post') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold" id="exampleModalCenterTitle">Xác nhận xóa</h5>
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

    <div class="modal fade" id="modalBuyPin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" action="{{ route('employer.buy-pin') }}">
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
                                    <input type="text" class="form-control" disabled id="price">
                                    <div class="input-group-append">
                                        <span class="input-group-text">đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        Bạn có chắc chắn muốn mua không không ?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning">Mua Ghim</button>
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
        $('#modalDelete').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-body input').val(id)
        })
        $('#modalBuyPin').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var price = button.data('price');
            console.log(price);
            var modal = $(this);
            modal.find('.modal-body input#id').val(id);
            modal.find('.modal-body input#price').val(price);
        })
    </script>
@endpush
