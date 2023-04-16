<?php

namespace App\Repositories\User\Blog;

use App\Contracts\Repositories\User\BlogRepositoryInterface;
use App\Exceptions\Blog\BlogNotFoundException;
use App\Models\Post;

class BlogRepository implements BlogRepositoryInterface
{
    /**
     * List all blogs
     *
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function listAll(array $filters, int $paginate = 10)
    {
        $query = Post::query()->with('image');

        if (isset($filters['sortBy'])) {
            $query->sortBy($filters['sortBy'], $filters['desc'] ?? false);
        }

        if (isset($filters['page'])) $query->wherePage($filters['page']);

        return $query->paginate($filters['limit'] ?? $paginate);
    }

    /**
     * Find a blog by uuid
     *
     * @param string $uuid
     * @return \App\Models\Blog
     */
    public function find(string $uuid)
    {
        return Post::whereUuid($uuid)->firstOr(function () {
            throw new BlogNotFoundException();
        })->load('image');
    }
}
