<?php

namespace App\Enums;
/**
 * Enum for Marketing
 * @return int<0=HAS_NO_MARKETING,1=HAS_MARKETING>
 */

enum MarketingPreferenceEnum: int
{
    case HAS_MARKETING = 1;
    case HAS_NO_MARKETING = 0;

    /**
     * Get the enum value as a array
     * @return array<int>
     */
    public static function toArray(): array
    {
        return [
            self::HAS_MARKETING,
            self::HAS_NO_MARKETING,
        ];
    }

    /**
     * Get all the values of the enum
     * @return string
     */
    public static function values()
    {
        return implode(',', array_keys(self::toArray()));
    }
}
