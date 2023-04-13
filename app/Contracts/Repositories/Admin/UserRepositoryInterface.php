<?php

namespace App\Contracts\Repositories\Admin;

use App\Types\Uuid;

interface UserRepositoryInterface
{
    public function listingUser(array $query);
    public function editUser(Uuid $uuid);
    public function deleteUser(Uuid $uuid);
}