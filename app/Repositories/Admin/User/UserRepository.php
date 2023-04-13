<?php

namespace App\Repositories\Admin\User;

use App\Actions\Auth\AuthAction;
use App\Contracts\Repositories\Admin\UserRepositoryInterface as AdminUserRepositoryInterface;
use App\Models\User;
use App\Types\Uuid;

class UserRepository implements AdminUserRepositoryInterface
{
    public function listingUser(array $query)
    {
        return User::query()->paginate($query['per_page']);
    }

    public function editUser(Uuid $uuid)
    {

    }

    public function deleteUser(Uuid $uuid)
    {

    }
}