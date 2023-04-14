<?php

namespace App\Repositories\User\Promotion;

use App\Contracts\Repositories\User\PromotionRepositoryInterface;

class PromotionRepository implements PromotionRepositoryInterface
{
    /**
     * List all promotions
     * 
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function listAll(array $filters)
    {}
}