<?php

namespace App\Models;

use App\Builders\Post\PostBuilder;
use App\Traits\Sluggable;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, UuidTrait,Sluggable;

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
     * Instantiate a new QueryBuilder instance.
     */
    public function newEloquentBuilder($query): PostBuilder
    {
        return new PostBuilder($query);
    }
}
