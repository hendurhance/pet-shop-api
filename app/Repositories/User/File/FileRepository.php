<?php

namespace App\Repositories\User\File;
use Illuminate\Http\UploadedFile;

use App\Contracts\Repositories\User\FileRepositoryInterface;
use App\Exceptions\File\FileNotFoundException;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

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
        $file = File::create([
            'name' => $file->getClientOriginalName(),
            'path' => $uploadedFile,
            'size' => $file->getSize(), # TODO: Convert to KB, MB, GB
            'type' => $file->getMimeType(),
        ]);
        return $file;
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