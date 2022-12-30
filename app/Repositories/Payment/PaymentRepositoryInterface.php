<?php

namespace App\Repositories\Payment;


interface PaymentRepositoryInterface
{
    public function createPayment($employer_id, $payment_type, $amount);

    public function getPayment($id);

    public function getPaymentsOfEmployer($employer_id);

    public function getAllPayments();

    public function getPaymentByOrderId($orderId);

    public function confirmPayment($id, $manager_id);

    public function cancelPayment($id);
}
