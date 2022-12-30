<?php

namespace App\Services\PaymentService;

use App\Repositories\Payment\PaymentRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;
use App\Traits\CheckExistTrait;

class cancelPaymentService
{
    use CheckExistTrait;

    protected $paymentRepository;

    public function __construct(PaymentRepositoryInterface $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function cancelPayment($id)
    {
        try {
//            $post = $this->postRepository->getPost($id);

            if ($this->paymentRepository->cancelPayment($id)) {
                return redirect()->route('manager.show-all-payments');
            } else {
                return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau,vui lòng thử lại sau'])->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau,vui lòng thử lại sau'])->withInput();
        }
    }
}
