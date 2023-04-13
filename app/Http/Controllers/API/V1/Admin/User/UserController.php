<?php

namespace App\Http\Controllers\API\V1\Admin\User;

use App\Contracts\Repositories\Admin\UserRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Http\Requests\Admin\User\UserListingRequest;
use App\Types\Uuid;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    

    /**
     * UserController constructor.
     * @param UserRepositoryInterface $authenticateRepository
     */
    public function __construct(private UserRepositoryInterface $userRepository)
    {
        $this->middleware('auth:admin');
        $this->userRepository = $userRepository;
    }

    /**
     * Get User Listing
     * @param UserListingRequest $request
     * @return \App\Traits\HttpResponse
     */
    public function listing(UserListingRequest $request)
    {
        $data = $this->userRepository->listingUser($request->validated());
        return $this->success($data, 'User listing fetched successfully', Response::HTTP_OK);
    }

    /**
     * Edit User record
     * @param UpdateUserRequest $request
     * @param string $uuid
     * @return \App\Traits\HttpResponse
     */
    public function edit(string $uuid, UpdateUserRequest $request)
    {
        $data = $this->userRepository->editUser($uuid, $request->validated());
        return $this->success($data, 'User record updated successfully', Response::HTTP_OK);
    }

    /**
     * Delete User record
     * @param string $uuid
     * @return \App\Traits\HttpResponse
     */
    public function delete(string $uuid)
    {
        $data = $this->userRepository->deleteUser($uuid);
        return $this->success($data, 'User record deleted successfully', Response::HTTP_OK);
    }
}
