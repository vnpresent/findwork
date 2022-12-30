<?php

namespace App\Services\PaymentService;

use App\Repositories\Manager\ManagerRepositoryInterface;
use App\Repositories\Payment\PaymentRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\VNPay\VNPayRepositoryInterface;
use App\Services\ValidateInputServices\validateInputManagerService;

class VNPayPaymentService
{
    protected $paymentRepository;

    public function __construct(PaymentRepositoryInterface $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function VNPayPayment($vnp_Amount, $vnp_BankCode, $vnp_BankTranNo, $vnp_CardType, $vnp_OrderInfo, $vnp_PayDate, $vnp_ResponseCode, $vnp_TmnCode, $vnp_TransactionNo, $vnp_TransactionStatus, $vnp_TxnRef, $vnp_SecureHash)
    {
        $vnp_HashSecret = "OUSEQHZLUNIKJWTVLKZJQBOCAZCSROKW";
        $inputData = array();
        $inputData['vnp_Amount'] = $vnp_Amount;
        $inputData['vnp_BankCode'] = $vnp_BankCode;
        $inputData['vnp_BankTranNo'] = $vnp_BankTranNo;
        $inputData['vnp_CardType'] = $vnp_CardType;
        $inputData['vnp_OrderInfo'] = $vnp_OrderInfo;
        $inputData['vnp_PayDate'] = $vnp_PayDate;
        $inputData['vnp_ResponseCode'] = $vnp_ResponseCode;
        $inputData['vnp_TmnCode'] = $vnp_TmnCode;
        $inputData['vnp_TransactionNo'] = $vnp_TransactionNo;
        $inputData['vnp_TransactionStatus'] = $vnp_TransactionStatus;
        $inputData['vnp_TxnRef'] = $vnp_TxnRef;
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        $payment = $this->paymentRepository->getPaymentByOrderId($vnp_TxnRef);
        if ($secureHash == $vnp_SecureHash) {
            if ($this->paymentRepository->confirmPayment($payment['id'], null)) {
                return redirect()->route('employer.show-payment-form', ['id' => $payment['id']])->with(['success' => 'Thành công']);
            } else {
                return redirect()->route('employer.show-payment-form', ['id' => $payment['id']])->with(['error' => 'Thất bại,có lỗi sảy ra']);
            }
        } else {
            dd('error');
        }
    }
}
