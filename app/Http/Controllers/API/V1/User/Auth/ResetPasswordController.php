<?php

namespace App\Http\Controllers\API\V1\User\Auth;

use App\Contracts\Repositories\User\AuthenticateRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\ResetUserPasswordRequest;
use Symfony\Component\HttpFoundation\Response;

class ResetPasswordController extends Controller
{
    /**
     * LoginController constructor.
     * @param AuthenticateRepositoryInterface $authenticateRepository
     */
    public function __construct(private AuthenticateRepositoryInterface $authenticateRepository)
    {
        $this->authenticateRepository = $authenticateRepository;
    }

    public function resetPasswordToken(ResetUserPasswordRequest $request)
    {
        $data = $this->authenticateRepository->resetPasswordToken($request->validated());
        return $this->success($data, 'User password reset successfully', Response::HTTP_OK);
    }
}
