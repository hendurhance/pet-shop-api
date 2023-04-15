<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            'Acer',
            'Apple',
            'Asus',
            'Dell',
            'HP',
            'Lenovo',
            'MSI',
            'Samsung',
            'Xiaomi',
        ];

        foreach ($brands as $brand) {
            Brand::factory()->create([
                'title' => $brand,
            ]);
        }
    }
}
