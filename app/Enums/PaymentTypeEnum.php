<?php

namespace App\Enums;

enum PaymentTypeEnum: string
{
    case CARD = 'credit_card';
    case CASH = 'cash_on_delivery';
    case BANK_TRANSFER = 'bank_transfer';

    /**
     * Get all values
     *
     * @return array
     */
    public static function toArray(): array
    {
        return [
            self::CASH->value,
            self::CARD->value,
            self::BANK_TRANSFER->value,
        ];
    }

    /**
     * Get a comma-separated string of all values
     *
     * @return string
     */
    public static function values(): string
    {
        return implode(',', self::toArray());
    }
}
