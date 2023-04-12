<?php

namespace App\Contracts\Repositories\Admin;

interface AuthenticateRepositoryInterface
{
    public function login();
    public function logout();
    public function create(array $data);
}