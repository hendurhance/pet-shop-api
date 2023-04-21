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

        $filterableColumns = ['first_name' => 'whereFirstName', 'email' => 'whereEmail', 'phone' => 'wherePhoneNumber', 'address' => 'whereAddress', 'created_at' => 'whereCreatedAt', 'marketing' => 'whereMarketing'];

        foreach ($filterableColumns as $column => $method) {
            if (isset($filters[$column])) {
                $query->$method($filters[$column]);
            }
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

        if ($user->is_admin) {
            throw new UserNotFoundException('You cannot perform this action on an admin user');
        }

        return $user;
    }
}
