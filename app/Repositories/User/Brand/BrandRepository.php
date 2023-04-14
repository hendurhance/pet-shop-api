<?php

namespace App\Repositories\User\Brand;

use App\Contracts\Repositories\User\BrandRepositoryInterface;

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
    }

    /**
     * Update a brand.
     *
     * @param  string  $uuid
     * @return \App\Models\Brand
     */
    public function update(string $uuid)
    {
    }

    /**
     * Delete a brand.
     *
     * @param  string  $uuid
     * @return \App\Models\Brand
     */
    public function delete(string $uuid)
    {
    }

    /**
     * Fetch a brand.
     *
     * @param  string  $uuid
     * @return \App\Models\Brand
     */
    public function fetch(string $uuid)
    {
    }

    /**
     * List all brands.
     *
     * @param  array  $filters
     * @return \App\Models\Brand
     */
    public function listAll(array $filters)
    {
    }
}