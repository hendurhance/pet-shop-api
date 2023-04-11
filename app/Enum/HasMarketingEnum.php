<?php

namespace App\Enum;
/**
 * Enum for Marketing
 * @return int<0=HAS_NO_MARKETING,1=HAS_MARKETING>
 */

enum HasMarketingEnum: int
{
    case HAS_MARKETING = 1;
    case HAS_NO_MARKETING = 0;
}