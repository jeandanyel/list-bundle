<?php

namespace Jeandanyel\ListBundle\Pagination;

class Pagination
{
    private int $page = 1;
    private int $limit = 20;

    public function getPage(): int
    {
        return $this->page;
    }

    public function setPage(int $page): self
    {
        $this->page = $page;

        return $this;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function setLimit(int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }

    public function getOffset(): int
    {
        return ($this->page - 1) * $this->limit;
    }
}
