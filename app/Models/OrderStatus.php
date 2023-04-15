<?php

namespace App\Models;

use App\Builders\Order\OrderStatusBuilder;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory, UuidTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
    ];

    /**
     * Get the orders for the order status.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Instantiate a new QueryBuilder instance.
     */
    public function newEloquentBuilder($query): OrderStatusBuilder
    {
        return new OrderStatusBuilder($query);
    }
}
