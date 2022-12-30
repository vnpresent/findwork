<?php

namespace App\Services\PaymentService;

use App\Repositories\Manager\ManagerRepositoryInterface;
use App\Repositories\Payment\PaymentRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Services\ValidateInputServices\validateInputManagerService;

class showAllPaymentsService
{
    protected $paymentRepository;

    public function __construct(PaymentRepositoryInterface $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function showAllPaymentsForm()
    {
        $payments = $this->paymentRepository->getAllPayments();
//        dd($payments);
        return view('payment.show_all_payments', ['payments' => $payments]);
    }
}
