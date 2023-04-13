<?php

namespace App\Http\Controllers\API\V1\User\Auth;

use App\Contracts\Repositories\User\AuthenticateRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\CreateUserRequest;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    /**
     * AuthController constructor.
     * @param AuthenticateRepositoryInterface $authenticateRepository
     */
    public function __construct(private AuthenticateRepositoryInterface $authenticateRepository)
    {
        $this->authenticateRepository = $authenticateRepository;
    }

    /**
     * Register a user
     * @param CreateUserRequest $request
     * @return \App\Traits\HttpResponse
     */
    public function create(CreateUserRequest $request)
    {
        $data = $this->authenticateRepository->create($request->validated());
        return $this->success($data, 'User created successfully', Response::HTTP_OK);
    }
}
