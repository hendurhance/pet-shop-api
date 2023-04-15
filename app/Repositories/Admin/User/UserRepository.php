<?php

namespace App\Repositories\Admin\User;

use App\Contracts\Repositories\Admin\UserRepositoryInterface as AdminUserRepositoryInterface;
use App\Enums\UserTypeEnum;
use App\Exceptions\User\UserNotFoundException;
use App\Models\User;
use App\Traits\HttpResponse;

class UserRepository implements AdminUserRepositoryInterface
{
    use HttpResponse;

    /**
     * Get a listing of users based on given filters
     * @param array<string, mixed> $filters
     * @param int $paginate = 10 <Number of records per page>
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function listingUser(array $filters, int $paginate = 10)
    {
        $query = User::query()->whereUserType(UserTypeEnum::IS_USER);

        if (isset($filters['first_name'])) {
            $query->whereFirstName($filters['first_name']);
        }

        if (isset($filters['email'])) {
            $query->whereEmail($filters['email']);
        }

        if (isset($filters['phone'])) {
            $query->wherePhoneNumber($filters['phone']);
        }

        if (isset($filters['address'])) {
            $query->whereAddress($filters['address']);
        }

        if (isset($filters['created_at'])) {
            $query->whereCreatedAt($filters['created_at']);
        }

        if (isset($filters['marketing'])) {
            $query->whereMarketing($filters['marketing']);
        }

        if (isset($filters['sortBy'])) {
            $query->sortBy($filters['sortBy'], $filters['desc'] ?? false);
        }

        if (isset($filters['page'])) {
            $query->wherePage($filters['page']);
        }

        return $query->paginate($filters['limit'] ?? $paginate);
    }

    /**
     * Get a user record by uuid
     * @param string $uuid
     * @return \App\Models\User
     */
    public function editUser(string $uuid, array $data)
    {
        $user = $this->findUser($uuid);

        $user->update($data);

        return $user;
    }

    /**
     * Delete a user record by uuid
     * @param string $uuid
     * @return void
     */
    public function deleteUser(string $uuid)
    {
        $user = $this->findUser($uuid);

        $user->delete();
    }

    /**
     * Find a user by uuid
     * @param string $uuid
     * @return \App\Models\User
     */
    protected function findUser(string $uuid)
    {
        $user = User::whereUuid($uuid)->firstOr(function () {
            throw new UserNotFoundException();
        });

        if ($user->is_admin) throw new UserNotFoundException('You cannot perform this action on an admin user');

        return $user;
    }
}
