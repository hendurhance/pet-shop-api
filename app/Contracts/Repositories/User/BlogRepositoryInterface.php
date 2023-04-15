<?php

namespace App\Contracts\Repositories\User;

interface BlogRepositoryInterface
{
    public function listAll(array $filters);
    public function find(string $uuid);
}
