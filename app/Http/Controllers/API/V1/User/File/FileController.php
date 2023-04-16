<?php

namespace App\Http\Controllers\API\V1\User\File;

use App\Contracts\Repositories\User\FileRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\File\CreateFileRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FileController extends Controller
{
    /**
     * FileController constructor.
     */
    public function __construct(private FileRepositoryInterface $fileRepository)
    {
        $this->middleware('jwt.auth')->only('upload');
        $this->middleware('role:user')->only('upload');
        $this->fileRepository = $fileRepository;
    }

    /**
     * Upload file
     * @param Request $request
     * @return \App\Traits\HttpResponse
     */
    public function upload(CreateFileRequest $request)
    {
        $data = $this->fileRepository->create($request->file('file'));
        return $this->success($data, 'File uploaded successfully', Response::HTTP_OK);
    }

    /**
     * Show a file
     * @param string $uuid
     * @return \App\Traits\HttpResponse
     */
    public function show(string $uuid)
    {
        return $this->fileRepository->find($uuid);
    }
}
