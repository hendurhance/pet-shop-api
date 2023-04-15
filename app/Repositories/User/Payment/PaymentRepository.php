<?php

namespace App\Repositories\User\Payment;

use App\Contracts\Repositories\User\PaymentRepositoryInterface;
use App\Exceptions\Payment\PaymentNotFoundException;
use App\Models\Payment;

class PaymentRepository implements PaymentRepositoryInterface
{
    /**
     * Create a new payment
     * 
     * @param array $data
     * @return \App\Models\Payment
     */
    public function create(array $data)
    {
        return Payment::create($data);
    }

    /**
     * Update a payment
     * 
     * @param array $data
     * @param string $uuid
     * @return \App\Models\Payment
     */
    public function update(array $data, string $uuid)
    {
        $payment = $this->fetch($uuid);
        $payment->update($data);

        return $payment;
    }

    /**
     * Delete a payment
     * 
     * @param string $uuid
     * @return void
     */
    public function delete(string $uuid)
    {
        $payment = $this->fetch($uuid);
        $payment->delete();
    }

    /**
     * Fetch a payment
     * 
     * @param string $uuid
     * @return \App\Models\Payment
     */
    public function fetch(string $uuid)
    {
        return Payment::whereUuid($uuid)->firstOr(function () {
            throw new PaymentNotFoundException();
        });
    }

    /**
     * List all payments
     * 
     * @param array $filters
     * @param int $paginate = 10
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function listAll(array $filters, int $paginate = 10)
    {
        $query = Payment::query();

        if (isset($filters['sortBy'])) $query->sortBy($filters['sortBy'], $filters['desc'] ?? false);

        if (isset($filters['page'])) $query->wherePage($filters['page']);

        return $query->paginate($filters['limit'] ?? $paginate);
    }
}
