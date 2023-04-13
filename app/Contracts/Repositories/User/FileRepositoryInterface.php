<?php

namespace App\Contracts\Repositories\User;
use Illuminate\Http\UploadedFile;

interface FileRepositoryInterface 
{
    public function create(UploadedFile $file);
    public function find(string $uuid);
}