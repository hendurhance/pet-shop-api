<?php

namespace App\Models;

use App\Builders\Order\OrderStatusBuilder;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory, UuidTrait;

    protected $fillable = [
        'title',
    ];

    /**
     * Instantiate a new QueryBuilder instance.
     */
    public function newEloquentBuilder($query): OrderStatusBuilder
    {
        return new OrderStatusBuilder($query);
    }
}
