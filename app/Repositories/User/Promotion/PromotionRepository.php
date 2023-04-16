<?php

namespace App\Repositories\User\Promotion;

use App\Contracts\Repositories\User\PromotionRepositoryInterface;
use App\Models\Promotion;

class PromotionRepository implements PromotionRepositoryInterface
{
    /**
     * List all promotions
     *
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function listAll(array $filters, int $paginate = 10)
    {
        $query = Promotion::query()->with('image');

        if (isset($filters['sortBy'])) {
            $query->sortBy($filters['sortBy'], $filters['desc'] ?? false);
        }

        if (isset($filters['page'])) {
            $query->wherePage($filters['page']);
        }

        return $query->paginate($filters['limit'] ?? $paginate);
    }
}
