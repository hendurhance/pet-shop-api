<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 1 user with UserTypeEnum::IS_ADMIN
        User::factory()->admin()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'admin@buckhill.co.uk',
            'password' => bcrypt('admin')
        ]);
        // Create 10 users with UserTypeEnum::IS_USER
        User::factory()->count(100)->user()->create();
    }
}
