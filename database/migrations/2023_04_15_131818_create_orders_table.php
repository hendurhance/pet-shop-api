<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('order_status_id')->references('id')->on('order_statuses')->cascadeOnDelete();
            $table->foreignId('payment_id')->references('id')->on('payments')->cascadeOnDelete();
            $table->uuid('uuid')->unique()->index()->comment('UUID to allow easy migration between envs without breaking FK in the logic');
            $table->json('products')->comment('JSON array of products');
            $table->json('address')->comment('JSON array of address, billing and shipping');
            $table->double('delivery_fee', 8, 2)->nullable();
            $table->decimal('amount', 12, 2);
            $table->timestamp('shipped_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
