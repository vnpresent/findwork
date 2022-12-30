<?php

namespace App\Services\DashboardService;


use App\Repositories\Cv\CvRepositoryInterface;
use App\Repositories\Payment\PaymentRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;

class dashboardEmployer
{
    protected $postRepository;
    protected $paymentRepository;
    protected $cvRepository;

    public function __construct(PostRepositoryInterface $postRepository, PaymentRepositoryInterface $paymentRepository, CvRepositoryInterface $cvRepository)
    {
        $this->postRepository = $postRepository;
        $this->paymentRepository = $paymentRepository;
        $this->cvRepository = $cvRepository;
    }

    public function dashboardEmployer()
    {
        $employer_id = auth('employer')->user()->id;
        $posts = $this->postRepository->getPostsOfEmpolyer($employer_id);
        $payments = $this->paymentRepository->getPaymentsOfEmployer($employer_id);
        $cvs = $this->cvRepository->getPurchasedCvs($employer_id);
        $total = 0;
        foreach ($payments as $payment) {
            if ($payment['status'] == 1) {
                $total += $payment['amount'];
            }
        }
        return view('dashboard.employer', ['posts' => $posts, 'total' => $total, 'cvs' => $cvs]);
    }
}
