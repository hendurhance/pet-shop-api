<?php

namespace App\Repositories\User\Brand;

use App\Contracts\Repositories\User\BrandRepositoryInterface;
use App\Exceptions\Brand\BrandNotFoundException;
use App\Models\Brand;

class BrandRepository implements BrandRepositoryInterface
{
    /**
     * Create a new brand.
     *
     * @param  string  $title
     * @return \App\Models\Brand
     */
    public function create(string $title)
    {
        return Brand::create([
            'title' => $title,
        ]);
    }

    /**
     * Update a brand.
     *
     * @param  string  $uuid
     * @param  string  $title
     * @return \App\Models\Brand
     */
    public function update(string $uuid, string $title)
    {
        $brand = $this->fetch($uuid);
        $brand->update([
            'title' => $title,
        ]);
        return $brand;
    }

    /**
     * Delete a brand.
     *
     * @param  string  $uuid
     * @return \App\Models\Brand
     */
    public function delete(string $uuid)
    {
        $brand = $this->fetch($uuid);
        $brand->delete();
    }

    /**
     * Fetch a brand.
     *
     * @param  string  $uuid
     * @return \App\Models\Brand
     */
    public function fetch(string $uuid)
    {
        return Brand::query()->whereUuid($uuid)->firstOr(function () {
            throw new BrandNotFoundException();
        });
    }

    /**
     * List all brands.
     *
     * @param  array<string, mixed> $filters
     * @param  int  $paginate = 10 (default)
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function listAll(array $filters, int $paginate = 10)
    {
        $query = Brand::query();

        if (isset($filters['sortBy'])) {
            $query->sortBy($filters['sortBy'], $filters['desc'] ?? false);
        }

        if(isset($filters['page'])) {
            $query->wherePage($filters['page']);
        }

        return $query->paginate($filters['limit'] ?? $paginate);
    }
}
