<?php

namespace App\Repositories\Payment;


use App\Models\Payment;
use App\Repositories\Employer\EmployerRepositoryInterface;
use App\Repositories\VNPay\VNPayRepositoryInterface;
use App\Traits\GetStatusTrait;
use App\Traits\PaymentTypeTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PaymentRepository implements PaymentRepositoryInterface
{
    use GetStatusTrait, PaymentTypeTrait;

    protected $VNPayRepository;
    protected $employerRepository;

    public function __construct(VNPayRepositoryInterface $VNPayRepository, EmployerRepositoryInterface $employerRepository)
    {
        $this->VNPayRepository = $VNPayRepository;
        $this->employerRepository = $employerRepository;
    }

    public function createPayment($employer_id, $payment_type, $amount)
    {
        $order_id = $employer_id . 'OI' . Carbon::now()->timestamp;
        if ($payment_type == 0) {
            $link = $this->VNPayRepository->createVNPayLink($order_id, $amount);
        } else {
            $link = "";
        }
        $data = [
            'employer_id' => $employer_id,
            'order_id' => $order_id,
            'payment_type' => $payment_type,
            'amount' => $amount,
            'link' => $link,
            'status' => $this->getStatusPending(),
        ];
        return Payment::create($data)->toArray();
    }

    public function getPayment($id)
    {
        $payment = Payment::find($id)->toArray();
        $payment['payment_text'] = $this->getPaymentTypeById($payment['payment_type']);
        return $payment;
    }

    public function getPaymentsOfEmployer($employer_id)
    {
        $data = [];
        $payments = Payment::where('employer_id', '=', $employer_id)->orderBy('created_at', 'desc')->get()->toArray();
        foreach ($payments as $payment) {
            $payment = (array)$payment;
            $payment['status_text'] = $this->getStatusById($payment['status']);
            $payment['payment_type'] = $this->getPaymentTypeById($payment['payment_type']);
            $data[] = $payment;
        }
        return $data;
    }

    public function getAllPayments()
    {
        $data = [];
        $payments = Payment::orderBy('created_at', 'desc')->get()->toArray();
        foreach ($payments as $payment) {
            $payment = (array)$payment;
            $payment['status_text'] = $this->getStatusById($payment['status']);
            $payment['payment_type'] = $this->getPaymentTypeById($payment['payment_type']);
            $data[] = $payment;
        }
        return $data;
    }

    public function getPaymentByOrderId($orderId)
    {
        $payment = Payment::where('order_id', '=', $orderId)->latest()->get()->toArray();
        if (count($payment) > 0) {
            return $payment[0];
        }
        return $payment;
    }

    public function confirmPayment($id, $manager_id)
    {
        $payment = Payment::find($id);
        if ($payment->status === $this->getStatusPending()) {
            $payment->update([
                'status' => $this->getStatusConfirm(),
                'manager_id' => $manager_id,
            ]);
            $this->employerRepository->addBalance($payment->employer_id, $payment->amount);
            return true;
        }
        return false;
    }

    public function cancelPayment($id)
    {
        return Payment::find($id)->update([
            'status' => $this->getStatusCancel(),
            'manager_id' => auth('manager')->user()->id,
        ]);
    }
}
