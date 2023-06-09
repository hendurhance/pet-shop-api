<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

abstract class BaseBuilder extends Builder
{
    protected const PER_PAGE = 10;

    /**
     * WHere UUID is.
     * @param string $uuid
     * @return self
     */
    public function whereUuid(string $uuid): self
    {
        return $this->where('uuid', $uuid);
    }

    /**
     * Sort by
     * @param string $column
     * @param bool $desc = false
     * @return self
     */
    public function sortBy(string $column, bool $desc = false): self
    {
        return $this->orderBy($column, $desc ? 'DESC' : 'ASC');
    }

    /**
     * Where page is.
     * @param int $page
     * @return self
     */
    public function wherePage(int $page): self
    {
        return $this->skip(($page - 1) * self::PER_PAGE);
    }
}
