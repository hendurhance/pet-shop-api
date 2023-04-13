<?php

namespace App\Repositories\User\User;

use App\Actions\Auth\AuthAction;
use App\Contracts\Repositories\User\AuthenticateRepositoryInterface;
use App\Contracts\Repositories\User\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{

    /**
     * Instantiate auth repository instance
     * @param AuthAction $authAction
     */
    public function __construct(private AuthAction $authAction)
    {
        $this->authAction = $authAction;
    }

    /**
     * Get user
     * @return \App\Models\User
     */
    public function find()
    {
        return $this->authAction->user();
    }

    /**
     * Edit a authenticated user
     * @param array $data
     * @return \App\Models\User
     */
    public function edit(array $data)
    {
        $user = $this->authAction->user();
        $user->update($data);
        return $user;
    }

    /**
     * Delete a user
     * @return void
     */
    public function delete()
    {
        $user = $this->authAction->user();
        $user->delete();
    }
}
