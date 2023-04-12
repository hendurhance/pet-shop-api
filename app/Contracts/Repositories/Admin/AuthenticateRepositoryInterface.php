<?php

namespace App\Contracts\Repositories\Admin;

interface AuthenticateRepositoryInterface
{
    public function login(array $data);
    public function logout();
    public function create(array $data);
}