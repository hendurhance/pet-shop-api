<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Sluggable
{
    /**
     * Boot the sluggable trait.
     *
     * @return void
     */
    public static function bootSluggable()
    {
        static::creating(function ($model) {
            $model->slug = $model->generateSlug($model->title);
        });

        static::updating(function ($model) {
            if ($model->isDirty('title')) {
                $model->slug = $model->generateSlug($model->title);
            }
        });
    }

    /**
     * Generate a unique slug from the given title.
     *
     * @param string $title
     * @return string
     */
    public function generateSlug(string $title): string
    {
        $slug = Str::slug($title);

        $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }
}
