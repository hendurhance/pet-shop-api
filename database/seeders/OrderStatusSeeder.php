<?php

namespace Database\Seeders;

use App\Enums\OrderStatusEnum;
use App\Models\OrderStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orderStatuses = OrderStatusEnum::getValues();

        foreach ($orderStatuses as $orderStatus) {
            OrderStatus::factory()->create([
                'title' => $orderStatus,
            ]);
        }
    }
}
