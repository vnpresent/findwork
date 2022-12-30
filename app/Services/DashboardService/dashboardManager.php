<?php

namespace App\Services\DashboardService;


use App\Repositories\Cv\CvRepositoryInterface;
use App\Repositories\Payment\PaymentRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;

class dashboardManager
{
    protected $postRepository;
    protected $cvRepository;
    protected $paymentRepository;

    public function __construct(PostRepositoryInterface $postRepository, CvRepositoryInterface $cvRepository, PaymentRepositoryInterface $paymentRepository)
    {
        $this->postRepository = $postRepository;
        $this->cvRepository = $cvRepository;
        $this->paymentRepository = $paymentRepository;
    }

    public function dashboardManager()
    {
        $posts = $this->postRepository->getAllPosts();
        $cvs = $this->cvRepository->getAllCvs();
        $payments = $this->paymentRepository->getAllPayments();
        $total = 0;
        $pinned_post = $this->postRepository->getAllPinnedPost();
        foreach ($payments as $payment) {
            if ($payment['status'] == 1) {
                $total += $payment['amount'];
            }
        }
        return view('dashboard.manager', ['posts' => $posts, 'cvs' => $cvs, 'total' => $total, 'pinned_post' => $pinned_post]);
    }
}
