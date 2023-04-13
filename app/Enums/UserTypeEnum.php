<?php

namespace App\Enums;

/**
 * Enum for User Type
 * @return int<0=USER,1=ADMIN>
 */

enum UserTypeEnum: int
{
    case IS_ADMIN = 1;
    case IS_USER = 0;
}
