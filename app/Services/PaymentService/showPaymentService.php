<?php

namespace App\Services\PaymentService;

use App\Repositories\Manager\ManagerRepositoryInterface;
use App\Repositories\Payment\PaymentRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\Setting\SettingRepositoryInterface;
use App\Services\ValidateInputServices\validateInputManagerService;

class showPaymentService
{
    protected $paymentRepository;
    protected $settingRepository;

    public function __construct(PaymentRepositoryInterface $paymentRepository, SettingRepositoryInterface $settingRepository)
    {
        $this->paymentRepository = $paymentRepository;
        $this->settingRepository = $settingRepository;
    }

    public function showPaymentForm($id)
    {
        $payment = $this->paymentRepository->getPayment($id);
        $vcb = $this->settingRepository->getVCBInfo();
        return view('payment.show_payment', ['payment' => $payment, 'vcb' => $vcb]);
    }
}
