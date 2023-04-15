<?php

namespace App\Http\Controllers\API\V1\User\Order;

use App\Contracts\Repositories\User\OrderRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Order\CreateOrderRequest;
use App\Http\Requests\User\Order\OrderListingRequest;
use App\Http\Requests\User\Order\OrderPopulateRequest;
use App\Http\Requests\User\Order\OrderShippingListingRequest;
use App\Http\Requests\User\Order\UpdateOrderRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    /**
     * OrderController constructor.
     */
    public function __construct(private OrderRepositoryInterface $orderRepository)
    {
        $this->middleware('auth:api');
        $this->middleware('role:user');
        $this->orderRepository = $orderRepository;
    }

    /**
     * List all orders
     * 
     * @param OrderListingRequest $request
     * @return \App\Traits\HttpResponse
     */
    public function index(OrderListingRequest $request)
    {
        $orders = $this->orderRepository->listAll($request->validated());
        return $this->success($orders, 'Orders listed successfully');
    }

    /**
     * Create a new order
     * 
     * @param CreateOrderRequest $request
     * @return \App\Traits\HttpResponse
     */
    public function store(CreateOrderRequest $request)
    {
        $order = $this->orderRepository->create($request->validated());
        return $this->success($order, 'Order created successfully');
    }

    /**
     * Show order details
     * 
     * @param string $uuid
     * @return \App\Traits\HttpResponse
     */
    public function show(string $uuid)
    {
        $order = $this->orderRepository->fetch($uuid);
        return $this->success($order, 'Order found successfully');
    }

    /**
     * Update order details
     * 
     * @param UpdateOrderRequest $request
     * @param string $uuid
     * @return \App\Traits\HttpResponse
     */
    public function update(UpdateOrderRequest $request, string $uuid)
    {
        $order = $this->orderRepository->update($request->validated(), $uuid);
        return $this->success($order, 'Order updated successfully');
    }

    /**
     * Delete an order
     * 
     * @param string $uuid
     * @return \App\Traits\HttpResponse
     */
    public function destroy(string $uuid)
    {
        $this->orderRepository->delete($uuid);
        return $this->success(null, 'Order deleted successfully');
    }

    /**
     * List order shipping locator
     * 
     */
    public function shipmentLocator(OrderShippingListingRequest $request)
    {
        $shippingLocator = $this->orderRepository->listShipmentLocators($request->validated());
        return $this->success($shippingLocator, 'Shipping locator listed successfully');
    }

    /**
     * Populate orders in dashboard
     * 
     * @param OrderPopulateRequest $request
     * @return \App\Traits\HttpResponse
     */
    public function dashboard(OrderPopulateRequest $request)
    {
        $orders = $this->orderRepository->listDashboard($request->validated());
        return $this->success($orders, 'Orders populated successfully');
    }

    /**
     * Download order invoice
     * 
     * @param string $uuid
     * @return \App\Traits\HttpResponse
     */
    public function download(string $uuid)
    {
        return $this->orderRepository->download($uuid);
    }
}
