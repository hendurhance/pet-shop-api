<?php

namespace App\Contracts\Repositories\User;

interface AuthenticateRepositoryInterface 
{
    public function create(array $data);
    public function login(array $data);
    public function logout();
    public function forgotPassword(string $email);
    public function resetPasswordToken(array $data);
}
