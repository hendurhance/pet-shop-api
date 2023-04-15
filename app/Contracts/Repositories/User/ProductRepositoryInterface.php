<?php

namespace App\Contracts\Repositories\User;

interface ProductRepositoryInterface 
{
    public function create(array $data);
    public function update(string $uuid, array $data);
    public function delete(string $uuid);
    public function fetch(string $uuid);
    public function listAll(array $filters);
}
