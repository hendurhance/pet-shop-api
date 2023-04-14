<?php

namespace App\Builders\File;

use Illuminate\Database\Eloquent\Builder;

class FileBuilder extends Builder
{
    /**
     * WHere UUID is.
     * @param string $uuid
     * @return self
     */
    public function whereUuid(string $uuid): self
    {
        return $this->where('uuid', $uuid);
    }
}