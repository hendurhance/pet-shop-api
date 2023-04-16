<?php

namespace App\Http\Controllers\API\V1\User\User;

use App\Contracts\Repositories\User\UserRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\UpdateUserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * UserController constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(private UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->middleware('jwt.auth');
        $this->middleware('role:user');
    }

    /**
     * Show authenticated user
     * @return \App\Traits\HttpResponse
     */
    public function show()
    {
        $data = $this->userRepository->find();
        return $this->success($data, 'User fetched successfully');
    }

    /**
     * Update authenticated user
     * @param UpdateUserRequest $request
     * @return \App\Traits\HttpResponse
     */
    public function edit(UpdateUserRequest $request)
    {
        $data = $this->userRepository->edit($request->validated());

        return $this->success($data, 'User updated successfully');
    }

    /**
     * Delete authenticated user
     * @return \App\Traits\HttpResponse
     */
    public function destroy()
    {
        $this->userRepository->delete();

        return $this->success(null, 'User deleted successfully');
    }
}
