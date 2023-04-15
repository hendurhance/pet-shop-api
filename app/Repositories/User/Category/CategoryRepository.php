<?php

namespace App\Repositories\User\Category;

use App\Contracts\Repositories\User\CategoryRepositoryInterface;
use App\Exceptions\Category\CategoryNotFoundException;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * List all categories
     *
     * @param array $filters
     * @param int $paginate = 10
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function listAll(array $filters, int $paginate = 10)
    {
        $query = Category::query();

        if (isset($filters['sortBy'])) {
            $query->sortBy($filters['sortBy'], $filters['desc'] ?? false);
        }

        if (isset($filters['page'])) {
            $query->wherePage($filters['page']);
        }

        return $query->paginate($filters['limit'] ?? $paginate);
    }

    /**
     * Find category by uuid
     *
     * @param string $uuid
     * @return \App\Models\Category
     */
    public function find(string $uuid)
    {
        return Category::whereUuid($uuid)->firstOr(function () {
            throw new CategoryNotFoundException();
        });
    }

    /**
     * Create category
     *
     * @param string $title
     * @return \App\Models\Category
     */
    public function create(string $title)
    {
        return Category::create([
            'title' => $title,
        ]);
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
        $category = $this->find($uuid);
        $category->update([
            'title' => $title,
        ]);
        return $category;
    }

    /**
     * Delete category
     *
     * @param string $uuid
     * @return void
     */
    public function delete(string $uuid)
    {
        $category = $this->find($uuid);
        $category->delete();
    }
}
