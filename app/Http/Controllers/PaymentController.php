<?php

namespace App\Http\Controllers;

use App\Services\PaymentService\cancelPaymentService;
use App\Services\PaymentService\confirmPaymentService;
use App\Services\PaymentService\createPaymentService;
use App\Services\PaymentService\showAllPaymentsService;
use App\Services\PaymentService\showMyPaymentsService;
use App\Services\PaymentService\showPaymentService;
use App\Services\PaymentService\VNPayPaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $createPaymentService;
    protected $showMyPaymentsService;
    protected $showPaymentService;
    protected $VNPayPaymentService;
    protected $showAllPaymentsService;
    protected $confirmPaymentService;
    protected $cancelPaymentService;

    public function __construct(createPaymentService $createPaymentService,showMyPaymentsService $showMyPaymentsService, showPaymentService $showPaymentService, VNPayPaymentService $VNPayPaymentService, showAllPaymentsService $showAllPaymentsService, confirmPaymentService $confirmPaymentService, cancelPaymentService $cancelPaymentService)
    {
        $this->createPaymentService = $createPaymentService;
        $this->showMyPaymentsService = $showMyPaymentsService;
        $this->showPaymentService = $showPaymentService;
        $this->VNPayPaymentService = $VNPayPaymentService;
        $this->showAllPaymentsService = $showAllPaymentsService;
        $this->confirmPaymentService = $confirmPaymentService;
        $this->cancelPaymentService = $cancelPaymentService;
    }

    public function showCreatePaymentForm()
    {
        return $this->createPaymentService->showCreatePaymentForm();
    }

    public function createPayment(Request $request)
    {
        return $this->createPaymentService->createPayment($request->payment_type, $request->amount);
    }

    public function showMyPaymentsForm()
    {
        return $this->showMyPaymentsService->showMyPaymentsForm();
    }

    public function showPaymentForm($id)
    {
        return $this->showPaymentService->showPaymentForm($id);
    }

    public function VNPayPayment(Request $request)
    {
        return $this->VNPayPaymentService->VNPayPayment($request->vnp_Amount, $request->vnp_BankCode, $request->vnp_BankTranNo, $request->vnp_CardType, $request->vnp_OrderInfo, $request->vnp_PayDate, $request->vnp_ResponseCode, $request->vnp_TmnCode, $request->vnp_TransactionNo, $request->vnp_TransactionStatus, $request->vnp_TxnRef, $request->vnp_SecureHash);
    }

    public function showAllPaymentsForm()
    {
        return $this->showAllPaymentsService->showAllPaymentsForm();
    }

    public function confirmPayment(Request $request)
    {
        return $this->confirmPaymentService->confirmPayment($request->id);
    }

    public function cancelPayment(Request $request)
    {
        return $this->cancelPaymentService->cancelPayment($request->id);
    }
}
