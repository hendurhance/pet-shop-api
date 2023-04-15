<?php

namespace App\Models;

use App\Builders\Promotion\PromotionBuilder;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory, Uuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'title',
        'content',
        'metadata',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'metadata' => 'array',
    ];

    /**
     * Get the image uuid of the metadata attribute.
     * @return string
     */
    public function getImageUuidAttribute(): string
    {
        return $this->metadata['image'];
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
    public function newEloquentBuilder($query): PromotionBuilder
    {
        return new PromotionBuilder($query);
    }
}
