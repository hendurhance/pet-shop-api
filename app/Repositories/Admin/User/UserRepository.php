<?php

namespace App\Repositories\Admin\User;

use App\Contracts\Repositories\Admin\UserRepositoryInterface as AdminUserRepositoryInterface;
use App\Models\User;
use App\Types\Uuid;

class UserRepository implements AdminUserRepositoryInterface
{

    /**
     * Get a listing of users based on given filters
     * @param array<string, mixed> $filters
     * @param int $paginate = 10 <Number of records per page>
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function listingUser(array $filters, int $paginate = 10)
    {
        $query = User::query();

        if (isset($filters['first_name'])) $query->whereFirstName($filters['first_name']);
        
        if (isset($filters['email'])) $query->whereEmail($filters['email']);

        if (isset($filters['phone'])) $query->wherePhoneNumber($filters['phone']);

        if (isset($filters['address'])) $query->whereAddress($filters['address']);

        if (isset($filters['created_at'])) $query->whereCreatedAt($filters['created_at']);

        if (isset($filters['marketing'])) $query->whereMarketing($filters['marketing']);

        if (isset($filters['sortBy'])) $query->sortBy($filters['sortBy'], $filters['desc'] ?? false);

        if(isset($filters['page'])) $query->wherePage($filters['page']);

        if (isset($filters['limit'])) $query->limit($filters['limit']);
        

        return $query->paginate($paginate);
    }

    public function editUser(Uuid $uuid)
    {

    }

    public function deleteUser(Uuid $uuid)
    {

    }
}