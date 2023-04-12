<?php

declare(strict_types=1);

namespace App\Types;

use Illuminate\Support\Str;

class Uuid
{
    private string $value;

    public function __construct(string $value)
    {
        if (! Str::isUuid($value)) {
            throw new \InvalidArgumentException("The value [$value] is not a valid UUID.");
        }

        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
