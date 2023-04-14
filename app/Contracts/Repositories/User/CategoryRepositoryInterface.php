<?php

namespace App\Contracts\Repositories\User;

interface CategoryRepositoryInterface 
{
    public function listAll(array $filters);
    public function find(string $uuid);
    public function create(string $title);
    public function update(string $title, string $uuid);
    public function delete(string $uuid);
}
