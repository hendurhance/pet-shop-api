<?php

namespace App\Models;

use App\Builders\File\FileBuilder;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory, Uuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'path',
        'size',
        'type',
    ];

    /**
     * Define accessors for size attribute.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function size(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->attributes['size'] / 1000 . ' KB',
        );
    }

    /**
     * Instantiate a new QueryBuilder instance.
     */
    public function newEloquentBuilder($query): FileBuilder
    {
        return new FileBuilder($query);
    }
}
