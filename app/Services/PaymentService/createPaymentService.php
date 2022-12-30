<?php

namespace App\Services\PaymentService;

use App\Repositories\Manager\ManagerRepositoryInterface;
use App\Repositories\Payment\PaymentRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Services\ValidateInputServices\validateInputManagerService;

class createPaymentService
{
    protected $paymentRepository;

    public function __construct(PaymentRepositoryInterface $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function showCreatePaymentForm()
    {
//        $roles = $this->roleRepository->getAllRoles();
        return view('payment.create_payment');
    }

    public function  createPayment($payment_type, $amount)
    {
        $employer_id = auth('employer')->user()->id;
        $payment = $this->paymentRepository->createPayment($employer_id, $payment_type, $amount);
        return redirect()->route('employer.show-payment-form', ['id' => $payment['id']]);
    }
}
