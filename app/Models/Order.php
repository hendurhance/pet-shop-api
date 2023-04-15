<?php

namespace App\Models;

use App\Builders\Order\OrderBuilder;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPSTORM_META\map;

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
     * Get total amount of the order
     * 
     * @return \Illuminate\Suppo
     */
    public function total(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->attributes['amount'] + $this->attributes['delivery_fee'],
        );
    }

    /**
     * Get the products associated with the order.
     */
    public function products()
    {
        return Product::whereIn('uuid', collect($this->getAttribute('products'))->map(fn ($product) => $product['product'])->unique()->values());
    }

    /**
     * Get the products associated with the order with quantity.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getProductsWithQuantityAttribute()
    {
        $productIds = collect($this->getAttribute('products'))->pluck('product')->unique()->values();
        $products = Product::whereIn('uuid', $productIds)->get();

        $products = $products->map(function ($product) {
            $product->quantity = collect($this->getAttribute('products'))
                ->where('product', $product->uuid)
                ->pluck('quantity')
                ->first();

            return $product;
        });

        return $products;
    }

    /**
     * Instantiate a new QueryBuilder instance.
     */
    public function newEloquentBuilder($query): OrderBuilder
    {
        return new OrderBuilder($query);
    }
}
