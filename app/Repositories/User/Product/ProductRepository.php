<?php

namespace App\Repositories\User\Product;

use App\Contracts\Repositories\User\ProductRepositoryInterface;
use App\Exceptions\Product\ProductNotFoundException;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * Create a product
     *
     * @param array $data
     * @return \App\Models\Product
     */
    public function create(array $data)
    {
        return Product::create($data);
    }

    /**
     * Update a product
     *
     * @param string $uuid
     * @param array $data
     * @return void
     */
    public function update(string $uuid, array $data)
    {
        $product = $this->fetch($uuid);
        $product->update($data);
        return $product;
    }

    /**
     * Delete a product
     *
     * @param string $uuid
     * @return void
     */
    public function delete(string $uuid)
    {
        $product = $this->fetch($uuid);
        $product->delete();
    }

    /**
     * Fetch a product
     *
     * @param string $uuid
     * @return \App\Models\Product
     */
    public function fetch(string $uuid)
    {
        return Product::whereUuid($uuid)->firstOr(function () {
            throw new ProductNotFoundException();
        });
    }

    /**
     * List all products
     *
     * @param array $filters
     * @param int $paginate = 10
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function listAll(array $filters, int $paginate = 10)
    {
        $query = Product::query();

        if (isset($filters['sortBy'])) {
            $query->sortBy($filters['sortBy'], $filters['desc'] ?? false);
        }

        if (isset($filters['page'])) {
            $query->wherePage($filters['page']);
        }

        return $query->paginate($filters['limit'] ?? $paginate);
    }
}
