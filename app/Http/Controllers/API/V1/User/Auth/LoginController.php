<?php

namespace App\Http\Controllers\API\V1\User\Auth;

use App\Contracts\Repositories\User\AuthenticateRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\LoginUserRequest;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    /**
     * LoginController constructor.
     * @param AuthenticateRepositoryInterface $authenticateRepository
     */
    public function __construct(private AuthenticateRepositoryInterface $authenticateRepository)
    {
        $this->authenticateRepository = $authenticateRepository;
    }

    /**
     * Login a user
     * @param LoginUserRequest $request
     * @return \App\Traits\HttpResponse
     */
    public function login(LoginUserRequest $request)
    {
        $data = $this->authenticateRepository->login($request->validated());
        return $this->success($data, 'User logged in successfully', Response::HTTP_OK);
    }
}
