<?php

namespace App\Enums;

enum OrderStatusEnum: string
{
    case OPEN = 'open';
    case PENDING_PAYMENT = 'pending_payment';
    case PAID = 'paid';
    case SHIPPED = 'shipped';
    case CANCELED = 'canceled';

    public static function getValues(): array
    {
        return [
            self::OPEN,
            self::PENDING_PAYMENT,
            self::PAID,
            self::SHIPPED,
            self::CANCELED,
        ];
    }
}