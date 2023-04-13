<?php

namespace App\Http\Controllers\API\V1\User\Auth;

use App\Contracts\Repositories\Admin\AuthenticateRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogoutController extends Controller
{
    /**
     * LoginController constructor.
     * @param AuthenticateRepositoryInterface $authenticateRepository
     */
    public function __construct(private AuthenticateRepositoryInterface $authenticateRepository)
    {
        $this->middleware('auth:api');
        $this->middleware('role:user');
        $this->authenticateRepository = $authenticateRepository;
    }

    /**
     * Logout a user
     * @param Request $request
     * @return \App\Traits\HttpResponse
     */
    public function logout()
    {
        $this->authenticateRepository->logout();
        return $this->success(null, 'User logged out successfully', Response::HTTP_OK);
    }
}
