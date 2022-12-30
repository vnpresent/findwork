@extends('layouts.employer')
@push('title')
    Tạo Phiếu Nạp Tiền
@endpush
@section('content')
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <form method="post" action="{{ route('employer.create-payment') }}"
                  class="form-inline justify-content-center">
                @csrf
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <div class="col mb-5">
                        <div class="card h-100">
                            <img class="card-img-top"
                                 src="{{ asset('image/VNPay.png') }}"
                                 alt="..."/>
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <h5 class="fw-bolder">VNPay</h5>
                                    <input type="radio" name="payment_type" checked value="0">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <img class="card-img-top"
                                 src="{{ asset('image/VCB.jpg') }}"
                                 alt="..."/>
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <h5 class="fw-bolder">VCB</h5>
                                    <input type="radio" name="payment_type" value="1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container form-group mx-sm-3 mb-2 justify-content-center">
                    <input type="number" class="form-control" name="amount" id="inputPassword2"
                           placeholder="Nhập số tiền cần nạp">
                    <div class="input-group-append">
                        <span class="input-group-text">đ</span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mb-2">Tạo đơn nạp</button>
            </form>
        </div>
    </section>
@endsection
