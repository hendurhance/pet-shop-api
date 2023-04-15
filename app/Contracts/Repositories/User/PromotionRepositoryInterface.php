<?php

namespace App\Contracts\Repositories\User;

interface PromotionRepositoryInterface
{
    public function listAll(array $filters);
}
