<?php

namespace App\Traits;

trait PaymentTypeTrait
{
    public function getPaymentTypeById($id)
    {
        return config('setting.payment_type.' . $id);
    }

    public function getAllPayments()
    {
        return config('setting.payment_type');
    }
}
