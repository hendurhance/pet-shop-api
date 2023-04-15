<?php

namespace App\Http\Controllers\API\V1\User\Payment;

use App\Contracts\Repositories\User\PaymentRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Payment\CreatePaymentRequest;
use App\Http\Requests\User\Payment\PaymentListingRequest;
use App\Http\Requests\User\Payment\UpdatePaymentRequest;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * PaymentController constructor.
     */
    public function __construct(private PaymentRepositoryInterface $paymentRepository)
    {
        $this->middleware('auth:api');
        $this->middleware('role:user');
        $this->paymentRepository = $paymentRepository;
    }

    /**
     * List all payments
     *
     * @param PaymentListingRequest $request
     * @return \App\Traits\HttpResponse
     */
    public function index(PaymentListingRequest $request)
    {
        $payments = $this->paymentRepository->listAll($request->validated());
        return $this->success($payments, 'Payments listed successfully');
    }

    /**
     * Create a new payment
     *
     * @param CreatePaymentRequest $request
     * @return \App\Traits\HttpResponse
     */
    public function store(CreatePaymentRequest $request)
    {
        $payment = $this->paymentRepository->create($request->validated());
        return $this->success($payment, 'Payment created successfully');
    }

    /**
     * Show a payment
     *
     * @param string $uuid
     * @return \App\Traits\HttpResponse
     */
    public function show(string $uuid)
    {
        $payment = $this->paymentRepository->fetch($uuid);
        return $this->success($payment, 'Payment found successfully');
    }

    /**
     * Update a payment
     *
     * @param UpdatePaymentRequest $request
     * @param string $uuid
     */
    public function update(UpdatePaymentRequest $request, string $uuid)
    {
        $payment = $this->paymentRepository->update($request->validated(), $uuid);
        return $this->success($payment, 'Payment updated successfully');
    }

    /**
     * Delete a payment
     *
     * @param string $uuid
     * @return \App\Traits\HttpResponse
     */
    public function destroy(string $uuid)
    {
        $this->paymentRepository->delete($uuid);
        return $this->success(null, 'Payment deleted successfully');
    }
}
