<?php

namespace App\Contracts\Repositories\User;

interface UserRepositoryInterface 
{
    public function find();
    public function edit(array $data);
    public function delete();
}