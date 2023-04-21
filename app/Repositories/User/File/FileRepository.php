<?php

namespace App\Repositories\User\File;

use App\Contracts\Repositories\User\FileRepositoryInterface;
use App\Exceptions\File\FileNotFoundException;
use App\Models\File;
use Illuminate\Http\UploadedFile;

class FileRepository implements FileRepositoryInterface
{
    protected $storePath;
    /**
     * FileRepository instance.
     */
    public function __construct()
    {
        $this->storePath = config('constants.storage_folder');
    }

    /**
     * Create a new file.
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     * @return \App\Models\File
     */
    public function create(UploadedFile $file)
    {
        $uploadedFile = $file->store($this->storePath);
        return File::create([
            'name' => $file->getClientOriginalName(),
            'path' => $uploadedFile,
            'size' => $file->getSize(),
            'type' => $file->getMimeType(),
        ]);
    }

    /**
     * Find a file by uuid.
     *
     * @param  string  $uuid
     * @return \App\Models\File
     */
    public function find(string $uuid)
    {
        return File::query()->whereUuid($uuid)->firstOr(function () {
            throw new FileNotFoundException();
        });
    }
}
