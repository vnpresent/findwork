<?php

namespace App\Repositories\Setting;

class SettingRepository implements SettingRepositoryInterface
{
    public function getPinPrice()
    {
        return config('setting.price.pin');
    }

    public function getCVPrice()
    {
        return config('setting.price.cv');
    }

    public function getVNPayInfo()
    {
        return config('setting.payment_setting.vnpay');
    }

    public function getVCBInfo()
    {
        return config('setting.payment_setting.vcb');
    }
}
