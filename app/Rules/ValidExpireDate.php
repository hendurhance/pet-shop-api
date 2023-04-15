<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidExpireDate implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Validate expire date with two digits for month and year
        if (!preg_match('/^(0[1-9]|1[0-2])\/?([0-9]{2})$/', $value)) {
            $fail('The :attribute must be a valid expire date.');
        }
    }
}
