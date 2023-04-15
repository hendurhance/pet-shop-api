<?php

namespace App\Http\Controllers\API\V1\User\Order;

use App\Contracts\Repositories\User\OrderStatusRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Order\CreateOrderStatusRequest;
use App\Http\Requests\User\Order\OrderStatusListingRequest;
use App\Http\Requests\User\Order\UpdateOrderStatusRequest;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{

    /**
     * OrderStatusController constructor.
     * @param OrderStatusRepositoryInterface $orderStatusRepository
     */
    public function __construct(private OrderStatusRepositoryInterface $orderStatusRepository)
    {
        $this->middleware('auth:api')->except('index', 'show');
        $this->middleware('role:user')->except('index', 'show');
        $this->orderStatusRepository = $orderStatusRepository;
    }

    /**
     * List all order statuses
     * 
     * @param OrderStatusListingRequest $request
     * @return \App\Traits\HttpResponse
     */
    public function index(OrderStatusListingRequest $request)
    {
        $orderStatuses = $this->orderStatusRepository->listAll($request->validated());
        return $this->success($orderStatuses, 'Order statuses listed successfully');
    }

    /**
     * Create a new order status
     * 
     * @param CreateOrderStatusRequest $request
     * @return \App\Traits\HttpResponse
     */
    public function store(CreateOrderStatusRequest $request)
    {
        $orderStatus = $this->orderStatusRepository->create($request->title);
        return $this->success($orderStatus, 'Order status created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        $orderStatus = $this->orderStatusRepository->find($uuid);
        return $this->success($orderStatus, 'Order status found successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderStatusRequest $request, string $uuid)
    {
        $orderStatus = $this->orderStatusRepository->update($uuid, $request->title);
        return $this->success($orderStatus, 'Order status updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        $this->orderStatusRepository->delete($uuid);
        return $this->success(null, 'Order status deleted successfully');
    }
}
