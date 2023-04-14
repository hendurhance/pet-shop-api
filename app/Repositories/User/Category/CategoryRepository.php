<?php

namespace App\Repositories\User\Category;

use App\Contracts\Repositories\User\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * List all categories
     * 
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function listAll(array $data)
    {
    }

    /**
     * Find category by uuid
     * 
     * @param string $uuid
     * @return \App\Models\Category
     */
    public function find(string $uuid)
    {
    }

    /**
     * Create category
     * 
     * @param string $title
     * @return \App\Models\Category
     */
    public function create(string $title)
    {
    }

    /**
     * Update category
     * 
     * @param string $title
     * @param string $uuid
     * @return \App\Models\Category
     */
    public function update(string $title, string $uuid)
    {
    }

    /**
     * Delete category
     * 
     * @param string $uuid
     * @return bool
     */
    public function delete(string $uuid)
    {
    }
}