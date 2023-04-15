<?php

namespace App\Models;

use App\Builders\Post\PostBuilder;
use App\Traits\Sluggable;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, Uuids, Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'title',
        'slug',
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
    public function newEloquentBuilder($query): PostBuilder
    {
        return new PostBuilder($query);
    }
}
