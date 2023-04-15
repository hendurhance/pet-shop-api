<?php

namespace App\Enums;

enum PaymentTypeEnum: string
{
    case CASH = 'credit_card';
    case CARD = 'cash_on_delivery';
    case BANK_TRANSFER = 'bank_transfer';
}