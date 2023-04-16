<?php

namespace App\Http\Controllers\API\V1\User\User;

use App\Contracts\Repositories\User\OrderRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Order\OrderListingRequest;

class OrderController extends Controller
{
    /**
     * UserController constructor.
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct(private OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->middleware('jwt.auth');
        $this->middleware('role:user');
    }

    /**
     * Show all orders for the authenticated user
     *
     * @param OrderListingRequest $request
     * @return \App\Traits\HttpResponse
     */
    public function index(OrderListingRequest $request)
    {
        $orders = $this->orderRepository->listUserAll($request->validated());
        return $this->success($orders, 'Orders listed successfully');
    }
}
