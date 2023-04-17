<?php

namespace App\Traits;

use App\Models\File;

trait HasImage
{
    /**
     * Get the image uuid of the metadata attribute.
     *
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
}
