<?php

namespace App\Repositories\User\File;
use Illuminate\Http\UploadedFile;

use App\Contracts\Repositories\User\FileRepositoryInterface;

class FileRepository implements FileRepositoryInterface
{
    /**
     * Create a new file.
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     * @return \App\Models\File
     */
    public function create(UploadedFile $file)
    {}

    /**
     * Find a file by uuid.
     *
     * @param  string  $uuid
     * @return \App\Models\File
     */
    public function find(string $uuid)
    {}
}