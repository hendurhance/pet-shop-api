<?php

namespace App\Models;

use App\Builders\File\FileBuilder;
use App\Traits\Uuids;
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
     * Instantiate a new QueryBuilder instance.
     */
    public function newEloquentBuilder($query): FileBuilder
    {
        return new FileBuilder($query);
    }
}
