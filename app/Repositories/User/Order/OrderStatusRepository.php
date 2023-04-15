<?php

namespace App\Repositories\User\Order;

use App\Contracts\Repositories\User\OrderStatusRepositoryInterface;
use App\Exceptions\Order\OrderStatusNotFoundException;
use App\Models\OrderStatus;

class OrderStatusRepository implements OrderStatusRepositoryInterface
{
    /**
     * List all order statuses
     * 
     * @param array $filters
     * @param int $paginate
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function listAll(array $filters, int $paginate = 10)
    {
       //
    }

    /**
     * Find an order status
     * 
     * @param string $uuid
     * @return \App\Models\OrderStatus
     */
    public function find(string $uuid)
    {
        //
    }

    /**
     * Create an order status
     * 
     * @param string $title
     * @return \App\Models\OrderStatus
     */
    public function create(string $title)
    {
        //
    }

    /**
     * Update an order status
     * 
     * @param string $uuid
     * @param string $title
     * @return \App\Models\OrderStatus
     */
    public function update(string $uuid, string $title)
    {
        //
    }

    /**
     * Delete an order status
     * 
     * @param string $uuid
     * @return void
     */
    public function delete(string $uuid)
    {
        //
    }
}