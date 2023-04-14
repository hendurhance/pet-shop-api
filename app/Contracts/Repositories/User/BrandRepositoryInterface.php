<?php

namespace App\Contracts\Repositories\User;

interface BrandRepositoryInterface {
    public function create(string $title);
    public function update(string $uuid);
    public function delete(string $uuid);
    public function fetch(string $uuid);
    public function listAll(array $filters);
}