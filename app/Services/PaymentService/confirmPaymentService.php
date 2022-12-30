<?php

namespace App\Services\PaymentService;

use App\Repositories\Payment\PaymentRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;
use App\Traits\CheckExistTrait;

class confirmPaymentService
{
    use CheckExistTrait;

    protected $paymentRepository;

    public function __construct(PaymentRepositoryInterface $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function confirmPayment($id)
    {
        try {
            $manager_id = auth('manager')->user()->id;
            if ($this->paymentRepository->confirmPayment($id, $manager_id)) {
                return redirect()->route('manager.show-all-payments');
            } else {
                return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau,vui lòng thử lại sau'])->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau,vui lòng thử lại sau'])->withInput();
        }
    }
}
