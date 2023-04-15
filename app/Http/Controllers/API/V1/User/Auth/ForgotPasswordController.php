<?php

namespace App\Http\Controllers\API\V1\User\Auth;

use App\Contracts\Repositories\User\AuthenticateRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\ForgotUserPasswordRequest;
use Symfony\Component\HttpFoundation\Response;

class ForgotPasswordController extends Controller
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
     * Forgot password
     * @param ForgotUserPasswordRequest $request
     * @return \App\Traits\HttpResponse
     */
    public function forgotPassword(ForgotUserPasswordRequest $request)
    {
        $data = $this->authenticateRepository->forgotPassword($request->email);
        return $this->success($data, 'Forgot password token created successfully', Response::HTTP_OK);
    }
}
