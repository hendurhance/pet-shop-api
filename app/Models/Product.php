<?php

namespace App\Models;

use App\Builders\Product\ProductBuilder;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, Uuids, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'category_uuid',
        'title',
        'price',
        'description',
        'metadata',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'metadata' => 'array',
        'price' => 'float',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the category that owns the product.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_uuid', 'uuid');
    }

    /**
     * Get the brand uuid of the metadata attribute.
     * @return string
     */
    public function getBrandUuidAttribute(): string
    {
        return $this->metadata['brand'];
    }

    /**
     * Get the image uuid of the metadata attribute.
     * @return string
     */
    public function getImageUuidAttribute(): string
    {
        return $this->metadata['image'];
    }
    
    /**
     * Get the related brand.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_uuid', 'uuid');
    }

    /**
     * Get the related image.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function image()
    {
        return $this->belongsTo(File::class, 'image_uuid', 'uuid');
    }

    /**
     * Instantiate a new QueryBuilder instance.
     */
    public function newEloquentBuilder($query): ProductBuilder
    {
        return new ProductBuilder($query);
    }
}
