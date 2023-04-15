<?php

namespace App\Repositories\User\Order;

use App\Actions\Auth\AuthAction;
use App\Contracts\Repositories\User\OrderRepositoryInterface;
use App\Contracts\Repositories\User\OrderStatusRepositoryInterface;
use App\Contracts\Repositories\User\PaymentRepositoryInterface;
use App\Contracts\Repositories\User\ProductRepositoryInterface;
use App\Exceptions\Order\OrderNotFoundException;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Collection;

class OrderRepository implements OrderRepositoryInterface
{
    /**
     * @var AuthAction
     */
    private $authAction;

    /**
     * AuthRepository Constructor
     */
    public function __construct(
        private OrderStatusRepositoryInterface $orderStatusRepository,
        private PaymentRepositoryInterface $paymentRepository,
        private ProductRepositoryInterface $productRepository
    ) {
        $this->authAction = new AuthAction();
        $this->orderStatusRepository = $orderStatusRepository;
        $this->paymentRepository = $paymentRepository;
    }

    /**
     * Create a new order
     *
     * @param array $data
     * @return \App\Models\Order
     */
    public function create(array $data)
    {
        $user = $this->authAction->user();
        $orderStatus = $this->orderStatusRepository->find($data['order_status_uuid']);
        $payment = $this->paymentRepository->fetch($data['payment_uuid']);
        $products = $this->getProducts($data['products']);
        $amount = $this->calculateAmount($products);

        $order = Order::create([
            'user_id' => $user->id,
            'order_status_id' => $orderStatus->id,
            'payment_id' => $payment->id,
            'address' => $data['address'],
            'products' => $products,
            'delivery_fee' => $amount > 500 ? 0 : 50,
            'amount' => number_format($amount, 2, '.', ''),
        ]);

        return $order->load('orderStatus', 'payment', 'user');
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
        $order = $this->fetch($uuid);
        $orderStatus = $this->orderStatusRepository->find($data['order_status_uuid']);
        $payment = $this->paymentRepository->fetch($data['payment_uuid']);
        $products = $this->getProducts($data['products']);
        $amount = $this->calculateAmount($products);

        $order->update([
            'order_status_id' => $orderStatus->id,
            'payment_id' => $payment->id,
            'address' => $data['address'],
            'products' => $products,
            'delivery_fee' => $amount > 500 ? 0 : 15,
            'amount' => number_format($amount, 2, '.', ''),
        ]);

        return $order->load('orderStatus', 'payment', 'user');
    }

    /**
     * Delete an order
     *
     * @param string $uuid
     * @return void
     */
    public function delete(string $uuid)
    {
        $product = $this->fetchWithoutRelationship($uuid);
        $product->delete();
    }

    /**
     * Fetch an order with relationships
     *
     * @param string $uuid
     * @return \App\Models\Order
     */
    public function fetchWithoutRelationship(string $uuid)
    {
        return Order::whereUuid($uuid)->firstOr(function () {
            throw new OrderNotFoundException();
        });
    }

    /**
     * Fetch an order
     *
     * @param string $uuid
     * @return \App\Models\Order
     */
    public function fetch(string $uuid)
    {
        $order = $this->fetchWithoutRelationship($uuid);
        $order->load('orderStatus', 'payment', 'user');
        $order->setRelation('products', $order->products()->get());
        return $order;
    }

    /**
     * List all orders
     *
     * @param array $filters
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function listAll(array $filters, int $paginate = 10)
    {
        $query = Order::query()->with('orderStatus', 'payment', 'user');

        if (isset($filters['sortBy'])) {
            $query->sortBy($filters['sortBy'], $filters['desc'] ?? false);
        }

        if (isset($filters['page'])) {
            $query->wherePage($filters['page']);
        }

        return $query->paginate($filters['limit'] ?? $paginate);
    }

    /**
     * List all orders for auth user
     *
     * @param array $filters
     * @param int $paginate
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function listUserAll(array $filters, int $paginate = 10)
    {
        $user = $this->authAction->user();
        $query = Order::query()->whereUserOwns($user->id)->with('orderStatus', 'payment', 'user');

        if (isset($filters['sortBy'])) {
            $query->sortBy($filters['sortBy'], $filters['desc'] ?? false);
        }

        if (isset($filters['page'])) {
            $query->wherePage($filters['page']);
        }

        return $query->paginate($filters['limit'] ?? $paginate);
    }

    /**
     * List all orders for shipment locator
     *
     * @param array $filters
     * @param int $paginate
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function listShipmentLocators(array $filters, int $paginate = 10)
    {
        $query = Order::query()->whereShipped()->with('orderStatus', 'user');

        if (isset($filters['customerUuid'])) {
            $query->whereCustomerUuid($filters['customerUuid']);
        }

        if (isset($filters['orderUuid'])) {
            $query->whereUuidLike($filters['orderUuid']);
        }

        if (isset($filters['sortBy'])) {
            $query->sortBy($filters['sortBy'], $filters['desc'] ?? false);
        }

        if (isset($filters['page'])) {
            $query->wherePage($filters['page']);
        }

        if (isset($filters['fixRange'])) {
            $query->whereFixRange($filters['fixRange']);
        }

        if (isset($filters['dateRange'])) {
            $query->whereDateRange($filters['dateRange']);
        }

        return $query->paginate($filters['limit'] ?? $paginate);
    }

    /**
     * List all orders for dashboard
     *
     * @param array $filters
     * @param int $paginate
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function listDashboard(array $filters, int $paginate = 10)
    {
        $query = Order::query()->with('orderStatus', 'payment', 'user');

        if (isset($filters['sortBy'])) {
            $query->sortBy($filters['sortBy'], $filters['desc'] ?? false);
        }

        if (isset($filters['page'])) {
            $query->wherePage($filters['page']);
        }

        if (isset($filters['fixRange'])) {
            $query->whereFixRange($filters['fixRange']);
        }

        if (isset($filters['dateRange'])) {
            $query->whereDateRange($filters['dateRange']);
        }

        return $query->paginate($filters['limit'] ?? $paginate);
    }

    /**
     * Download an order
     *
     * @param string $uuid
     * @return \Illuminate\Http\Response
     */
    public function download(string $uuid)
    {
        $order = $this->fetchWithoutRelationship($uuid);
        $pdf = PDF::loadView('pdf.order', ['order' => $order->load('payment', 'user')]);
        $pdf->setPaper('a4', 'portrait');
        return $pdf->download('order_' . $order->uuid . '.pdf');
    }

    /**
     * Get the products
     *
     * @param array $products
     * @return \Illuminate\Support\Collection
     */
    private function getProducts(array $products): Collection
    {
        return collect($products)->map(function ($product) {
            return [
                'product' => $this->productRepository->fetch($product['uuid'])->uuid,
                'quantity' => $product['quantity'],
            ];
        });
    }

    /**
     * Calculate the amount
     *
     * @param \Illuminate\Support\Collection $products
     * @return float
     */
    private function calculateAmount(Collection $products): float
    {
        return $products->map(function ($product) {
            return $product['quantity'] * $this->productRepository->fetch($product['product'])->price;
        })->sum();
    }
}
