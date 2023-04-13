<?php

namespace App\Http\Controllers\API\V1\Admin\User;

use App\Contracts\Repositories\Admin\UserRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UserListingRequest;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    

    /**
     * AuthController constructor.
     * @param UserRepository $authenticateRepository
     */
    public function __construct(private UserRepositoryInterface $userRepository)
    {
        $this->middleware('auth:admin');
        $this->userRepository = $userRepository;
    }

    /**
     * Get User Listing
     * @param UserListingRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function listing(UserListingRequest $request)
    {
        $data = $this->userRepository->listingUser($request->validated());
        return $this->success($data, 'User listing fetched successfully', Response::HTTP_OK);
    }
}
