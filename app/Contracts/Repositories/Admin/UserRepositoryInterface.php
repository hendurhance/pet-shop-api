<?php

namespace App\Contracts\Repositories\Admin;

interface UserRepositoryInterface
{
    public function listingUser(array $query);
    public function editUser(string $uuid, array $data);
    public function deleteUser(string $uuid);
}
