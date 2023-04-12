<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait UuidTrait
{
    /**
     * Boot function from Laravel.
     */
    protected static function bootUuidTrait()
    {
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }
}
