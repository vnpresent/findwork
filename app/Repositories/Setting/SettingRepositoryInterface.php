<?php

namespace App\Repositories\Setting;


interface SettingRepositoryInterface
{
    public function getPinPrice();

    public function getCVPrice();

    public function getVNPayInfo();

    public function getVCBInfo();
}
