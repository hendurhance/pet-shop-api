<?php

namespace App\Models;

use App\Builders\Order\OrderBuilder;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, UuidTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'uuid',
        'user_id',
        'order_status_id',
        'payment_id',
        'products',
        'address',
        'delivery_fee',
        'amount',
        'shipped_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'products' => 'array',
        'address' => 'array',
        'shipped_at' => 'datetime',
    ];

    /**
     * Get the user that owns the order.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the order status that owns the order.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    /**
     * Get the payment that owns the order.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    /**
     * Get the products for the order.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        // TODO:
        // get the products from json table in Order model with the following structure:
        // [
        //     [
        //         'product' => '4567890-1234-5678-9012-123456789012',
        //         'quantity' => 1,
        //     ],
        //     [
        //         'product' => '4567890-1234-5678-9012-123456789012',
        //         'quantity' => 1,
        //     ],
        // Connect the products with the products table using the product uuid
        $productJson = $this->attributes['products'];
        $productUuids = array_column($productJson, 'product');
        return Product::whereIn('uuid', $productUuids)->get();
    }

    /**
     * Instantiate a new QueryBuilder instance.
     */
    public function newEloquentBuilder($query): OrderBuilder
    {
        return new OrderBuilder($query);
    }
}
