<?php

namespace App\Repositories\VNPay;


use App\Models\Skill;
use Illuminate\Support\Facades\DB;

class VNPayRepository implements VNPayRepositoryInterface
{
    public function createVNPayLink($order_id, $amount)
    {
        $vnp_TmnCode = "HPUCNH2L";
        $vnp_HashSecret = "OUSEQHZLUNIKJWTVLKZJQBOCAZCSROKW";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $vnp_Locale = "vn";
        $vnp_OrderInfo = $order_id;
        $vnp_OrderType = "billpayment";
        $vnp_Returnurl = route('employer.vnpay-payment');
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
        $vnp_ExpireDate = date('YmdHis', strtotime('+15 minutes', strtotime(date("YmdHis"))));
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $amount * 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,//
            "vnp_Locale" => $vnp_Locale,//
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $order_id,//
            "vnp_ExpireDate" => $vnp_ExpireDate,
        );
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        $vnp_Url = $vnp_Url . "?" . $query;
        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        return $vnp_Url;
    }

    public function checkVNPayPayment($vnp_Amount, $vnp_BankCode, $vnp_BankTranNo, $vnp_CardType, $vnp_OrderInfo, $vnp_PayDate, $vnp_ResponseCode, $vnp_TmnCode, $vnp_TransactionNo, $vnp_TransactionStatus, $vnp_TxnRef, $vnp_SecureHash)
    {

    }
}
