<?php

namespace App\Repositories\User\Blog;

use App\Contracts\Repositories\User\BlogRepositoryInterface;

class BlogRepository implements BlogRepositoryInterface
{
    /**
     * List all blogs
     * 
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function listAll(array $filters)
    {}

    /**
     * Find a blog by uuid
     * 
     * @param string $uuid
     * @return \App\Models\Blog
     */
    public function find(string $uuid)
    {}
}