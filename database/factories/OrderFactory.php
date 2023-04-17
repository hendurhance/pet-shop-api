<?php

namespace Database\Factories;

use App\Enums\OrderStatusEnum;
use App\Models\OrderStatus;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::all()->pluck('id')->toArray();
        $orderStatus = OrderStatus::all()->random();
        $payments = Payment::all()->random()->first();
        $productsArray = Product::all()->random(3);
        $products = $this->getProducts($productsArray);
        $amount = $this->getAmount($products);
        return [
            'user_id' => $this->faker->randomElement($user),
            'order_status_id' => $orderStatus->id,
            'payment_id' => $orderStatus->title === OrderStatusEnum::PAID->value || $orderStatus === OrderStatusEnum::SHIPPED ? $payments->id : null,
            'products' => $this->getProducts($products),
            'address' => [
                'shipping' => $this->faker->address,
                'billing' => $this->faker->address,
            ],
            'amount' => $amount,
            'delivery_fee' => $amount > 500 ? 0 : 15,
        ];
    }

    /**
     * Get products uuid and random quantity
     * 
     * @param \Illuminate\Support\Collection $products
     * @return array<string, array<string, int>>
     */
    private function getProducts($products): array
    {
        $productsArray = [];
        foreach ($products as $product) {
            if (isset($product['uuid'])) {
                $productsArray[] = [
                    'product' => $product['uuid'],
                    'quantity' => $this->faker->numberBetween(1, 5),
                ];
            }
        }
        return $productsArray;
    }

    /**
     * Get total amount of products
     * 
     * @param array<string, int> $products
     * @return float
     */
    private function getAmount($products): float
    {
        $amount = 0;
        foreach ($products as $product) {
            $amount += $product['quantity'] * Product::query()->whereUuid($product['product'])->first()->price;
        }
        return $amount;
    }
}
