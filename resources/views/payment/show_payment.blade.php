@extends('layouts.employer')
@inject('GetStatusTrait', 'App\Repositories\Payment\PaymentRepositoryInterface')
@section('content')
    <div class="container">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                         src="https://cdn-icons-png.flaticon.com/512/1466/1466684.png"
                         alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">Nạp Tiền</h3>
                <p class="font-weight-bold text-center">{{ $payment['order_id'] }}</p>
                <ul class="list-group list-group-unbordered mb-3 col-7 mx-auto">
                    <li class="list-group-item">
                        <b>Số tiền nạp:</b> <a class="float-right">{{ number_format($payment['amount']) }} đ</a>
                    </li>
                    <li class="list-group-item">
                        <b>Loại Nạp:</b> <a class="float-right">{{ $payment['payment_text'] }}</a>
                    </li>
                    <li class="list-group-item">
                        <h4 class="font-weight-bold text-center
                        @if($payment['status'] == $GetStatusTrait->getStatusPending())
                            {{ 'text-info' }}
                        @elseif($payment['status'] == $GetStatusTrait->getStatusConfirm())
                            {{ 'text-success' }}
                        @elseif($payment['status'] == $GetStatusTrait->getStatusCancel())
                            {{ 'text-danger' }}
                        @endif
                        ">{{ $GetStatusTrait->getStatusById($payment['status']) }}</h4>
                    </li>
                </ul>
                @if($payment['status'] == $GetStatusTrait->getStatusPending())
                    @if($payment['payment_type']==0)
                        <a href="{{ $payment['link'] }}" class="btn btn-primary btn-block col-4 mx-auto"><b>Đến link
                                thanh
                                toán</b></a>
                    @else
                        <a class="btn btn-primary btn-block col-4 mx-auto" data-toggle="modal" data-target="#modalShow"><b>Xem Thông Tin Thanh Toán</b></a>
                    @endif
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalShow" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold" id="exampleModalCenterTitle">Thông tin chuyển khoản</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Ngân hàng:</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="text" class="form-control" disabled value="Vietcombank">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Số tài khoản:</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="text" class="form-control" readonly value="{{ $vcb['account_number'] }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Chủ tài khoản:</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="text" class="form-control" disabled value="{{ $vcb['account_name'] }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Nội dung chuyển khoản:</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="text" class="form-control" readonly value="{{ $payment['order_id'] }}">
                                </div>
                            </div>
                        </div>
                        Sau khi chuyển khoản,sẽ mất tối đa 10p để cộng tiền!
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
