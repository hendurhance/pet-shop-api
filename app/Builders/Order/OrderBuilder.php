<?php

namespace App\Builders\Order;

use App\Builders\BaseBuilder;
use App\Enums\OrderStatusEnum;
use Carbon\Carbon;

class OrderBuilder extends BaseBuilder
{
    /**
     * Where user owns the order.
     * @param string $uuid
     * @return self
     */
    public function whereUserOwns(string $id): self
    {
        return $this->where('user_id', $id);
    }

    /**
     * Where fix range is.
     * @param string $range = (today|monthly|yearly)
     * @return self
     */
    public function whereFixRange(string $range): self
    {
        switch ($range) {
            case 'today':
                return $this->whereDate('created_at', Carbon::today());
            case 'monthly':
                return $this->whereMonth('created_at', Carbon::now()->month);
            case 'yearly':
                return $this->whereYear('created_at', Carbon::now()->year);
            default:
                return $this;
            }
    }

    /**
     * Where date range is.
     * @param array $range
     * @return self
     */
    public function whereDateRange(array $range): self
    {
        if (isset($range['from'])) $this->whereDate('created_at', '>=', $range['from']);
        if (isset($range['to'])) $this->whereDate('created_at', '<=', $range['to']);
        return $this;
    }

    /**
     * Where Order Status is Shipped.
     * @return self
     */
    public function whereShipped(): self
    {
        return $this->whereHas('orderStatus', function ($query) {
            $query->where('title', OrderStatusEnum::SHIPPED);
        });
    }

    /**
     * Where Order UUID is like.
     * @param string $uuid
     * @return self
     */
    public function whereUuidLike(string $uuid): self
    {
        return $this->where('uuid', 'like', "%{$uuid}%");
    }

    /**
     * Where Customer UUID is.
     * @param string $uuid
     * @return self
     */
    public function whereCustomerUuid(string $uuid): self
    {
        return $this->whereHas('user', function ($query) use ($uuid) {
            $query->where('uuid', $uuid);
        });
    }
}
