<?php

namespace App\Repositories\User\Order;

use App\Contracts\Repositories\User\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    /**
     * Create a new order
     * 
     * @param array $data
     * @return \App\Models\Order
     */
    public function create(array $data)
    {
        //
    }

    /**
     * Update an order
     * 
     * @param array $data
     * @param string $uuid
     * @return \App\Models\Order
     */
    public function update(array $data, string $uuid)
    {
        //
    }

    /**
     * Delete an order
     * 
     * @param string $uuid
     * @return void
     */
    public function delete(string $uuid)
    {
        //
    }

    /**
     * Fetch an order
     * 
     * @param string $uuid
     * @return \App\Models\Order
     */
    public function fetch(string $uuid)
    {
        //
    }

    /**
     * List all orders
     * 
     * @param array $filters
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function listAll(array $filters)
    {
        //
    }

    /**
     * List all orders for shipment locator
     * 
     * @param array $filters
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function listShipmentLocators(array $filters)
    {
        //
    }

    /**
     * List all orders for dashboard
     * 
     * @param array $filters
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function listDashboard(array $filters)
    {
        //
    }

    /**
     * Download an order
     * 
     * @param string $uuid
     * @return \Illuminate\Http\Response
     */
    public function download(string $uuid)
    {
       //
    }
}