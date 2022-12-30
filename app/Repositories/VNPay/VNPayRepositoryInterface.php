<?php

namespace App\Repositories\VNPay;


interface VNPayRepositoryInterface
{
    public function createVNPayLink($order_id, $amount);

    public function checkVNPayPayment($vnp_Amount, $vnp_BankCode, $vnp_BankTranNo, $vnp_CardType, $vnp_OrderInfo, $vnp_PayDate, $vnp_ResponseCode, $vnp_TmnCode, $vnp_TransactionNo, $vnp_TransactionStatus, $vnp_TxnRef, $vnp_SecureHash);
}
