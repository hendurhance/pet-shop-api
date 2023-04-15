<?php

namespace App\Contracts\Repositories\User;

interface OrderRepositoryInterface 
{
    public function create(array $data);
    public function update(array $data, string $uuid);
    public function delete(string $uuid);
    public function fetch(string $uuid);
    public function listAll(array $filters);
    public function listUserAll(array $filters);
    public function listShipmentLocators(array $filters);
    public function listDashboard(array $filters);
    public function download(string $uuid);
}
