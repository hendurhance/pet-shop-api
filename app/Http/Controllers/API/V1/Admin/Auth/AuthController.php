<?php

namespace App\Http\Controllers\API\V1\Admin\Auth;

use App\Contracts\Repositories\Admin\AuthenticateRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\CreateAdminRequest;
use App\Http\Requests\Admin\Auth\LoginAdminRequest;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * AuthController constructor.
     * @param AuthenticateRepository $authenticateRepository
     */
    public function __construct(private AuthenticateRepositoryInterface $authenticateRepository)
    {
        $this->middleware('auth:api', ['except' => ['create', 'login']]);
        $this->middleware('role:admin', ['except' => ['create', 'login']]);
        $this->authenticateRepository = $authenticateRepository;
    }

    /**
     * Create an Admin User
     * @param CreateAdminRequest $request
     * @return \App\Traits\HttpResponse
     */
    public function create(CreateAdminRequest $request)
    {
        $data = $this->authenticateRepository->create($request->validated());

        return $this->success($data, 'Admin created successfully', Response::HTTP_CREATED);
    }

    /**
     * Login Admin User
     * @param LoginAdminRequest $request
     * @return \App\Traits\HttpResponse
     */
    public function login(LoginAdminRequest $request)
    {
        $data = $this->authenticateRepository->login($request->validated());

        return $this->success($data, 'Admin logged in successfully', Response::HTTP_OK);
    }

    /**
     * Logout Admin User
     * @return \App\Traits\HttpResponse
     */
    public function logout()
    {
        $data = $this->authenticateRepository->logout();

        return $this->success($data, 'Admin logged out successfully', Response::HTTP_OK);
    }
}
