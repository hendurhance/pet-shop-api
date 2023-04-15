<?php

namespace App\Repositories\User\Payment;

use App\Contracts\Repositories\User\PaymentRepositoryInterface;

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
        //
    }

    /**
     * Update a payment
     * 
     * @param string $uuid
     * @param array $data
     * @return \App\Models\Payment
     */
    public function update(string $uuid, array $data)
    {
        //
    }

    /**
     * Delete a payment
     * 
     * @param string $uuid
     * @return void
     */
    public function delete(string $uuid)
    {
        //
    }

    /**
     * Fetch a payment
     * 
     * @param string $uuid
     * @return \App\Models\Payment
     */
    public function fetch(string $uuid)
    {
        //
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
        //
    }
}