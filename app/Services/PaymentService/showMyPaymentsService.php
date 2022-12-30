<?php

namespace App\Services\PaymentService;

use App\Repositories\Manager\ManagerRepositoryInterface;
use App\Repositories\Payment\PaymentRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Services\ValidateInputServices\validateInputManagerService;

class showMyPaymentsService
{
    protected $paymentRepository;

    public function __construct(PaymentRepositoryInterface $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function showMyPaymentsForm()
    {
        $employer_id = auth('employer')->user()->id;
        $payments = $this->paymentRepository->getPaymentsOfEmployer($employer_id);
        return view('payment.show_my_payments', ['payments' => $payments]);
    }
}
