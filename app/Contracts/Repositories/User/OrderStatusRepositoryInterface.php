<?php

namespace App\Contracts\Repositories\User;

interface OrderStatusRepositoryInterface 
{
    public function listAll(array $filters, int $paginate = 10);
    public function find(string $uuid);
    public function create(string $title);
    public function update(string $uuid, string $title);
    public function delete(string $uuid);
}