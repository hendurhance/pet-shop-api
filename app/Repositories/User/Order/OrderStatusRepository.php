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
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function listAll(array $filters, int $paginate = 10)
    {
        $query = OrderStatus::query();

        if (isset($filters['sortBy'])) {
            $query->sortBy($filters['sortBy'], $filters['desc'] ?? false);
        }

        if(isset($filters['page'])) {
            $query->wherePage($filters['page']);
        }

        return $query->paginate($filters['limit'] ?? $paginate);
    }

    /**
     * Find an order status
     *
     * @param string $uuid
     * @return \App\Models\OrderStatus
     */
    public function find(string $uuid)
    {
        return OrderStatus::whereUuid($uuid)->firstOr(function () {
            throw new OrderStatusNotFoundException();
        });
    }

    /**
     * Create an order status
     *
     * @param string $title
     * @return \App\Models\OrderStatus
     */
    public function create(string $title)
    {
        return OrderStatus::create([
            'title' => $title
        ]);
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
        $orderStatus = $this->find($uuid);
        $orderStatus->update([
            'title' => $title
        ]);

        return $orderStatus;
    }

    /**
     * Delete an order status
     *
     * @param string $uuid
     * @return void
     */
    public function delete(string $uuid)
    {
        $orderStatus = $this->find($uuid);
        $orderStatus->delete();
    }
}
