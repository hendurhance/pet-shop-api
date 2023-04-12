<?php

namespace App\Http\Controllers\API\V1\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\CreateAdminRequest;
use App\Repositories\Admin\Auth\AuthenticateRepository;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    /**
     * AuthController constructor.
     * @param AuthenticateRepository $authenticateRepository
     */
    public function __construct(private AuthenticateRepository $authenticateRepository)
    {
        $this->authenticateRepository = $authenticateRepository;
    }

    /**
     * Create an Admin User
     * @param CreateAdminRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(CreateAdminRequest $request)
    {
        $data = $this->authenticateRepository->create($request->validated());
        return $this->success($data, 'Admin created successfully', Response::HTTP_CREATED);
    }
}
