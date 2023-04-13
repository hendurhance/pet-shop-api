<?php

namespace App\Http\Controllers\API\V1\User\Auth;

use App\Contracts\Repositories\User\AuthenticateRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\LoginUserRequest;

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

    public function login(LoginUserRequest $request)
    {

    }
}
