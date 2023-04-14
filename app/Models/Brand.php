<?php

namespace App\Models;

use App\Builders\Brand\BrandBuilder;
use App\Traits\Sluggable;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory, UuidTrait, Sluggable;

    protected $fillable = [
        'uuid',
        'title',
        'slug',
    ];

    /**
     * Instantiate a new QueryBuilder instance.
     */
    public function newEloquentBuilder($query): BrandBuilder
    {
        return new BrandBuilder($query);
    }
}
